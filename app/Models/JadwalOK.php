<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalOK extends Model
{
    use HasFactory;
    protected $table = 'jadwal_operasi';

    // public $timestamps = false;

    protected $fillable = [ 'tgl_operasi', 'jam_operasi', 'nama_pasien', 'usia', 'no_cm', 'diagnosa','tindakan', 'operator', 'ruang_operasi', 'jaminan', 'profilaksis', 'status'];

}
