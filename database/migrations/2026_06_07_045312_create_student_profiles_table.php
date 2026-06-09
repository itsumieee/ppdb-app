<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('previous_school');
            $table->string('major_choice');
            $table->enum('status', ['pending', 'approved', 'rejected', 'graduated', 'failed'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->string('registration_number')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
