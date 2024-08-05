<?php

namespace App\Http\Controllers;

use App\Models\DokterAnestesi;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        // $now = Carbon::now();
        // $now->setTimezone('Asia/Jakarta');
        // $today = $now->format('d-m-Y');
        $title = 'Hapus data!';
        $text = "Apakah anda yakin ingin menghapusnya?";
        confirmDelete($title, $text);
        $operators = ['dr. Ade Aria Nugraha, Sp.An', 'dr. Ahmad Angga Luthfi, Sp.An', 'dr. Ali Satria, Sp.B', 'dr. Ary Rachmanto, Sp.B', 'dr. Bima Ananta Bukhori, Sp.OG', 'dr. Budi Syamhudi, Sp.OG', 'dr. Defayudina Dafilianty R., Sp.M', 'dr. Dino Rinaldi, Sp.OG(Onk)', 'dr. Gunawan Yudhistira, Sp.THT-KL', 'dr. Ikrizal, Sp.U', 'drg. Irsan Kurniawan, Sp.BM,Subsp.T.M.T.M.J(K)', 'dr. Joel Purba, Sp.OG', 'drg. Kustini Indah S, Sp.KGA', 'dr. Muhammad Dwi Nugroho, Sp.M', 'dr. Muhammad Fajrin Armin F, Sp.OT', 'dr. Muhammad Zulkarnain Hussein, Sp.OG(K)', 'dr. Nurul Islami, Sp.OG', 'dr. Nurul Azizah Busatam, Sp.BA', 'dr. Putu Junita, Sp.An (K)IC', 'dr. Ratna Dewi Puspita Sari, Sp.OG', 'dr. Ratu Fajaria, Sp.THT-KL', 'dr.  Risal Wintoko, Sp.B', 'dr. Rodiani, Sp.OG', 'dr. Sabasdin Harahap, Sp.B, MARS, FICS', 'dr. Sarlita Indah Permatasari, Sp.OG', 'dr. Taufiqurahman Rahim, Sp.OG(K)', 'dr. Teguh Astanto, Sp. B', 'dr. Fachry Rafiq Iwan, Sp.B', 'dr. Idris, Sp.OG', 'dr. Zulfadli, Sp.OG'];
        $data = DokterAnestesi::orderBy('tanggal', 'desc')->paginate(30);
        return view('pages.dokter-anestesi' , compact('data', 'operators'));
    }

    public function store(Request $request)
    {
        // $now = Carbon::now();
        // $now->setTimezone('Asia/Jakarta');
        // $today = $now->format('d-m-Y');
        DokterAnestesi::create($request->all());
        return redirect()->route('dokter.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = DokterAnestesi::find($id);
        $operators = ['dr. Ade Aria Nugraha, Sp.An', 'dr. Ahmad Angga Luthfi, Sp.An', 'dr. Ali Satria, Sp.B', 'dr. Ary Rachmanto, Sp.B', 'dr. Bima Ananta Bukhori, Sp.OG', 'dr. Budi Syamhudi, Sp.OG', 'dr. Defayudina Dafilianty R., Sp.M', 'dr. Dino Rinaldi, Sp.OG(Onk)', 'dr. Gunawan Yudhistira, Sp.THT-KL', 'dr. Ikrizal, Sp.U', 'drg. Irsan Kurniawan, Sp.BM,Subsp.T.M.T.M.J(K)', 'dr. Joel Purba, Sp.OG', 'drg. Kustini Indah S, Sp.KGA', 'dr. Muhammad Dwi Nugroho, Sp.M', 'dr. Muhammad Fajrin Armin F, Sp.OT', 'dr. Muhammad Zulkarnain Hussein, Sp.OG(K)', 'dr. Nurul Islami, Sp.OG', 'dr. Nurul Azizah Busatam, Sp.BA', 'dr. Putu Junita, Sp.An (K)IC', 'dr. Ratna Dewi Puspita Sari, Sp.OG', 'dr. Ratu Fajaria, Sp.THT-KL', 'dr.  Risal Wintoko, Sp.B', 'dr. Rodiani, Sp.OG', 'dr. Sabasdin Harahap, Sp.B, MARS, FICS', 'dr. Sarlita Indah Permatasari, Sp.OG', 'dr. Taufiqurahman Rahim, Sp.OG(K)', 'dr. Teguh Astanto, Sp. B', 'dr. Fachry Rafiq Iwan, Sp.B', 'dr. Idris, Sp.OG', 'dr. Zulfadli, Sp.OG'];
        return view('modal.edit-dokter-anestesi', compact('data', 'operators'));
        // return response()->json([$data, $operators]);
    }

    public function update(Request $request, $id)
    {
        // $now = Carbon::now();
        // $now->setTimezone('Asia/Jakarta');
        // $today = $now->format('d-m-Y');
        $data = DokterAnestesi::find($id);
        // $oldDate = $data->tgl_operasi;
        $data->update($request->all());
        return redirect()->route('dokter.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        // $now = Carbon::now();
        // $now->setTimezone('Asia/Jakarta');
        // $today = $now->format('d-m-Y');
        $data = DokterAnestesi::find($id);
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Pasien berhasil dihapus');
   
    }
}
