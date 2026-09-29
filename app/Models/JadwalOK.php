<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalOK extends Model
{
    use HasFactory;

    protected $table = 'jadwal_operasi';

    // public $timestamps = false;

    protected $fillable = ['tgl_operasi', 'jam_operasi', 'jam_operasi2', 'prefix', 'nama_pasien', 'usia', 's_usia', 'no_cm', 'diagnosa', 'tindakan', 'dokter_id', 'ruang_operasi', 'jaminan', 'profilaksis', 'status', 'bb', 'asisten', 'instrumentator', 'sirkulasi', 'anestesi', 'p_anestesi', 'anak', 'jam_puasa', 'jam_kedatangan', 'lab', 'ro', 'ct_scan', 'tgl_ipd', 'hasil_ipd', 'tgl_jantung', 'hasil_jantung', 'tgl_anasthesi', 'hasil_anasthesi', 'tgl_lain', 'hasil_lain', 'pkkt', 'verifikasi', 'pengingat', 'keterangan', 'catatan_hasil_penunjang'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}
