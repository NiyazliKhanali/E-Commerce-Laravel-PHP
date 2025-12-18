<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('verification_code')->nullable()->after('password');
            $table->timestamp('verification_code_expires_at')->nullable()->after('verification_code');
            $table->boolean('is_verified')->default(false)->after('verification_code_expires_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'verification_code', 'verification_code_expires_at', 'is_verified']);
        });
    }
};