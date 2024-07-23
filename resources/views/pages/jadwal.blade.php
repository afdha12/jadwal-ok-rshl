@extends('components.layout')

@section('title', 'Dashboard')

@section('content')
    <form method="GET" action="{{ route('schedule.index') }}" class="form-inline my-4">
        @csrf
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <div class="pe-3 align-self-center font-monospace">
                    Filter Jadwal Operasi
                </div>
                <div class="px-3 align-self-center font-monospace">
                    <input type="text" class="form-control-sm datepicker" placeholder="Pilih Tanggal Mulai" id="start_date"
                        name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="px-3 align-self-center font-monospace">
                    <input type="text" class="form-control-sm datepicker" placeholder="Sampai Tanggal" id="end_date"
                        name="end_date" value="{{ request('end_date') }}">
                </div>
                
                <div class="px-3 justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary font-monospace">Cari</button>
                </div>
                <div class="px-3 justify-content-end">
                    <a href="{{ route('schedule.index') }}" class="btn btn-sm btn-secondary">Hapus Filter</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>
    </form>
    <div class="table-responsive m-2">
        <table class="table table-sm table-bordered table-striped align-middle" style="width:100%" id="myTable">
            <thead class="table-secondary align-middle">
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Tanggal Operasi</th>
                    <th class="text-center">Jam Operasi</th>
                    <th class="text-center">Nama Pasien</th>
                    <th class="text-center">Usia</th>
                    <th class="text-center">No. CM</th>
                    <th class="text-center">Diagnosa</th>
                    <th class="text-center">Tindakan</th>
                    <th class="text-center">Operator</th>
                    <th class="text-center">Ruang Operasi</th>
                    <th class="text-center">Jaminan</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Status</th>
                    <th colspan="2" class="text-center">Action</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody class="px-3">
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $item->tgl_operasi }}</td>
                        <td class="text-center">{{ $item->jam_operasi }}</td>
                        <td class="text-center">{{ $item->nama_pasien }}</td>
                        <td class="text-center">{{ $item->usia }}</td>
                        <td class="text-center">{{ $item->no_cm }}</td>
                        <td>{{ $item->diagnosa }}</td>
                        <td>{{ $item->tindakan }}</td>
                        <td class="text-center">{{ $item->operator }}</td>
                        <td class="text-center">{{ $item->ruang_operasi }}</td>
                        <td class="text-center">{{ $item->jaminan }}</td>
                        <td class="text-center">{{ $item->profilaksis }}</td>
                        <td class="text-center"
                            style="background-color: {{ $item->status == 'TERLAKSANA' ? 'green' : ($item->status == 'ON-PROCESS' ? 'blue' : 'red') }}; color: white;">
                            {{ $item->status }}</td>
                        <td class="text-center">
                            <a href="{{ route('schedule.edit', $item->id) }}"
                                class="btn btn-outline-primary btn-sm mr-2"><i class="bi bi-pencil"></i></i></a>
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
        <div class="d-flex justify-content-end">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
