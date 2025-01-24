@extends('components.layout')

@section('title', 'Dashboard')

@section('content')
    <!-- Modals -->
    <div>
        @include('modal.edit-jadwal-operasi')
    </div>
    <div class="m-2">
        <form method="GET" action="{{ route('schedule.index') }}" class="form-inline my-4">
            @csrf
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="pe-3 font-monospace">
                        <a href="{{ route('schedule.create') }}" class="btn btn-sm btn-success">Tambah Data</a>
                    </div>
        
                    <div class="ms-auto justify-content-end font-monospace">
                        <div class="pe-3 font-monospace">
                            Filter Jadwal Operasi
                        </div>
                    </div>
                    <div class="font-monospace">
                        <div class="input-group">
                            <input type="text" class="form-control-sm datepicker" placeholder="Pilih Tanggal Mulai"
                                id="start_date" name="start_date" value="{{ request('start_date') ?? session('date') }}">
                            <input type="text" class="form-control-sm" placeholder="Cari No. CM" id="no_cm" name="no_cm" value="{{ request('no_cm') }}">
                            <button type="submit" class="btn btn-sm btn-primary font-monospace">Cari</button>
                        </div>
                    </div>
        
                    <div class="ps-3 font-monospace">
                        <a href="{{ route('schedule.index', ['clear_filter' => true]) }}" class="btn btn-sm btn-secondary">Hapus Filter</a>
                    </div>
                </div>
            </div>
        </form>



        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped align-middle w-auto" id="myTable">
                <thead class="table-secondary align-middle">
                    {{-- <tr>
                        <td colspan="16" class="pe-1">Dokter Anestesi hari ini : @foreach ($dokter as $anesthesiologist)
                                {{ $anesthesiologist->nama_dokter }}
                            @endforeach
                        </td>
                    </tr> --}}
                    <tr>
                        <th rowspan="3" class="text-center">No.</th>
                        <th rowspan="3" class="text-center">Tanggal Operasi</th>
                        <th rowspan="3" class="text-center">Jam Operasi</th>
                        <th rowspan="3" class="text-center">Kamar Operasi</th>
                        <th colspan="4" class="text-center">Data Pasien</th>
                        <th rowspan="3" class="text-center">Penjamin & Kelas</th>
                        <th rowspan="3" class="text-center">INDIKASI</th>
                        <th rowspan="3" class="text-center">TINDAKAN</th>
                        <th colspan="7" class="text-center">NAMA TIM OPERASI</th>
                        <th colspan="2" class="text-center">EDUKASI PERSIAPAN OPERASI</th>
                        <th colspan="3" class="text-center">HASIL PEMERIKSAAN PENUNJANG</th>
                        <th colspan="8" class="text-center">PELAKSANAAN KONSULTASI</th>
                        <th rowspan="3" class="text-center">PEMBAHASAN KELENGKAPAN KESIAPAN TINDAKAN</th>
                        <th rowspan="3" class="text-center">Verifikasi Persiapan Operasi</th>
                        <th rowspan="3" class="text-center">Mengingatkan Tim H-1</th>
                        <th rowspan="3" class="text-center">Keterangan</th>
                        <th rowspan="3" class="text-center">Status</th>
                        <th rowspan="3" colspan="2" class="text-center">Action</th>
                    </tr>
                    <tr>
                        {{-- <th class="text-center">Operasi Berakhir</th> --}}
                        <th rowspan="2" class="text-center">Nama Pasien</th>
                        <th rowspan="2" class="text-center">Usia</th>
                        <th rowspan="2" class="text-center">No. CM</th>
                        <th rowspan="2" class="text-center">BB</th>
                        <th rowspan="2" class="text-center">OPERATOR</th>
                        <th rowspan="2" class="text-center">ASISTEN</th>
                        <th rowspan="2" class="text-center">INSTRUMENTATOR</th>
                        <th rowspan="2" class="text-center">SIRKULASI</th>
                        <th rowspan="2" class="text-center">ANESTESI</th>
                        <th rowspan="2" class="text-center">PENATA ANESTESI</th>
                        <th rowspan="2" class="text-center">ANAK</th>
                        <th rowspan="2" class="text-center">JAM PUASA</th>
                        <th rowspan="2" class="text-center">JAM KEDATANGAN</th>
                        <th rowspan="2" class="text-center">LAB </th>
                        <th rowspan="2" class="text-center">RO</th>
                        <th rowspan="2" class="text-center">CT-SCAN</th>
                        <th colspan="2" class="text-center">IPD</th>
                        <th colspan="2" class="text-center">JANTUNG</th>
                        <th colspan="2" class="text-center">ANASTHESI</th>
                        <th colspan="2" class="text-center">LAIN-LAIN</th>
                        <!-- Add more table headers as needed -->
                    </tr>
                    <tr>
                        <th>TGL</th>
                        <th>HASIL</th>
                        <th>TGL</th>
                        <th>HASIL</th>
                        <th>TGL</th>
                        <th>HASIL</th>
                        <th>TGL</th>
                        <th>HASIL</th>
                    </tr>
                </thead>
                <tbody class="px-3">
                    @foreach ($data as $key => $item)
                        <tr>
                            <td class="text-center">{{ $data->firstItem() + $key }}</td>
                            <td class="text-center text-nowrap">
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->tgl_operasi)->format('d-m-Y') }}</td>
                            <td class="text-center text-nowrap">{{ $item->jam_operasi ?? 'Belum Ditentukan' }} -
                                {{ $item->jam_operasi2 ?? 'Belum Ditentukan' }}</td>
                            {{-- <td class="text-center">{{ $item->jam_operasi2 ??'-' }}</td> --}}
                            <td class="text-center px-2 text-nowrap">{{ $item->ruang_operasi }}</td>
                            <td class="text-center px-2 text-nowrap text-uppercase">{{ $item->prefix .'. '. $item->nama_pasien }}</td>
                            <td class="text-center px-2 text-nowrap">{{ $item->usia .' '. $item->s_usia }}</td>
                            <td class="text-center px-2">{{ $item->no_cm }}</td>
                            <td class="text-center px-2">{{ $item->bb }}</td>
                            <td class="text-center px-2">{{ $item->jaminan }}</td>
                            <td class="text-nowrap">{{ $item->diagnosa }}</td>
                            <td class="text-nowrap">{{ $item->tindakan }}</td>
                            <td class="text-center text-nowrap">{{ $item->dokter['nama_dokter'] }}</td>
                            <td class="text-nowrap">{{ $item->asisten }}</td>
                            <td class="text-nowrap">{{ $item->instrumentator }}</td>
                            <td class="text-nowrap">{{ $item->sirkulasi }}</td>
                            <td class="text-nowrap">{{ $item->anestesi }}</td>
                            <td class="text-nowrap">{{ $item->p_anestesi }}</td>
                            <td class="text-nowrap">{{ $item->anak }}</td>
                            <td class="text-nowrap">{{ $item->jam_puasa }}</td>
                            <td class="text-nowrap">{{ $item->jam_kedatangan }}</td>
                            <td class="text-nowrap">{{ $item->lab }}</td>
                            <td class="text-nowrap">{{ $item->ro }}</td>
                            <td class="text-nowrap">{{ $item->ct_scan }}</td>
                            <td class="text-nowrap">{{ $item->tgl_ipd }}</td>
                            <td class="text-nowrap">{{ $item->hasil_ipd }}</td>
                            <td class="text-nowrap">{{ $item->tgl_jantung }}</td>
                            <td class="text-nowrap">{{ $item->hasil_jantung }}</td>
                            <td class="text-nowrap">{{ $item->tgl_anasthesi }}</td>
                            <td class="text-nowrap">{{ $item->hasil_anasthesi }}</td>
                            <td class="text-nowrap">{{ $item->tgl_lain }}</td>
                            <td class="text-nowrap">{{ $item->hasil_lain }}</td>
                            <td class="text-nowrap">{{ $item->pkkt }}</td>
                            <td class="text-center">@if ($item->verifikasi === 'sudah')
                                <i class="fa fa-check"></i> {{-- Tanda checklist menggunakan ikon --}}
                            @endif</td>
                            <td class="text-center">@if ($item->pengingat === 'sudah')
                                <i class="fa fa-check"></i> {{-- Tanda checklist menggunakan ikon --}}
                            @endif</td>
                            <td></td>
                            {{-- <td class="text-center">{{ $item->profilaksis ?? '-' }}</td> --}}
                            <td class="text-center text-nowrap"
                                style="background-color: {{ $item->status == 'TERLAKSANA' ? 'green' : ($item->status == 'ON-PROCESS' ? 'blue' : ($item->status === 'RESCHEDULE' ? '#FF6500' : '#697565')) }}; color: white;">
                                {{-- <select onchange="updateStatus({{ $item->id }}, this.value)">
                                    @foreach ($statuses as $value => $status)
                                        <option value="{{ $value }}"
                                            {{ $item->status == $value ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select> --}}
                                {{ $item->status }}
                            </td>
                            {{-- <td class="text-center"
                                style="background-color: {{ $item->status == 'TERLAKSANA' ? 'green' : ($item->status == 'ON-PROCESS' ? 'blue' : ($item->status === 'RESCHEDULE' ? '#FF6500' : '#697565')) }}; color: white;">
                                {{ $item->status }}</td> --}}
                            <td class="text-center">
                                <a href="{{ route('schedule.edit', $item->id) }}"
                                    class="btn btn-outline-primary btn-sm mr-2"><i class="bi bi-pencil"></i></a>
                            </td>
                            <td class="text-center">
                                {{-- <form id="deleteForm" action="{{ route('schedule.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" data-confirm-delete="true"><i
                                    class="bi bi-trash"></i></button>
                            </form> --}}
                                <a href="{{ route('schedule.destroy', $item->id) }}" class="btn btn-outline-danger btn-sm"
                                    data-confirm-delete="true"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="d-flex justify-content-start">
                {{ $data->links('pagination::bootstrap-5') }}
            </div> --}}
            <div class="d-flex justify-content-between align-items-center">
                {{-- <div>
                    Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari {{ $data->total() }} data
                </div> --}}
                <div>
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
