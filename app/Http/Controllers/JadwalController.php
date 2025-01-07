<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\JadwalOK;
use App\Events\DataAdded;
use App\Events\DataDeleted;
use App\Events\DataUpdated;
use Illuminate\Http\Request;
use App\Events\StatusUpdated;
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
        // if ($request->filled('start_date') && $request->filled('end_date')) {
        if ($request->filled('start_date')) {
            $date = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
            // $startDate = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
            // $endDate = Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');
            // $query->whereBetween('tgl_operasi', [$startDate, $endDate]);
            $query->where('tgl_operasi', [$date]);
        }
        // Filter berdasarkan alamat
        // if ($request->filled('ruang_operasi')) {
        //     $query->where('ruang_operasi', 'LIKE', '%' . $request->ruang_operasi . '%');
        // }

        // Cek apakah terdapat filter tanggal di query string
        $date = $request->input('start_date');
        session(['date' => $date]);

        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('Y-m-d');
        $operators = Dokter::orderBy('nama_dokter')->get();
        $dokter = DokterAnestesi::where('tanggal', $today)->get();
        $statuses = ['BELUM TERLAKSANA' => 'BELUM TERLAKSANA', 'TERLAKSANA' => 'TERLAKSANA', 'ON-PROCESS' => 'ON-PROCESS', 'RESCHEDULE' => 'RESCHEDULE'];
        $optionKamar = ['Kamar 1', 'Kamar 2', 'Kamar 3'];

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $data = $query->orderBy('tgl_operasi', 'desc')->orderBy('jam_operasi', 'asc')->paginate(30);
        return view('pages.jadwal', compact('data', 'dokter', 'statuses', 'optionKamar', 'operators', 'date'));
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
        $optionKamar = ['KAMAR 1', 'KAMAR 2', 'KAMAR 3'];
        $statuses = ['Belum Terlaksana', 'Terlaksana', 'On-Process', 'Reschedule'];
        $docs = ['Ada', 'Tidak Ada'];
        $penjamin = ['A1', 'A2', 'A3'];
        return view('pages.input_jadwal', compact('operators', 'optionKamar', 'statuses', 'docs', 'penjamin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('d-m-Y');

        $validated = $request->validate([
            'tgl_operasi' => 'required',
            'jam_operasi' => 'nullable',
            'nama_pasien' => 'required',
            'usia' => 'required',
            's_usia' => 'nullable',
            'no_cm' => 'required',
            'diagnosa' => 'nullable',
            'tindakan' => 'nullable',
            'dokter_id' => 'nullable',
            'ruang_operasi' => 'nullable',
            'jaminan' => 'nullable',
            'profilaksis' => 'nullable',
            'status' => 'nullable',
            'bb' => 'nullable',
            'asisten' => 'nullable',
            'instrumentator' => 'nullable',
            'sirkulasi' => 'nullable',
            'anestesi' => 'nullable',
            'p_anestesi' => 'nullable',
            'anak' => 'nullable',
            'jam_puasa' => 'nullable',
            'jam_kedatangan' => 'nullable',
            'lab' => 'nullable',
            'ro' => 'nullable',
            'ct_scan' => 'nullable',
            'tgl_ipd' => 'nullable',
            'hasil_ipd' => 'nullable',
            'tgl_jantung' => 'nullable',
            'hasil_jantung' => 'nullable',
            'tgl_lain' => 'nullable',
            'hasil_lain' => 'nullable',
            'pkkt' => 'nullable',
            'verifikasi' => 'nullable',
            'pengingat' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        // Gabungkan usia dengan satuan dan masukkan ke dalam array $validated
        // $validated['usia'] = $validated['age'] . ' ' . $validated['satuan_usia'];
        // unset($validated['age'], $validated['satuan_usia']); // Hapus field 'usia' dan 'satuan_usia' dari array $validated

        $validated['tgl_operasi'] = Carbon::createFromFormat('d-m-Y', $validated['tgl_operasi'])->format('Y-m-d'); // Konversi ke format Y-m-d

        // Hitung jam selesai operasi dengan durasi operasi
        // $duration = $validated['duration'] ?? 0; // Default 0 jika tidak ada durasi
        // $endTime = Carbon::createFromFormat('H:i', $validated['jam_operasi'])->addMinutes($duration);

        // Cek konflik jadwal operasi dengan jeda 30 menit
        $conflict = JadwalOK::where('tgl_operasi', $validated['tgl_operasi'])
            ->where('ruang_operasi', $request->ruang_operasi)
            ->where(function ($query) use ($request) {
                $query->whereTime('jam_operasi', '<=', Carbon::parse($request->jam_operasi)->addMinutes(30))
                    ->whereTime('jam_operasi2', '>=', Carbon::parse($request->jam_operasi));
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['error' => 'Jadwal di ruang operasi sudah terdaftar pada waktu tersebut.']);
        }

        // Tambahkan jam selesai ke dalam data yang akan disimpan
        // $validated['jam_operasi2'] = $endTime->format('H:i');

        $data = JadwalOK::create($validated);

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
        $statuses = ['BELUM TERLAKSANA', 'TERLAKSANA', 'ON-PROCESS', 'RESCHEDULE'];
        $operators = Dokter::orderBy('nama_dokter')->get();
        $docs = ['Ada', 'Tidak Ada'];
        // $operators = ['dr. Ade Aria Nugraha, Sp.An', 'dr. Ahmad Angga Luthfi, Sp.An', 'dr. Ali Satria, Sp.B', 'dr. Ary Rachmanto, Sp.B', 'dr. Bima Ananta Bukhori, Sp.OG', 'dr. Budi Syamhudi, Sp.OG', 'dr. Defayudina Dafilianty R., Sp.M', 'dr. Dino Rinaldi, Sp.OG(Onk)', 'dr. Gunawan Yudhistira, Sp.THT-KL', 'dr. Ikrizal, Sp.U', 'drg. Irsan Kurniawan, Sp.BM,Subsp.T.M.T.M.J(K)', 'dr. Joel Purba, Sp.OG', 'drg. Kustini Indah S, Sp.KGA', 'dr. Muhammad Dwi Nugroho, Sp.M', 'dr. Muhammad Fajrin Armin F, Sp.OT', 'dr. Muhammad Zulkarnain Hussein, Sp.OG(K)', 'dr. Nurul Islami, Sp.OG', 'dr. Nurul Azizah Busatam, Sp.BA', 'dr. Putu Junita, Sp.An (K)IC', 'dr. Ratna Dewi Puspita Sari, Sp.OG', 'dr. Ratu Fajaria, Sp.THT-KL', 'dr.  Risal Wintoko, Sp.B', 'dr. Rodiani, Sp.OG', 'dr. Sabasdin Harahap, Sp.B, MARS, FICS', 'dr. Sarlita Indah Permatasari, Sp.OG', 'dr. Taufiqurahman Rahim, Sp.OG(K)', 'dr. Teguh Astanto, Sp. B', 'dr. Fachry Rafiq Iwan, Sp.B', 'dr. Idris, Sp.OG', 'dr. Zulfadli, Sp.OG'];
        return view('pages.new_edit_jadwal', compact('data', 'optionKamar', 'statuses', 'operators', 'docs'));
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
        // $data->update($request->all());

        $validated = $request->validate([
            'tgl_operasi' => 'required',
            'jam_operasi' => 'nullable',
            'nama_pasien' => 'required',
            'usia' => 'required',
            's_usia' => 'required',
            'no_cm' => 'required',
            'diagnosa' => 'required',
            'tindakan' => 'required',
            'dokter_id' => 'required',
            'ruang_operasi' => 'required',
            'jaminan' => 'required',
            'profilaksis' => 'nullable',
            'status' => 'nullable',
            'bb' => 'nullable',
            'asisten' => 'nullable',
            'instrumentator' => 'nullable',
            'sirkulasi' => 'nullable',
            'anestesi' => 'nullable',
            'p_anestesi' => 'nullable',
            'anak' => 'nullable',
            'jam_puasa' => 'nullable',
            'jam_kedatangan' => 'nullable',
            'lab' => 'nullable',
            'ro' => 'nullable',
            'ct_scan' => 'nullable',
            'tgl_ipd' => 'nullable',
            'hasil_ipd' => 'nullable',
            'tgl_jantung' => 'nullable',
            'hasil_jantung' => 'nullable',
            'tgl_anasthesi' => 'nullable',
            'hasil_anasthesi' => 'nullable',
            'tgl_lain' => 'nullable',
            'hasil_lain' => 'nullable',
            'pkkt' => 'nullable',
            'verifikasi' => 'nullable',
            'pengingat' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        // Gabungkan usia dengan satuan dan masukkan ke dalam array $validated
        $validated['usia'] = $validated['age'] . ' ' . $validated['satuan_usia'];
        unset($validated['age'], $validated['satuan_usia']); // Hapus field 'usia' dan 'satuan_usia' dari array $validated

        $validated['tgl_operasi'] = Carbon::createFromFormat('d-m-Y', $validated['tgl_operasi'])->format('Y-m-d'); // Konversi ke format Y-m-d

        $data->update($validated);
        // Ambil filter dari session
        $dateSession = session('date');

        $newDate = $validated['tgl_operasi'];
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
        return redirect()->route('schedule.index', ['date' => $dateSession])->with('success', 'Data berhasil diubah.');
    }

    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'nullable',
        ]);

        $data = JadwalOK::findOrFail($id);
        // $data->status = $validatedData['status'];
        // $data->save();
        // Hanya lakukan broadcast jika status berubah
        if ($data->status !== $validatedData['status']) {
            // Update status pada data
            $data->update(['status' => $validatedData['status']]);

            // Broadcast event dengan id dan status
            broadcast(new StatusUpdated($data->id, $data->status))->toOthers();
        }
        // JadwalOK::where('id', $id)->update(['status' => $validatedData['status']]);

        return response()->with('success', 'Data berhasil diubah.');
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

    // public function getAvailableTimes(Request $request)
    // {
    //     // Ambil input dari request
    //     $date = $request->tgl_operasi;
    //     $room = $request->ruang_operasi;

    //     // Pastikan input ruangan dan tanggal ada
    //     if (!$date || !$room) {
    //         return response()->json([], 200); // Kembalikan data kosong jika salah satu input tidak ada
    //     }

    //     // Format tanggal ke Y-m-d
    //     $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

    //     // Ambil jadwal operasi berdasarkan filter tanggal dan ruangan
    //     $existingSchedules = JadwalOK::query()
    //         ->where('tgl_operasi', $formattedDate)
    //         ->where('ruang_operasi', $room)
    //         ->orderBy('jam_operasi')
    //         ->get();

    //     // Definisikan jam operasi mulai dari 08:00 hingga 17:00
    //     $allTimes = [];
    //     $startTime = Carbon::createFromTime(8, 0);
    //     $endOfDay = Carbon::createFromTime(17, 0);

    //     while ($startTime < $endOfDay) {
    //         $allTimes[] = $startTime->format('H:i');
    //         $startTime->addMinutes(30);
    //     }

    //     // Filter waktu yang tidak tersedia
    //     $blockedTimes = [];
    //     foreach ($existingSchedules as $schedule) {
    //         $start = Carbon::createFromFormat('H:i', $schedule->jam_operasi);
    //         $end = Carbon::createFromFormat('H:i', $schedule->jam_operasi2);

    //         // Tambahkan semua waktu dalam rentang mulai hingga selesai ke blockedTimes
    //         $current = $start->copy();
    //         while ($current <= $end) { // Termasuk jam selesai
    //             $blockedTimes[] = $current->format('H:i');
    //             $current->addMinutes(30);
    //         }
    //     }

    //     // Filter hanya waktu yang tidak ada di blockedTimes
    //     $availableTimes = array_diff($allTimes, $blockedTimes);

    //     // Urutkan waktu
    //     sort($availableTimes);

    //     return response()->json(array_values($availableTimes));
    // }

    public function getAvailableTimes(Request $request)
    {
        $date = $request->tgl_operasi;
        $room = $request->ruang_operasi;
        $editId = $request->id; // ID jadwal yang sedang diedit

        if (!$date || !$room) {
            return response()->json([], 200);
        }

        $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

        // Ambil semua jadwal kecuali jadwal yang sedang diedit
        $query = JadwalOK::query()
            ->where('tgl_operasi', $formattedDate)
            ->where('ruang_operasi', $room);
        if ($editId) {
            $query->where('id', '!=', $editId); // Kecualikan jadwal yang sedang diedit
        }
        $existingSchedules = $query->orderBy('jam_operasi')->get();

        // Definisikan jam operasi mulai dari 08:00 hingga 17:00
        $allTimes = [];
        $startTime = Carbon::createFromTime(8, 0);
        $endOfDay = Carbon::createFromTime(17, 0);

        while ($startTime < $endOfDay) {
            $allTimes[] = $startTime->format('H:i');
            $startTime->addMinutes(30);
        }

        // Waktu yang diblokir
        $blockedTimes = [];
        foreach ($existingSchedules as $schedule) {
            $start = Carbon::createFromFormat('H:i', $schedule->jam_operasi);
            $end = Carbon::createFromFormat('H:i', $schedule->jam_operasi2);

            $current = $start->copy();
            while ($current <= $end) {
                $blockedTimes[] = $current->format('H:i');
                $current->addMinutes(30);
            }
        }

        // Waktu yang tersedia
        $availableTimes = array_diff($allTimes, $blockedTimes);

        // Tambahkan waktu jadwal yang sedang diedit agar tetap tersedia
        if ($editId) {
            $currentSchedule = JadwalOK::find($editId);
            if ($currentSchedule) {
                $availableTimes[] = $currentSchedule->jam_operasi;
                $availableTimes[] = $currentSchedule->jam_operasi2;
            }
        }

        sort($availableTimes);

        return response()->json(array_values($availableTimes));
    }


}
