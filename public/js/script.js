$(document).ready(function () {
  // Mendapatkan tanggal, bulan, dan tahun saat ini
  var today = new Date();
  var date = today.getDate();

  // Menyimpan nama bulan dalam array
  var monthNames = [
    "January", "February", "Maret", "April", "Mei", "Juni",
    "July", "Agustus", "September", "Oktober", "November", "Desember"
  ];

  var month = monthNames[today.getMonth()];
  var year = today.getFullYear();

  // Menambahkan nol di depan jika tanggal kurang dari 10
  date = (date < 10) ? '0' + date : date;

  // Menetapkan nilai ke dalam elemen span
  $('#tanggal').text(date + ' ' + month + ' ' + year);
  $('#bulan').text(month + ' ' + year);
});


function hideOption(selectElement) {
  // Mengambil indeks opsi "Pilih"
  var pilihOptionIndex = 0;

  // Mendapatkan nilai terpilih
  var selectedValue = selectElement.value;

  // Menyembunyikan opsi "Pilih" jika kelas terpilih
  if (selectedValue !== "") {
    selectElement.options[pilihOptionIndex].style.display = "none";
  } else {
    selectElement.options[pilihOptionIndex].style.display = "";
  }
}

$(document).ready(function () {
  var alert = $('.container-alert')
  var button = $('#buttonn')

  button.on('click', function () {
    alert.css('display', 'none');
  });
});