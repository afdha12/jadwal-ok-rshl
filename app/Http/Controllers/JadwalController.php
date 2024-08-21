<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\JadwalOK;
use App\Events\DataAdded;
use App\Events\DataDeleted;
use App\Events\DataUpdated;
use Illuminate\Http\Request;
use App\Models\DokterAnestesi;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = JadwalOK::query();

        // Filter berdasarkan rentang tanggal lahir
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $query->whereBetween('tgl_operasi', [$startDate, $endDate]);
        }
        // Filter berdasarkan alamat
        if ($request->filled('ruang_operasi')) {
            $query->where('ruang_operasi', 'LIKE', '%' . $request->ruang_operasi . '%');
        }

        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('d-m-Y');
        $dokter = DokterAnestesi::where('tanggal', $today)->get();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $data = $query->orderBy('created_at', 'desc')->paginate(30);
        return view('pages.jadwal', compact('data', 'dokter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $operators = ['dr. Ade Aria Nugraha, Sp.An', 'dr. Ahmad Angga Luthfi, Sp.An', 'dr. Ali Satria, Sp.B', 'dr. Ary Rachmanto, Sp.B', 'dr. Bima Ananta Bukhori, Sp.OG', 'dr. Budi Syamhudi, Sp.OG', 'dr. Defayudina Dafilianty R., Sp.M', 'dr. Dino Rinaldi, Sp.OG(Onk)', 'dr. Gunawan Yudhistira, Sp.THT-KL', 'dr. Ikrizal, Sp.U', 'drg. Irsan Kurniawan, Sp.BM,Subsp.T.M.T.M.J(K)', 'dr. Joel Purba, Sp.OG', 'drg. Kustini Indah S, Sp.KGA', 'dr. Muhammad Dwi Nugroho, Sp.M', 'dr. Muhammad Fajrin Armin F, Sp.OT', 'dr. Muhammad Zulkarnain Hussein, Sp.OG(K)', 'dr. Nurul Islami, Sp.OG', 'dr. Nurul Azizah Busatam, Sp.BA', 'dr. Putu Junita, Sp.An (K)IC', 'dr. Ratna Dewi Puspita Sari, Sp.OG', 'dr. Ratu Fajaria, Sp.THT-KL', 'dr.  Risal Wintoko, Sp.B', 'dr. Rodiani, Sp.OG', 'dr. Sabasdin Harahap, Sp.B, MARS, FICS', 'dr. Sarlita Indah Permatasari, Sp.OG', 'dr. Taufiqurahman Rahim, Sp.OG(K)', 'dr. Teguh Astanto, Sp. B', 'dr. Fachry Rafiq Iwan, Sp.B', 'dr. Idris, Sp.OG', 'dr. Zulfadli, Sp.OG'];
        $operators = Dokter::orderBy('nama_dokter')->get();
        $optionKamar = ['Kamar 1', 'Kamar 2', 'Kamar 3'];
        $statuses = ['Belum Terlaksana', 'Terlaksana', 'On-Process'];
        return view('pages.input_jadwal', compact('operators', 'optionKamar', 'statuses'));
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
            'tgl_operasi' => 'required',
            'jam_operasi' => 'required',
            'nama_pasien' => 'required',
            'age' => 'required',
            'satuan_usia' => 'required',
            'no_cm' => 'required',
            'diagnosa' => 'required',
            'tindakan' => 'required',
            'operator' => 'required',
            'ruang_operasi' => 'required',
            'jaminan' => 'required',
            'profilaksis' => 'required',
            'status' => 'required',
        ]);

        // Gabungkan usia dengan satuan dan masukkan ke dalam array $validated
        $validated['usia'] = $validated['age'] . ' ' . $validated['satuan_usia'];
        unset($validated['age'], $validated['satuan_usia']); // Hapus field 'usia' dan 'satuan_usia' dari array $validated

        $data = JadwalOK::create($validated);
        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('d-m-Y');
        // broadcast(new DataUpdated($data));
        if ($data->tgl_operasi === $today) {
            broadcast(new DataAdded($data));
        }

        return redirect()->route('schedule.index')->with('success', 'Data berhasil disimpan.');
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
        $data = JadwalOK::find($id);
        $optionKamar = ['KAMAR 1', 'KAMAR 2', 'KAMAR 3'];
        $statuses = ['BELUM TERLAKSANA', 'TERLAKSANA', 'ON-PROCESS'];
        $operators = ['dr. Ade Aria Nugraha, Sp.An', 'dr. Ahmad Angga Luthfi, Sp.An', 'dr. Ali Satria, Sp.B', 'dr. Ary Rachmanto, Sp.B', 'dr. Bima Ananta Bukhori, Sp.OG', 'dr. Budi Syamhudi, Sp.OG', 'dr. Defayudina Dafilianty R., Sp.M', 'dr. Dino Rinaldi, Sp.OG(Onk)', 'dr. Gunawan Yudhistira, Sp.THT-KL', 'dr. Ikrizal, Sp.U', 'drg. Irsan Kurniawan, Sp.BM,Subsp.T.M.T.M.J(K)', 'dr. Joel Purba, Sp.OG', 'drg. Kustini Indah S, Sp.KGA', 'dr. Muhammad Dwi Nugroho, Sp.M', 'dr. Muhammad Fajrin Armin F, Sp.OT', 'dr. Muhammad Zulkarnain Hussein, Sp.OG(K)', 'dr. Nurul Islami, Sp.OG', 'dr. Nurul Azizah Busatam, Sp.BA', 'dr. Putu Junita, Sp.An (K)IC', 'dr. Ratna Dewi Puspita Sari, Sp.OG', 'dr. Ratu Fajaria, Sp.THT-KL', 'dr.  Risal Wintoko, Sp.B', 'dr. Rodiani, Sp.OG', 'dr. Sabasdin Harahap, Sp.B, MARS, FICS', 'dr. Sarlita Indah Permatasari, Sp.OG', 'dr. Taufiqurahman Rahim, Sp.OG(K)', 'dr. Teguh Astanto, Sp. B', 'dr. Fachry Rafiq Iwan, Sp.B', 'dr. Idris, Sp.OG', 'dr. Zulfadli, Sp.OG'];
        return view('pages.edit', compact('data', 'optionKamar', 'statuses', 'operators'));
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
        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('d-m-Y');

        $data = JadwalOK::find($id);
        $oldDate = $data->tgl_operasi;
        $data->update($request->all());
        $newDate = $data->tgl_operasi;
        // if ($data->tgl_operasi === $today) {
        //     broadcast(new DataUpdated($data));
        // }
        if ($oldDate === $today && $oldDate !== $newDate) {
            broadcast(new DataDeleted($id));
        }

        // Broadcast addition if the new date is today
        if ($newDate === $today && $oldDate !== $newDate) {
            broadcast(new DataAdded($data));
        }

        // Broadcast update if the date is today
        if ($newDate === $today) {
            broadcast(new DataUpdated($data));
        }
        return redirect()->route('schedule.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('d-m-Y');
        $data = JadwalOK::find($id);
        if ($data->tgl_operasi === $today) {
            broadcast(new DataDeleted($id));
        }
        $data->delete();
        return redirect()->back()->with('success', 'Data Pasien berhasil dihapus');
    }
}
