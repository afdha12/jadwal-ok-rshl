@extends('components.layout')

@section('title', 'Dashboard')

@section('content')
    <!-- Modals dihilangkan karena menggunakan halaman edit terpisah -->
    <div class="m-2">
        <form method="GET" action="{{ route('schedule.index') }}" class="my-4">
            @csrf
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between w-full">
                <!-- Tambah Data -->
                <div>
                    <a href="{{ route('schedule.create') }}" class="btn btn-sm btn-success text-white">
                        <i class="bi bi-plus-lg"></i> Tambah Data
                    </a>
                </div>

                <!-- Spacer on large screens, pushes filter to the right -->
                <div class="flex-grow hidden md:block"></div>

                <!-- Filter Controls -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="font-semibold text-sm mr-2">Filter Jadwal Operasi</span>

                    <div class="input-group input-group-sm" style="width: auto;">
                        <input type="text" class="form-control form-control-sm datepicker"
                            placeholder="Pilih Tanggal Mulai" id="start_date" name="start_date"
                            value="{{ request('start_date') ?? session('date') }}">
                        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                    </div>

                    <a href="{{ route('schedule.index', ['clear_filter' => true]) }}"
                        class="btn btn-sm btn-outline-secondary">Hapus Filter</a>
                </div>
            </div>
        </form>

        <table class="table table-sm table-bordered table-striped align-middle w-100" id="jadwalTable"
            style="min-width: 1000px;">
            <thead class="table-secondary align-middle">
                <tr>
                    <th rowspan="3" class="text-center">No.</th>
                    <th rowspan="3" class="text-center">Tanggal Operasi</th>
                    <th rowspan="3" class="text-center">Jam Operasi</th>
                    <th rowspan="3" class="text-center">Kamar Operasi</th>
                    <th colspan="4" class="text-center">Data Pasien</th>
                    <th rowspan="3" class="text-center">Penjamin & Kelas</th>
                    <th rowspan="3" class="text-center">INDIKASI</th>
                    <th rowspan="3" class="text-center">TINDAKAN</th>
                    <th colspan="3" class="text-center">NAMA TIM OPERASI</th>
                    <th rowspan="3" class="text-center">CATATAN HASIL PEMERIKSAAN PENUNJANG</th>
                    <th colspan="8" class="text-center">PELAKSANAAN KONSULTASI</th>
                    <th rowspan="3" class="text-center">Verifikasi Persiapan Operasi</th>
                    <th rowspan="3" class="text-center">Keterangan</th>
                    <th rowspan="3" class="text-center">Status</th>
                    <th rowspan="3" colspan="2" class="text-center">Action</th>
                </tr>
                <tr>
                    <th rowspan="2" class="text-center">Nama Pasien</th>
                    <th rowspan="2" class="text-center">Usia</th>
                    <th rowspan="2" class="text-center">No. CM</th>
                    <th rowspan="2" class="text-center">BB</th>
                    <th rowspan="2" class="text-center">OPERATOR</th>
                    <th rowspan="2" class="text-center">ASISTEN</th>
                    <th rowspan="2" class="text-center">ANESTESI</th>
                    <th colspan="2" class="text-center">IPD</th>
                    <th colspan="2" class="text-center">JANTUNG</th>
                    <th colspan="2" class="text-center">ANASTHESI</th>
                    <th colspan="2" class="text-center">LAIN-LAIN</th>
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
                <!-- DataTables will populate this -->
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <style>
        /* DataTables Professional Styling */
        #jadwalTable_wrapper .dataTables_length,
        #jadwalTable_wrapper .dataTables_filter,
        #jadwalTable_wrapper .dataTables_info,
        #jadwalTable_wrapper .dataTables_paginate {
            font-size: 0.875rem;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            color: #4b5563;
        }

        #jadwalTable_wrapper .dataTables_length select {
            display: inline-block;
            width: auto;
            margin: 0 0.25rem;
        }

        #jadwalTable_wrapper .dataTables_filter input {
            display: inline-block;
            width: auto;
            margin-left: 0.5rem;
        }

        #jadwalTable thead th {
            background-color: #e5e7eb;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem 0.5rem;
            vertical-align: middle;
            white-space: nowrap;
        }

        #jadwalTable tbody td {
            font-size: 0.875rem;
            padding: 0.5rem;
            vertical-align: middle;
        }

        #jadwalTable tbody tr:hover {
            background-color: rgba(243, 244, 246, 0.7);
            transition: background-color 150ms ease-in-out;
        }

        #jadwalTable_wrapper .dataTables_paginate .page-link {
            font-size: 0.85rem;
            padding: 0.35rem 0.7rem;
        }
    </style>

    <script>
        $(document).ready(function() {
            var table = $('#jadwalTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: '{{ route('schedule.index') }}',
                    data: function(d) {
                        d.start_date = $('#start_date').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'tgl_operasi',
                        name: 'tgl_operasi',
                        className: 'text-center text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'jam_operasi_full',
                        name: 'jam_operasi',
                        className: 'text-center text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'ruang_operasi',
                        name: 'ruang_operasi',
                        className: 'text-center px-2 text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'nama_pasien_full',
                        name: 'nama_pasien',
                        className: 'text-center px-2 text-nowrap text-capitalize',
                        searchable: true
                    },
                    {
                        data: 'usia_full',
                        name: 'usia',
                        className: 'text-center px-2 text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'no_cm',
                        name: 'no_cm',
                        className: 'text-center px-2',
                        searchable: true
                    },
                    {
                        data: 'bb',
                        name: 'bb',
                        className: 'text-center px-2',
                        searchable: false
                    },
                    {
                        data: 'jaminan',
                        name: 'jaminan',
                        className: 'text-center px-2',
                        searchable: false
                    },
                    {
                        data: 'diagnosa',
                        name: 'diagnosa',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'tindakan',
                        name: 'tindakan',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'nama_dokter',
                        name: 'dokter.nama_dokter',
                        className: 'text-center text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'asisten',
                        name: 'asisten',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'anestesi',
                        name: 'anestesi',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'catatan_hasil_penunjang',
                        name: 'catatan_hasil_penunjang',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'tgl_ipd',
                        name: 'tgl_ipd',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'hasil_ipd',
                        name: 'hasil_ipd',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'tgl_jantung',
                        name: 'tgl_jantung',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'hasil_jantung',
                        name: 'hasil_jantung',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'tgl_anasthesi',
                        name: 'tgl_anasthesi',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'hasil_anasthesi',
                        name: 'hasil_anasthesi',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'tgl_lain',
                        name: 'tgl_lain',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'hasil_lain',
                        name: 'hasil_lain',
                        className: 'text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'verifikasi',
                        name: 'verifikasi',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'text-nowrap',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center text-nowrap',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    }
                ],
                paging: true,
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100],
                ordering: false,
                searching: true,
                info: true,
                autoWidth: false,
                language: {
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    search: "Cari:",
                    paginate: {
                        first: '<i class="bi bi-chevron-double-left"></i>',
                        last: '<i class="bi bi-chevron-double-right"></i>',
                        next: '<i class="bi bi-chevron-right"></i>',
                        previous: '<i class="bi bi-chevron-left"></i>'
                    }
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            });

            // Prevent default form submission and reload datatable instead
            $('form').on('submit', function(e) {
                if ($(this).find('#start_date').length > 0) {
                    e.preventDefault();
                    table.draw();
                }
            });
        });
    </script>
@endpush
