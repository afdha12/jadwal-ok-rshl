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
        Schema::create('jadwal_operasi', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_operasi');
            $table->string('jam_operasi')->nullable();
            $table->string('nama_pasien');
            $table->string('usia');
            $table->string('no_cm');
            $table->string('diagnosa');
            $table->string('tindakan');
            $table->string('operator');
            $table->string('ruang_operasi');
            $table->string('jaminan');
            $table->string('profilaksis')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_operasi');
    }
};
