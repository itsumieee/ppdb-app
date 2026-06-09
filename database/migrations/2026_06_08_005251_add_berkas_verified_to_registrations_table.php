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
            if (!Schema::hasColumn('registrations', 'berkas_verified')) {
                $table->boolean('berkas_verified')->default(false)->after('status');
            }
            if (!Schema::hasColumn('registrations', 'catatan_verifikasi')) {
                $table->text('catatan_verifikasi')->nullable()->after('berkas_verified');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (Schema::hasColumn('registrations', 'berkas_verified')) {
                $table->dropColumn('berkas_verified');
            }
            if (Schema::hasColumn('registrations', 'catatan_verifikasi')) {
                $table->dropColumn('catatan_verifikasi');
            }
        });
    }
};
