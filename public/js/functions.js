function updateStatus(id, status) {
    fetch(`/update-status/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status berhasil diubah');
            } else {
                alert('Gagal mengubah status');
            }
        })
        .catch(error => console.error('Error:', error));
}

// document.addEventListener('DOMContentLoaded', function () {

//     document.querySelector('#tgl_operasi, #ruang_operasi').addEventListener('change', function () {
//         const date = document.querySelector('#tgl_operasi').value;
//         const room = document.querySelector('#ruang_operasi').value;

//         if (date && room) {
//             fetch(`/get-available-times?tgl_operasi=${date}&ruang_operasi=${room}`)
//                 .then(response => response.json())
//                 .then(data => {
//                     const startTimeSelect = document.querySelector('#jam_operasi');
//                     startTimeSelect.innerHTML = '<option value="">Pilih Jam</option>';
//                     data.forEach(time => {
//                         startTimeSelect.innerHTML += `<option value="${time}">${time}</option>`;
//                     });
//                 });
//         } else {
//             const startTimeSelect = document.querySelector('#jam_operasi');
//             startTimeSelect.setAttribute('disabled', 'true');
//             startTimeSelect.innerHTML = '<option value="">Pilih tanggal dan ruang operasi terlebih dahulu</option>';
//         }

//     });
// });






// document.addEventListener('DOMContentLoaded', function () {
//     const datePicker = document.getElementById('tgl_operasi');
//     const roomSelect = document.getElementById('ruang_operasi');
//     const startTimeInput = document.getElementById('jam_operasi');
//     const endTimeInput = document.getElementById('jam_operasi2');
//     const dokterSelect = document.getElementById('dokter_id');

//     // Inisialisasi flatpickr
//     // flatpickr(datePicker, {});
//     flatpickr("#tgl_operasi, #start_date, #end_date, #tanggal, #tgl_ipd, #tgl_jantung, #tgl_lain, #tgl_anasthesi", {
//         dateFormat: "d-m-Y", // Format tanggal yang diinginkan (misalnya: YYYY-MM-DD)
//         // Opsi tambahan jika diperlukan
//         // onChange: function(selectedDates, dateStr, instance) {
//         //     hitungUmur(selectedDates[0]);
//         // }
//         onChange: function (selectedDates, dateStr) {
//             fetch(`/available-times?tanggal_operasi=${dateStr}`)
//                 .then(response => response.json())
//                 .then(data => {
//                     timeStartPicker.innerHTML = '';
//                     data.forEach(time => {
//                         const option = document.createElement('option');
//                         option.value = time;
//                         option.textContent = time;
//                         timeStartPicker.appendChild(option);
//                     });
//                 });
//         }
//     });

//     // Update Jam Mulai Berdasarkan Ruangan dan Tanggal
//     roomSelect.addEventListener('change', function () {
//         const tanggal = datePicker.value;
//         const ruang = this.value;

//         if (tanggal && ruang) {
//             fetch(`/next-available-time?tgl_operasi=${tanggal}&ruang_operasi=${ruang}`)
//                 .then(response => response.json())
//                 .then(data => {
//                     startTimeInput.value = data.next_time || '';
//                 });
//         }
//     });

//     // Update Jam Selesai Secara Manual
//     startTimeInput.addEventListener('change', function () {
//         const [hours, minutes] = this.value.split(':').map(Number);
//         const endMinutes = minutes + 30;
//         const endHours = hours + Math.floor(endMinutes / 60);
//         const endTime = `${String(endHours % 24).padStart(2, '0')}:${String(endMinutes % 60).padStart(2, '0')}:00`;

//         endTimeInput.value = endTime;
//     });
// });


$(document).ready(function () {
    $('.edit-button').on('click', function () {
        var id = $(this).data('id');
        $.get('/dokter-anestesi/' + id + '/edit', function (data) {
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
