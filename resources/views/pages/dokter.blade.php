@extends('components.layout')

@section('title', 'Data Dokter')

@section('content')
    <div class="m-3">

        <div class="pt-2 mx-5">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-dokter"
                aria-current="page">
                Tambah Dokter
            </button>
            
            <table class="table table-sm table-bordered table-striped align-middle mt-3" style="width:100%" id="myTable">
                <thead class="table-secondary align-middle">
                    <tr>
                        <th class="text-center ">No.</th>
                        <th class="text-center">Nama Dokter</th>
                        <th colspan="2" class="text-center">Action</th>
                        <!-- Add more table headers as needed -->
                    </tr>
                </thead>
                <tbody class="px-3">
                    @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item->nama_dokter }}</td>
                            <td class="text-center">
                                <a href="{{ route('dokter.edit', $item->id) }}" class="btn btn-outline-primary btn-sm mr-2"
                                    data-bs-toggle="modal" data-bs-target="#editDokter{{ $item->id }}"><i
                                        class="bi bi-pencil"></i></i></a>
                            </td>
                            <td class="text-center">
                                {{-- <form id="deleteForm" action="{{ route('dokter.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        data-confirm-delete="true"><i class="bi bi-trash"></i></button>
                                </form> --}}
                                <a href="{{ route('dokter.destroy', $item->id) }}" class="btn btn-outline-danger btn-sm"
                                    data-confirm-delete="true"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                @include('modal.tambah-dokter')
                @include('modal.edit-dokter')
            </div>
            <div class="d-flex justify-content-end">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
