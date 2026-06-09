<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('ijazah')->nullable();
            $table->string('rapor')->nullable();
            $table->string('kk')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('berkas_verified')->default(false);
            $table->text('catatan_verifikasi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['ijazah', 'rapor', 'kk', 'foto', 'berkas_verified', 'catatan_verifikasi']);
        });
    }
};