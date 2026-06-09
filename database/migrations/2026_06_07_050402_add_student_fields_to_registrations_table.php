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
        Schema::table('registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'nisn')) {
                $table->string('nisn', 10)->unique()->nullable()->after('full_name');
            }
            if (!Schema::hasColumn('registrations', 'gender')) {
                $table->enum('gender', ['L', 'P'])->nullable()->after('date_of_birth');
            }
            if (!Schema::hasColumn('registrations', 'religion')) {
                $table->string('religion')->nullable()->after('gender');
            }
            if (!Schema::hasColumn('registrations', 'phone')) {
                $table->string('phone', 15)->nullable()->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (Schema::hasColumn('registrations', 'nisn')) {
                $table->dropColumn('nisn');
            }
            if (Schema::hasColumn('registrations', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('registrations', 'religion')) {
                $table->dropColumn('religion');
            }
            if (Schema::hasColumn('registrations', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};
