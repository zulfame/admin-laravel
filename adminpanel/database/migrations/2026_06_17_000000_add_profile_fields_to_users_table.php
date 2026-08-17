<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_path')->nullable()->after('password');
            $table->string('title')->nullable()->after('avatar_path');
            $table->string('phone')->nullable()->after('title');
            $table->string('timezone')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('timezone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar_path', 'title', 'phone', 'timezone', 'bio']);
        });
    }
};
