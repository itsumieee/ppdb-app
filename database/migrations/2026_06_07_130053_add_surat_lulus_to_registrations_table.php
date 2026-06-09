<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Cek apakah kolom sudah ada, jika belum tambahkan
            if (!Schema::hasColumn('registrations', 'surat_lulus')) {
                $table->string('surat_lulus')->nullable()->after('rapor');
            }
            // Jika kolom lain juga belum ada, tambahkan di sini
            if (!Schema::hasColumn('registrations', 'foto')) {
                $table->string('foto')->nullable()->after('major_choice');
            }
            if (!Schema::hasColumn('registrations', 'kk')) {
                $table->string('kk')->nullable()->after('foto');
            }
            if (!Schema::hasColumn('registrations', 'akta')) {
                $table->string('akta')->nullable()->after('kk');
            }
            if (!Schema::hasColumn('registrations', 'rapor')) {
                $table->string('rapor')->nullable()->after('akta');
            }
        });
    }

    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('surat_lulus');
        });
    }
};