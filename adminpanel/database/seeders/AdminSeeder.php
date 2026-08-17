<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = strtolower((string) env('ADMIN_EMAIL', 'admin@nexus.local'));
        $password = (string) env('ADMIN_PASSWORD', 'Admin#12345');
        $name = (string) env('ADMIN_NAME', 'Admin Root');

        $user = User::where('email', $email)->first();

        if (! $user) {
            User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
            $this->command->info('Admin dibuat: '.$email);

            return;
        }

        if (! Hash::check($password, $user->password)) {
            $user->update(['name' => $name, 'password' => Hash::make($password)]);
            $this->command->info('Kata sandi admin diperbarui: '.$email);

            return;
        }

        $this->command->info('Admin sudah ada: '.$email);
    }
}
