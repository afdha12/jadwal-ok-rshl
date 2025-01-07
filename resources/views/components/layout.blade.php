<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link rel="stylesheet" href="css/sidebars.css"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="css/bootstrap.min.css"> --}}

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- <link rel="stylesheet" href="css/app.css"> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="img/hermina.png">
    <script src="js/functions.js"></script>

    <style>
        body {
            padding-top: 64px;
            /* Sesuaikan dengan tinggi navbar */
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <div>
        @include('components.header')
        <div class="p-3">
            {{-- @include('components.sidebar') --}}
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    @include('sweetalert::alert')


    {{-- <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // flatpickr("#tgl_operasi, #start_date, #end_date, #tanggal, #tgl_ipd, #tgl_jantung, #tgl_lain, #tgl_anasthesi", {
        //     dateFormat: "d-m-Y", // Format tanggal yang diinginkan (misalnya: YYYY-MM-DD)
        //     // Opsi tambahan jika diperlukan
        //     // onChange: function(selectedDates, dateStr, instance) {
        //     //     hitungUmur(selectedDates[0]);
        //     // }
        // });
        flatpickr("#tgl_operasi, #start_date, #end_date, #tanggal, #tgl_ipd, #tgl_jantung, #tgl_lain, #tgl_anasthesi", {
            // flatpickr('#tgl_operasi', {
            dateFormat: 'd-m-Y', // Format tanggal menjadi d-m-Y
        });

        flatpickr("#jam_puasa, #jam_kedatangan, #jam_operasiEdit", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // Format waktu
            time_24hr: true, // Format waktu 24 jam
            defaultHour: 08, // Jam default saat pemilihan waktu
            defaultMinute: 00
        });

        // $(document).ready(function() {
        //     $('.edit-button').on('click', function() {
        //         var id = $(this).data('id');
        //         $.get('/dokter-anestesi/' + id + '/edit', function(data) {
        //             // var dataDokter = data.dataDokter;
        //             // var operators = data.operators;

        //             // $('#dokterId').val(dataDokter.id);
        //             // $('#tanggal').val(dataDokter.tanggal);

        //             // $('#nama_dokter').empty();
        //             // if (Array.isArray(operators)){
        //             //     operators.forEach(function(operator) {
        //             //         var selected = (dataDokter.operator === operator) ? 'selected' : '';
        //             //         $('#nama_dokter').append(`<option value="${operator}" ${selected}>${operator}</option>`);
        //             //     });
        //             // }
        //             // $('#editForm').attr('action', '/dokter-anestesi/' + id + '/update');
        //             $('#editModal').modal('show');
        //         });
        //     });

        //     // $('#editForm').on('submit', function(e) {
        //     //     e.preventDefault();
        //     //     var id = $('#dokterId').val();
        //     //     $.ajax({
        //     //         url: '/dokter-anestesi/' + id + '/update',
        //     //         type: 'POST',
        //     //         data: {
        //     //             _token: $('input[name=_token]').val(),
        //     //             tanggal: $('#tanggal').val(),
        //     //             nama_dokter: $('#nama_dokter').val()
        //     //         },
        //     //         success: function(response) {
        //     //             alert(response.success);
        //     //             location.reload();
        //     //         }
        //     //     });
        //     // });
        // });

        document.getElementById('ruang_operasi').addEventListener('change', getAvailableTimes);
        document.getElementById('tgl_operasi').addEventListener('change', getAvailableTimes);

        function getAvailableTimes() {
            const room = document.getElementById('ruang_operasi').value;
            const date = document.getElementById('tgl_operasi').value;
            const editId = {{ $jadwal->id }};

            if (room && date) {
                fetch(`/api/get-available-times?ruang_operasi=${room}&tgl_operasi=${date}&id=${editId}`)
                    .then(response => response.json())
                    .then(data => {
                        const startDropdown = document.getElementById('jam_operasi');
                        const endDropdown = document.getElementById('jam_operasi2');

                        startDropdown.innerHTML = '';
                        endDropdown.innerHTML = '';

                        data.forEach(time => {
                            startDropdown.innerHTML += `<option value="${time}">${time}</option>`;
                            endDropdown.innerHTML += `<option value="${time}">${time}</option>`;
                        });
                    });
            }
        }


        document.querySelector('#jam_operasi').addEventListener('input', function() {
            const startTime = this.value; // Format waktu: HH:MM
            const endTimeInput = document.querySelector('#jam_operasi2');

            if (startTime) {
                const [hours, minutes] = startTime.split(':').map(Number);

                // Tambahkan durasi operasi, misalnya 1 jam (60 menit)
                const endTime = new Date(0, 0, 0, hours, minutes + 60);

                // Format waktu ke HH:MM
                const formattedEndTime = endTime
                    .toLocaleTimeString('en-GB', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });

                endTimeInput.value = formattedEndTime; // Isi otomatis jam selesai
            } else {
                endTimeInput.value = ''; // Kosongkan jika tidak ada jam mulai
            }
        });
    </script>

</body>

</html>
