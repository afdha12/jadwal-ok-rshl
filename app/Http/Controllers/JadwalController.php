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

        // Hapus session pencarian jika "Hapus Filter" diakses
        if ($request->input('clear_filter')) {
            session()->forget('date');
            session()->forget('no_cm');
        }

        $query = JadwalOK::query();

        // Ambil parameter pencarian dari query string atau session
        $date = $request->input('start_date') ?? session('date');
        $no_cm = $request->input('no_cm') ?? session('no_cm');

        if ($date) {
            // Simpan ke session
            session(['date' => $date]);

            // Format tanggal dan filter data
            $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
            $query->where('tgl_operasi', $formattedDate);
        }

        if ($no_cm) {
            // Simpan ke session
            session(['no_cm' => $no_cm]);

            // Filter data berdasarkan no_cm
            $query->where('no_cm', 'like', '%' . $no_cm . '%');
        }

        // Data tambahan lainnya
        $now = Carbon::now()->setTimezone('Asia/Jakarta');
        $today = $now->format('Y-m-d');
        $operators = Dokter::orderBy('nama_dokter')->get();
        $dokter = DokterAnestesi::where('tanggal', $today)->get();
        $statuses = ['BELUM TERLAKSANA' => 'BELUM TERLAKSANA', 'TERLAKSANA' => 'TERLAKSANA', 'ON-PROCESS' => 'ON-PROCESS', 'RESCHEDULE' => 'RESCHEDULE'];
        $optionKamar = ['Kamar 1', 'Kamar 2', 'Kamar 3'];

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $data = $query->orderByRaw("CASE WHEN tgl_operasi = ? THEN 0 ELSE 1 END, tgl_operasi DESC", [$today])
            ->orderBy('ruang_operasi', 'asc')
            ->orderBy('jam_operasi', 'asc')
            ->paginate(30);

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
        $operators = Dokter::where('spesialis', 'anestesi')->get();
        $optionKamar = ['KAMAR 1', 'KAMAR 2', 'KAMAR 3'];
        $statuses = ['BELUM TERLAKSANA', 'ON-PROCESS', 'TERLAKSANA', 'RESCHEDULE'];
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
        $validated = $request->validate([
            'tgl_operasi' => 'required',
            'jam_operasi' => 'nullable',
            'jam_operasi2' => 'nullable',
            'prefix' => 'nullable',
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

        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('Y-m-d');

        // Muat relasi dokter
        $data->load('dokter');

        // Gabungkan usia dan s_usia
        $data->usia_s_usia = $data->usia . ' ' . $data->s_usia;

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
        $data = JadwalOK::with('dokter')->findOrFail($id);
        $optionKamar = ['KAMAR 1', 'KAMAR 2', 'KAMAR 3'];
        $statuses = ['BELUM TERLAKSANA', 'ON-PROCESS', 'TERLAKSANA', 'RESCHEDULE'];
        $operators = Dokter::where('spesialis', 'anestesi')->get();
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
        $data = JadwalOK::find($id);
        $oldDate = $data->tgl_operasi;

        // $data->update($request->all());

        $validated = $request->validate([
            'tgl_operasi' => 'required',
            'jam_operasi' => 'nullable',
            'jam_operasi2' => 'nullable',
            'prefix' => 'nullable',
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
        // $validated['usia'] = $validated['age'] . ' ' . $validated['satuan_usia'];
        // unset($validated['age'], $validated['satuan_usia']); // Hapus field 'usia' dan 'satuan_usia' dari array $validated

        $validated['tgl_operasi'] = Carbon::createFromFormat('d-m-Y', $validated['tgl_operasi'])->format('Y-m-d'); // Konversi ke format Y-m-d

        $data->update($validated);

        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('Y-m-d');

        // Muat relasi dokter
        $data->load('dokter');

        // Gabungkan usia dan s_usia
        $data->usia_s_usia = $data->usia . ' ' . $data->s_usia;

        $now = Carbon::now();
        $now->setTimezone('Asia/Jakarta');
        $today = $now->format('Y-m-d');
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

        // Redirect kembali ke index dengan query pencarian terakhir
        // return redirect()->route('schedule.index') . $lastSearch->with('success', 'Data berhasil diubah.');
        return redirect()->route('schedule.index', ['start_date' => session('date')])
            ->with('success', 'Data berhasil diubah.');

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
        $today = $now->format('Y-m-d');
        $data = JadwalOK::find($id);
        if ($data->tgl_operasi === $today) {
            broadcast(new DataDeleted($id));
        }
        $data->delete();
        return redirect()->back()->with('success', 'Data Pasien berhasil dihapus');
    }

    // public function getAvailableTimes(Request $request)
    // {
    //     $date = $request->tgl_operasi;
    //     $room = $request->ruang_operasi;
    //     $editId = $request->edit_id; // ID untuk jadwal yang sedang diedit

    //     if (!$date || !$room) {
    //         return response()->json([], 200);
    //     }

    //     $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

    //     $query = JadwalOK::query()
    //         ->where('tgl_operasi', $formattedDate)
    //         ->where('ruang_operasi', $room);

    //     // Jangan filter jadwal yang sedang diedit
    //     if ($editId) {
    //         $query->where('id', '!=', $editId);
    //     }

    //     $existingSchedules = $query->orderBy('jam_operasi')->get();

    //     // Ambil semua jam dari 08:00 hingga 17:00
    //     $allTimes = [];
    //     $startTime = Carbon::createFromTime(8, 0);
    //     $endOfDay = Carbon::createFromTime(24, 0);

    //     while ($startTime < $endOfDay) {
    //         $allTimes[] = $startTime->format('H:i');
    //         $startTime->addMinutes(30);
    //     }

    //     // Blok jam berdasarkan jadwal yang ada
    //     $blockedTimes = [];
    //     foreach ($existingSchedules as $schedule) {
    //         $start = Carbon::createFromFormat('H:i', $schedule->jam_operasi);
    //         $end = Carbon::createFromFormat('H:i', $schedule->jam_operasi2);

    //         while ($start <= $end) {
    //             $blockedTimes[] = $start->format('H:i');
    //             $start->addMinutes(30);
    //         }
    //     }

    //     // Ambil jadwal sebelumnya
    //     $currentSchedule = null;
    //     if ($editId) {
    //         $currentSchedule = JadwalOK::find($editId);
    //     }

    //     // Tambahkan jam operasi sebelumnya ke daftar yang tersedia
    //     if ($currentSchedule) {
    //         $blockedTimes = array_diff($blockedTimes, [$currentSchedule->jam_operasi]);
    //     }

    //     $availableTimes = array_diff($allTimes, $blockedTimes);
    //     sort($availableTimes);

    //     return response()->json(array_values($availableTimes));
    // }

    public function getAvailableTimes(Request $request)
    {
        $date = $request->tgl_operasi;
        $room = $request->ruang_operasi;
        $editId = $request->edit_id; // ID untuk jadwal yang sedang diedit

        if (!$date || !$room) {
            return response()->json([], 200);
        }

        $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

        $query = JadwalOK::query()
            ->where('tgl_operasi', $formattedDate)
            ->where('ruang_operasi', $room);

        // Jangan filter jadwal yang sedang diedit
        if ($editId) {
            $query->where('id', '!=', $editId);
        }

        $existingSchedules = $query->orderBy('jam_operasi')->get();

        // Buat daftar jam dari 08:00 hingga 07:30 dalam satu hari
        $allTimes = [];

        // Tambahkan jam dari 08:00 - 23:30
        $startTime = Carbon::createFromTime(8, 0);
        $endOfDay = Carbon::createFromTime(23, 30);
        while ($startTime <= $endOfDay) {
            $allTimes[] = $startTime->format('H:i');
            $startTime->addMinutes(30);
        }

        // Tambahkan jam dari 00:00 - 07:30
        $startTime = Carbon::createFromTime(0, 0);
        $endMorning = Carbon::createFromTime(7, 30);
        while ($startTime <= $endMorning) {
            $allTimes[] = $startTime->format('H:i');
            $startTime->addMinutes(30);
        }

        // Blok jam berdasarkan jadwal yang ada
        $blockedTimes = [];
        foreach ($existingSchedules as $schedule) {
            $start = Carbon::createFromFormat('H:i', $schedule->jam_operasi);
            $end = Carbon::createFromFormat('H:i', $schedule->jam_operasi2);

            while ($start <= $end) {
                $blockedTimes[] = $start->format('H:i');
                $start->addMinutes(30);
            }
        }

        // Hapus waktu yang berada di antara dua operasi jika selisihnya ≤ 1 jam
        for ($i = 0; $i < count($existingSchedules) - 1; $i++) {
            $currentEnd = Carbon::createFromFormat('H:i', $existingSchedules[$i]->jam_operasi2);
            $nextStart = Carbon::createFromFormat('H:i', $existingSchedules[$i + 1]->jam_operasi);

            if ($currentEnd->diffInMinutes($nextStart) <= 60) {
                // Hapus waktu di antara operasi ini
                $gapStart = $currentEnd->copy()->addMinutes(30);
                while ($gapStart < $nextStart) {
                    $blockedTimes[] = $gapStart->format('H:i');
                    $gapStart->addMinutes(30);
                }
            }
        }

        // Hapus waktu yang kurang dari 30 menit sebelum operasi dimulai
        foreach ($existingSchedules as $schedule) {
            $start = Carbon::createFromFormat('H:i', $schedule->jam_operasi)->subMinutes(30);
            while ($start < Carbon::createFromFormat('H:i', $schedule->jam_operasi)) {
                $blockedTimes[] = $start->format('H:i');
                $start->addMinutes(30);
            }
        }

        // Ambil jadwal yang sedang diedit jika ada
        $currentSchedule = null;
        if ($editId) {
            $currentSchedule = JadwalOK::find($editId);
        }

        // Tambahkan jam operasi sebelumnya ke daftar yang tersedia
        if ($currentSchedule) {
            $blockedTimes = array_diff($blockedTimes, [$currentSchedule->jam_operasi]);
        }

        // Filter waktu yang tersedia
        $availableTimes = array_diff($allTimes, $blockedTimes);

        return response()->json(array_values($availableTimes));
    }


    // public function getAvailableDoctors(Request $request)
    // {
    //     $date = $request->tgl_operasi;
    //     $room = $request->ruang_operasi;
    //     $startTime = $request->jam_operasi;

    //     // Validasi input
    //     if (!$date || !$room || !$startTime) {
    //         return response()->json([], 200); // Kembalikan data kosong jika input tidak lengkap
    //     }

    //     // Format tanggal ke Y-m-d
    //     $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

    //     // Ambil waktu mulai dan akhiri jadwal operasi
    //     $start = Carbon::createFromFormat('H:i', $startTime);
    //     $end = $start->copy()->addHour(); // Misalnya durasi operasi 1 jam

    //     // Ambil dokter yang sudah memiliki jadwal di waktu dan tanggal yang sama
    //     $conflictedDoctors = JadwalOK::where('tgl_operasi', $formattedDate)
    //         ->where(function ($query) use ($start, $end) {
    //             $query->whereBetween('jam_operasi', [$start->format('H:i'), $end->format('H:i')])
    //                 ->orWhereBetween('jam_operasi2', [$start->format('H:i'), $end->format('H:i')]);
    //         })
    //         ->pluck('dokter_id')
    //         ->toArray();

    //     // Ambil dokter yang tidak memiliki konflik jadwal
    //     $availableDoctors = Dokter::whereNotIn('id', $conflictedDoctors)->get();

    //     // Kembalikan hasil
    //     return response()->json($availableDoctors);
    // }

    public function getAvailableDoctors(Request $request)
    {
        $date = $request->tgl_operasi;
        $room = $request->ruang_operasi;
        $startTime = $request->jam_operasi;
        $editId = $request->edit_id; // ID untuk jadwal yang sedang diedit

        // Validasi input
        if (!$date || !$room || !$startTime) {
            return response()->json([], 200); // Kembalikan data kosong jika input tidak lengkap
        }

        // Format tanggal ke Y-m-d
        $formattedDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

        // Ambil waktu mulai dan akhiri jadwal operasi
        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = $start->copy()->addHour(); // Misalnya durasi operasi 1 jam

        // Ambil dokter yang sudah memiliki jadwal di waktu dan tanggal yang sama
        $conflictedDoctorsQuery = JadwalOK::where('tgl_operasi', $formattedDate)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('jam_operasi', [$start->format('H:i'), $end->format('H:i')])
                    ->orWhereBetween('jam_operasi2', [$start->format('H:i'), $end->format('H:i')]);
            });

        // Jika edit_id ada, maka kecualikan jadwal yang sedang diedit
        if ($editId) {
            // Kecualikan dokter yang sedang diedit
            $conflictedDoctorsQuery->where('id', '!=', $editId);
        }

        // Ambil dokter yang memiliki konflik
        $conflictedDoctors = $conflictedDoctorsQuery->pluck('dokter_id')->toArray();

        // Ambil dokter yang tidak memiliki konflik jadwal
        $availableDoctors = Dokter::whereNotIn('id', $conflictedDoctors);

        // Jika edit_id ada, tambahkan dokter yang sedang diedit dalam hasil
        if ($editId) {
            $doctorBeingEdited = Dokter::find($editId);
            if ($doctorBeingEdited) {
                $availableDoctors->union(Dokter::where('id', $doctorBeingEdited->id));
            }
        }

        // Kembalikan hasil
        return response()->json($availableDoctors->get());
    }

}
