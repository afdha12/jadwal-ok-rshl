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
            $table->string('bb')->nullable();
            $table->string('asisten')->nullable();
            $table->string('instrumentator')->nullable();
            $table->string('sirkulasi')->nullable();
            $table->string('anestesi')->nullable();
            $table->string('p_anestesi')->nullable();
            $table->string('anak')->nullable();
            $table->string('jam_puasa')->nullable();
            $table->string('jam_kedatangan')->nullable();
            $table->string('lab')->nullable();
            $table->string('ro')->nullable();
            $table->string('ct_scan')->nullable();
            $table->string('tgl_ipd')->nullable();
            $table->string('hasil_ipd')->nullable();
            $table->string('tgl_jantung')->nullable();
            $table->string('hasil_jantung')->nullable();
            $table->string('tgl_lain')->nullable();
            $table->string('hasil_lain')->nullable();
            $table->string('tgl_anasthesi')->nullable();
            $table->string('hasil_anasthesi')->nullable();
            $table->string('pkkt')->nullable();
            $table->string('verifikasi')->nullable();
            $table->string('pengingat')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('s_usia')->nullable();
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
            $table->dropColumn('bb');
            $table->dropColumn('asisten');
            $table->dropColumn('instrumentator');
            $table->dropColumn('sirkulasi');
            $table->dropColumn('anestesi');
            $table->dropColumn('p_anestesi');
            $table->dropColumn('anak');
            $table->dropColumn('jam_puasa');
            $table->dropColumn('jam_kedatangan');
            $table->dropColumn('lab');
            $table->dropColumn('ro');
            $table->dropColumn('ct_scan');
            $table->dropColumn('tgl_ipd');
            $table->dropColumn('hasil_ipd');
            $table->dropColumn('tgl_jantung');
            $table->dropColumn('hasil_jantung');
            $table->dropColumn('tgl_lain');
            $table->dropColumn('hasil_lain');
            $table->dropColumn('pkkt');
            $table->dropColumn('verifikasi');
            $table->dropColumn('pengingat');
            $table->dropColumn('keterangan');
        });
    }
};
