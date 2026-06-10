<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set NIK for existing users with NULL or empty NIK
        // Use user ID as temporary NIK (padded to 16 digits)
        DB::table('users')
            ->where(function ($query) {
                $query->whereNull('nik')
                      ->orWhere('nik', '');
            })
            ->update([
                'nik' => DB::raw('LPAD(CAST(id AS CHAR), 16, "0")')
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset NIK to empty for users that were updated
        DB::table('users')
            ->where(function ($query) {
                $query->whereNull('nik')
                      ->orWhere('nik', '');
            })
            ->update(['nik' => '']);
    }
};
