<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokterAnestesi;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Hapus data!';
        $text = "Apakah anda yakin ingin menghapusnya?";
        confirmDelete($title, $text);
        $operators = ['dr. Ade Aria Nugraha, Sp.An', 'dr. Ahmad Angga Luthfi, Sp.An', 'dr. Ali Satria, Sp.B', 'dr. Ary Rachmanto, Sp.B', 'dr. Bima Ananta Bukhori, Sp.OG', 'dr. Budi Syamhudi, Sp.OG', 'dr. Defayudina Dafilianty R., Sp.M', 'dr. Dino Rinaldi, Sp.OG(Onk)', 'dr. Gunawan Yudhistira, Sp.THT-KL', 'dr. Ikrizal, Sp.U', 'drg. Irsan Kurniawan, Sp.BM,Subsp.T.M.T.M.J(K)', 'dr. Joel Purba, Sp.OG', 'drg. Kustini Indah S, Sp.KGA', 'dr. Muhammad Dwi Nugroho, Sp.M', 'dr. Muhammad Fajrin Armin F, Sp.OT', 'dr. Muhammad Zulkarnain Hussein, Sp.OG(K)', 'dr. Nurul Islami, Sp.OG', 'dr. Nurul Azizah Busatam, Sp.BA', 'dr. Putu Junita, Sp.An (K)IC', 'dr. Ratna Dewi Puspita Sari, Sp.OG', 'dr. Ratu Fajaria, Sp.THT-KL', 'dr.  Risal Wintoko, Sp.B', 'dr. Rodiani, Sp.OG', 'dr. Sabasdin Harahap, Sp.B, MARS, FICS', 'dr. Sarlita Indah Permatasari, Sp.OG', 'dr. Taufiqurahman Rahim, Sp.OG(K)', 'dr. Teguh Astanto, Sp. B', 'dr. Fachry Rafiq Iwan, Sp.B', 'dr. Idris, Sp.OG', 'dr. Zulfadli, Sp.OG'];
        $data = DokterAnestesi::orderBy('tanggal', 'desc')->paginate(30);
        return view('pages.dokter-anestesi' , compact('data', 'operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DokterAnestesi::create($request->all());
        return redirect()->route('dokter.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DokterAnestesi::find($id);
        $operators = ['dr. Ade Aria Nugraha, Sp.An', 'dr. Ahmad Angga Luthfi, Sp.An', 'dr. Ali Satria, Sp.B', 'dr. Ary Rachmanto, Sp.B', 'dr. Bima Ananta Bukhori, Sp.OG', 'dr. Budi Syamhudi, Sp.OG', 'dr. Defayudina Dafilianty R., Sp.M', 'dr. Dino Rinaldi, Sp.OG(Onk)', 'dr. Gunawan Yudhistira, Sp.THT-KL', 'dr. Ikrizal, Sp.U', 'drg. Irsan Kurniawan, Sp.BM,Subsp.T.M.T.M.J(K)', 'dr. Joel Purba, Sp.OG', 'drg. Kustini Indah S, Sp.KGA', 'dr. Muhammad Dwi Nugroho, Sp.M', 'dr. Muhammad Fajrin Armin F, Sp.OT', 'dr. Muhammad Zulkarnain Hussein, Sp.OG(K)', 'dr. Nurul Islami, Sp.OG', 'dr. Nurul Azizah Busatam, Sp.BA', 'dr. Putu Junita, Sp.An (K)IC', 'dr. Ratna Dewi Puspita Sari, Sp.OG', 'dr. Ratu Fajaria, Sp.THT-KL', 'dr.  Risal Wintoko, Sp.B', 'dr. Rodiani, Sp.OG', 'dr. Sabasdin Harahap, Sp.B, MARS, FICS', 'dr. Sarlita Indah Permatasari, Sp.OG', 'dr. Taufiqurahman Rahim, Sp.OG(K)', 'dr. Teguh Astanto, Sp. B', 'dr. Fachry Rafiq Iwan, Sp.B', 'dr. Idris, Sp.OG', 'dr. Zulfadli, Sp.OG'];
        return view('modal.edit-dokter-anestesi', compact('data', 'operators'));
        // return response()->json([$data, $operators]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DokterAnestesi::find($id);
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Pasien berhasil dihapus');
    }
}
