<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_operasi', function (Blueprint $table) {

            // Tambah kolom baru setelah kolom yang diubah
            $table->string('jam_operasi2')->after('jam_operasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_operasi', function (Blueprint $table) {
            // Balik perubahan jika migrasi di-rollback
            $table->dropColumn('jam_operasi2');
        });
    }
};
