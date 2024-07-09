<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JadwalOK;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function display()
    {
        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('d-m-Y');
        $data = JadwalOK::where('tgl_operasi', $today)->orderBy('jam_operasi')->get();
        return view('pages.display', compact('data', 'today'));
    }
}
