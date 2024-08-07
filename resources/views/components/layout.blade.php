<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

    <link rel="stylesheet" href="css/app.css">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="img/hermina.png">

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
        <div>
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
        flatpickr("#tgl_operasi, #start_date, #end_date, #tanggal", {
            dateFormat: "d-m-Y", // Format tanggal yang diinginkan (misalnya: YYYY-MM-DD)
            // Opsi tambahan jika diperlukan
            // onChange: function(selectedDates, dateStr, instance) {
            //     hitungUmur(selectedDates[0]);
            // }
        });
        flatpickr("#jam_operasi", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // Format waktu
            time_24hr: true, // Format waktu 24 jam
            defaultHour: 08, // Jam default saat pemilihan waktu
            defaultMinute: 00
        });

        $(document).ready(function() {
            $('.edit-button').on('click', function() {
                var id = $(this).data('id');
                $.get('/dokter-anestesi/' + id + '/edit', function(data) {
                    // var dataDokter = data.dataDokter;
                    // var operators = data.operators;

                    // $('#dokterId').val(dataDokter.id);
                    // $('#tanggal').val(dataDokter.tanggal);
                    
                    // $('#nama_dokter').empty();
                    // if (Array.isArray(operators)){
                    //     operators.forEach(function(operator) {
                    //         var selected = (dataDokter.operator === operator) ? 'selected' : '';
                    //         $('#nama_dokter').append(`<option value="${operator}" ${selected}>${operator}</option>`);
                    //     });
                    // }
                    // $('#editForm').attr('action', '/dokter-anestesi/' + id + '/update');
                    $('#editModal').modal('show');
                });
            });

            // $('#editForm').on('submit', function(e) {
            //     e.preventDefault();
            //     var id = $('#dokterId').val();
            //     $.ajax({
            //         url: '/dokter-anestesi/' + id + '/update',
            //         type: 'POST',
            //         data: {
            //             _token: $('input[name=_token]').val(),
            //             tanggal: $('#tanggal').val(),
            //             nama_dokter: $('#nama_dokter').val()
            //         },
            //         success: function(response) {
            //             alert(response.success);
            //             location.reload();
            //         }
            //     });
            // });
        });
    </script>

</body>

</html>
