@extends('components.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="table-responsive">
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
                        <td class="text-center">
                            <a href="{{ route('schedule.edit', $item->id) }}"
                                class="btn btn-outline-primary btn-sm mr-2"><i class="bi bi-pencil"></i></i></a>
                        </td>
                        <td class="text-center">
                            <form id="deleteForm" action="{{ route('schedule.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Apakah yakin ingin menghapus data pasien ini?')"><i
                                        class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
