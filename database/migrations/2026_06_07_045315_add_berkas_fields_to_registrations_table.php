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
            if (!Schema::hasColumn('registrations', 'akta')) {
                $table->string('akta')->nullable();
            }
            if (!Schema::hasColumn('registrations', 'skl')) {
                $table->string('skl')->nullable();
            }
            if (!Schema::hasColumn('registrations', 'berkas_note')) {
                $table->text('berkas_note')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (Schema::hasColumn('registrations', 'akta')) {
                $table->dropColumn('akta');
            }
            if (Schema::hasColumn('registrations', 'skl')) {
                $table->dropColumn('skl');
            }
            if (Schema::hasColumn('registrations', 'berkas_note')) {
                $table->dropColumn('berkas_note');
            }
        });
    }
};
