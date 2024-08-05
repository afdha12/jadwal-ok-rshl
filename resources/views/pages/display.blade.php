<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <meta http-equiv="refresh" content="60">
    <title>Display</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>

<body>
    <div class="m-2">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped align-middle" style="width:100%" id="myTable">
                <tr>
                    <h3 class="text-center py-3">JADWAL OPERASI RS HERMINA LAMPUNG</h3>
                </tr>
                <thead class="table-secondary align-middle">
                    <tr>
                        <td colspan="10" class="pe-1">Dokter Anestesi hari ini : @foreach ($dokter as $anesthesiologist)
                                {{ $anesthesiologist->nama_dokter }}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Jam Operasi</th>
                        <th class="text-center">Nama Pasien</th>
                        <th class="text-center">Usia</th>
                        <th class="text-center">No. CM</th>
                        <th class="text-center">Diagnosa</th>
                        <th class="text-center">Tindakan</th>
                        <th class="text-center">Operator</th>
                        <th class="text-center">Ruang Operasi</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody id="data-table-body" class="px-3">
                    @foreach ($data as $item)
                        <tr data-id="{{ $item->id }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item->jam_operasi }}</td>
                            <td class="text-center">{{ $item->nama_pasien }}</td>
                            <td class="text-center">{{ $item->usia }}</td>
                            <td class="text-center">{{ $item->no_cm }}</td>
                            <td>{{ $item->diagnosa }}</td>
                            <td>{{ $item->tindakan }}</td>
                            <td class="text-center">{{ $item->operator }}</td>
                            <td class="text-center">{{ $item->ruang_operasi }}</td>
                            <td class="text-center"
                                style="background-color: {{ $item->status == 'TERLAKSANA' ? 'green' : ($item->status == 'ON-PROCESS' ? 'blue' : 'red') }}; color: white;">
                                {{ $item->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="build/assets/app-67426de4.js"></script>

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var today = '{{ $today }}';

        var dataAddedChannel = pusher.subscribe('data-added.' + today);
        dataAddedChannel.bind('App\\Events\\DataUpdated', function(data) {
            var newRow = `<tr data-id="${data.data.id}">
                            <td class="text-center"></td>
                            <td class="text-center">${data.data.jam_operasi}</td>
                            <td class="text-center">${data.data.nama_pasien}</td>
                            <td class="text-center">${data.data.usia}</td>
                            <td class="text-center">${data.data.no_cm}</td>
                            <td>${data.data.diagnosa}</td>
                            <td>${data.data.tindakan}</td>
                            <td class="text-center">${data.data.operator}</td>
                            <td class="text-center">${data.data.ruang_operasi}</td>
                            <td class="text-center" style="background-color: ${data.data.status === 'TERLAKSANA' ? 'green' : (data.data.status === 'ON-PROCESS' ? 'blue' : 'red')}; color: white;">${data.data.status}</td>
                          </tr>`;
            $('#data-table-body').append(newRow);
            updateRowNumbers();
        });

        var dataUpdatedChannel = pusher.subscribe('data-updated.' + today);
        dataUpdatedChannel.bind('App\\Events\\DataUpdated', function(data) {
            var row = $(`tr[data-id="${data.data.id}"]`);
            if (data.data.tgl_operasi === today) {
                if (row.length) {
                    row.find('td:eq(1)').text(data.data.jam_operasi);
                    row.find('td:eq(2)').text(data.data.nama_pasien);
                    row.find('td:eq(3)').text(data.data.usia);
                    row.find('td:eq(4)').text(data.data.no_cm);
                    row.find('td:eq(5)').text(data.data.diagnosa);
                    row.find('td:eq(6)').text(data.data.tindakan);
                    row.find('td:eq(7)').text(data.data.operator);
                    row.find('td:eq(8)').text(data.data.ruang_operasi);
                    row.find('td:eq(9)').text(data.data.status)
                        .css('background-color', data.data.status === 'TERLAKSANA' ? 'green' : (data.data.status === 'ON-PROCESS' ? 'blue' : 'red'))
                        .css('color', 'white');
                } else {
                    var newRow = `<tr data-id="${data.data.id}">
                            <td class="text-center"></td>
                            <td class="text-center">${data.data.jam_operasi}</td>
                            <td class="text-center">${data.data.nama_pasien}</td>
                            <td class="text-center">${data.data.usia}</td>
                            <td class="text-center">${data.data.no_cm}</td>
                            <td>${data.data.diagnosa}</td>
                            <td>${data.data.tindakan}</td>
                            <td class="text-center">${data.data.operator}</td>
                            <td class="text-center">${data.data.ruang_operasi}</td>
                            <td class="text-center" style="background-color: ${data.data.status === 'TERLAKSANA' ? 'green' : (data.data.status === 'ON-PROCESS' ? 'blue' : 'red')}; color: white;">${data.data.status}</td>
                          </tr>`;
                    $('#data-table-body').append(newRow);
                    updateRowNumbers();
                }
            } else {
                if (row.length) {
                    row.remove();
                    updateRowNumbers();
                }
            }
        });

        var dataDeletedChannel = pusher.subscribe('data-deleted.' + today);
        dataDeletedChannel.bind('App\\Events\\DataDeleted', function(data) {
            $(`tr[data-id="${data.dataId}"]`).remove();
            updateRowNumbers();
        });

        function updateRowNumbers() {
            $('#data-table-body tr').each(function(index, tr) {
                $(tr).find('td').first().text(index + 1);
            });
        }
    </script>
</body>

</html>
