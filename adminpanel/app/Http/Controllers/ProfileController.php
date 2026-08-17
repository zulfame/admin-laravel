<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', 'unique:users,email,'.$user->getKey()],
            'title' => ['nullable', 'string', 'max:120'],
            'phone' => ['nullable', 'string', 'max:40'],
            'bio' => ['nullable', 'string', 'max:400'],
            'avatar' => ['nullable', File::image()->types(['jpg', 'jpeg', 'png', 'webp'])->max(2048)],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah dipakai akun lain.',
            'avatar.*' => 'Foto harus JPG, PNG, atau WebP maksimal 2 MB.',
        ]);

        $oldPath = $user->avatar_path;
        $newPath = null;

        try {
            if ($request->hasFile('avatar')) {
                $newPath = $request->file('avatar')->store('avatars', 'public');
            }

            DB::transaction(function () use ($user, $data, $newPath) {
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->title = $data['title'] ?? null;
                $user->phone = $data['phone'] ?? null;
                $user->bio = $data['bio'] ?? null;

                if ($newPath !== null) {
                    $user->avatar_path = $newPath;
                }

                $user->save();
            });

            if ($newPath !== null && $oldPath && $oldPath !== $newPath) {
                Storage::disk('public')->delete($oldPath);
            }
        } catch (\Throwable $e) {
            if ($newPath !== null) {
                Storage::disk('public')->delete($newPath);
            }
            throw $e;
        }

        return back()->with('status', 'Profil berhasil diperbarui.');
    }

    public function removeAvatar(Request $request)
    {
        $user = $request->user();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
            $user->avatar_path = null;
            $user->save();
        }

        return back()->with('status', 'Foto profil dihapus.');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::min(10)->mixedCase()->numbers()],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sama.',
        ]);

        if (! Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini salah.'])->with('tab', 'password');
        }

        if (Hash::check($data['password'], $user->password)) {
            return back()->withErrors(['password' => 'Gunakan kata sandi yang berbeda dari sebelumnya.'])->with('tab', 'password');
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        $guard = config('auth.defaults.guard', 'web');
        $request->session()->put('password_hash_'.$guard, $user->password);

        return back()->with('status', 'Kata sandi berhasil diubah.')->with('tab', 'password');
    }
}
