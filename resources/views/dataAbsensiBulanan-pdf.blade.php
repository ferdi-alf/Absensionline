<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <h1 class="text-center mb-3">Data Absen Smk Negeri 4 Palembang</h1>
    <h2 class="mb-2 text-center">Data Absensi Tanggal {{ now()->format('m-Y') }}</h2>

    <table id="customers">
        <tr>
            <th scope="col" class="px-3">#</th>
            <th scope="col" class="px-3">Waktu</th>
            <th scope="col" class="px-3">Ketua Kelas</th>
            <th scope="col" class="px-3 text-center">No Telp</th>
            <th scope="col" class="px-3 text-center text-truncate">Wali Kelas</th>
            <th scope="col" class="px-3">Tingkat</th>
            <th scope="col" class="px-3">Jurusan</th>
            <th scope="col" class="px-3">Ruang</th>
            <th scope="col" class="px-3 text-center text-truncate">Jumlah Tidak Hadir</th>
            <th scope="col" class="px-2">Siswa Tidak Hadir</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($absensibulanan as $items)
            <tr>
                <td>{{ $no++ }}</td>
                <td class="text-truncate">{{ $items->created_at->diffForHumans() }}</td>
                <td class="text-truncate">{{ $items->ketua_kelas }}</td>
                <td>{{ $items->no_tlp }}</td>
                <td class=" text-center">{{ $items->wali_kelas }}</td>
                <td class="text-center">{{ $items->tingkat }}</td>
                <td class="text-center">{{ $items->jurusan }}</td>
                <td class="text-center">{{ $items->ruang }}</td>
                <td class="text-center">{{ $items->jumlah_tidak_hadir }}</td>
                <td class="text-truncate">{{ $items->siswa_tidak_hadir }}</td>
            </tr>
        @endforeach
    </table>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
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
        });
    </script>
</body>

</html>
