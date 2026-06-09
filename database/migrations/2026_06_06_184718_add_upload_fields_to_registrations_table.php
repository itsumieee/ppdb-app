<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('ijazah_file')->nullable();
            $table->string('rapor_file')->nullable();
            $table->string('kk_file')->nullable();
            $table->string('photo_file')->nullable();
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('verification_note')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['ijazah_file', 'rapor_file', 'kk_file', 'photo_file', 'verification_status', 'verification_note']);
        });
    }
};