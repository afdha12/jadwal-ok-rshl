<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterAnestesi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter_anestesi';

    public $timestamps = false;

    protected $fillable = [ 'tanggal', 'nama_dokter'];

}
