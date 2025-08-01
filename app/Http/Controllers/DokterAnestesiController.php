<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\DokterAnestesi;

class DokterAnestesiController extends Controller
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
        $operators = Dokter::where('spesialis', 'anestesi')->get();
        $data = DokterAnestesi::with('dokter')->orderBy('tanggal', 'desc')->paginate(30);
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
        $validated = $request->validate([
            'tanggal' => 'required',
            'dokter_id' => 'nullable',
        ]);

        $validated['tanggal'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal'])->format('Y-m-d'); // Konversi ke format Y-m-d

        DokterAnestesi::create($validated);
        return redirect()->route('dokter-anestesi.index')->with('success', 'Data berhasil disimpan.');
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
        $operators = Dokter::where('spesialis', 'anestesi')->get();
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
        $validated = $request->validate([
            'tanggal' => 'required',
            'dokter_id' => 'nullable',
        ]);
        // $oldDate = $data->tgl_operasi;
        
        $validated['tanggal'] = Carbon::createFromFormat('d-m-Y', $validated['tanggal'])->format('Y-m-d'); // Konversi ke format Y-m-d
        $data->update($validated);

        return redirect()->route('dokter-anestesi.index')->with('success', 'Data berhasil diubah.');
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
        
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
