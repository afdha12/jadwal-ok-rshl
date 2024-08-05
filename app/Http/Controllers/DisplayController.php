<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JadwalOK;
use Illuminate\Http\Request;
use App\Models\DokterAnestesi;

class DisplayController extends Controller
{
    public function display()
    {
        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('d-m-Y');
        $dokter = DokterAnestesi::where('tanggal', $today)->get();
        $data = JadwalOK::where('tgl_operasi', $today)->whereNot('status', 'TERLAKSANA')->orderBy('jam_operasi')->get();
        return view('pages.display', compact('data', 'dokter', 'today'));
    }
}
