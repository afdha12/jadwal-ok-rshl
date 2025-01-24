<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JadwalOK;
use Illuminate\Http\Request;
use App\Models\DokterAnestesi;
use App\Models\Dokter;

class DisplayController extends Controller
{
    public function display()
    {
        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('Y-m-d');
        $dokters = DokterAnestesi::where('tanggal', $today)->get();
        // $data = JadwalOK::where('tgl_operasi', $today)->whereNot('status', 'TERLAKSANA')->orderBy('jam_operasi')->get();
        // $data = JadwalOK::where('tgl_operasi', $today)->orderBy('jam_operasi')->get();
        // Ambil data yang diurutkan berdasarkan jam_operasi dan ruang_operasi
        $data = JadwalOK::with('dokter')
            ->where('tgl_operasi', $today) // Ambil data yang tanggalnya sama dengan hari ini
            ->orderBy('jam_operasi') // Urutkan berdasarkan jam_operasi
            ->orderBy('ruang_operasi') // Urutkan berdasarkan ruang_operasi
            ->get();
        return view('pages.display', compact('data', 'dokters', 'today'));
    }

}
