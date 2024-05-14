<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absemsi Online</title>

    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,700;1,400&family=Roboto+Slab:wght@100;400;700&family=Sevillana&family=Ubuntu:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<style>
    .ig {
        color: rgb(0, 132, 255);
        text-decoration: none;
    }

    .ig:hover {
        text-decoration: underline;
    }

    .inpt {
        width: 100%;
        height: 90px;
        padding: 5px 0 0 7px;
    }
</style>

<body>


    <div class="container-fluid main">
        <div class="container-fluid nt">

            <div class="box animate__backInUp animate__delay-2s">
                <p class="fs-2">Absensi Tanggal <span id="tanggal"></span></p>
                <p class="fst-italic">dibuat dengan ❤️ oleh <a
                        href="https://www.instagram.com/eternalferr_?igsh=MXNmcXI1cGE2dWJkYw==" class="ig"
                        style="font-size: 17px">@eternalferr_</a></p>
                <img src="{{ asset('assets/img1.jpg') }}" class="img-thumbnail" alt="...">
                <div class="log">
                    <a href="/login" class="btn btn-primary"> Login Admin</a>
                    <a href="/loginguru" class="btn btn-success"> Login Guru</a>
                </div>
                <p>Isilah data dengan benar</p>
            </div>
            {{-- alert --}}
            @if ($message = Session::get('sukses'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: '{{ $message }}',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Tutup SweetAlert
                                Swal.close();
                            }
                        });
                    });
                </script>
            @endif

            @if ($message = Session::get('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Yahh Gagal nih :(',
                            text: '{{ $message }}',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Tutup SweetAlert
                                Swal.close();
                            }
                        });
                    });
                </script>
            @endif


            @if ($errors->any())
                <div class="container-alert">
                    <div class="alert alert-danger  flex  flex-col justify-content-center align-items-center">
                        <h3 class="text-center">Gagal:(</h3>
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <button class="btn btn-primary" id="buttonn">Siapp</button>
                    </div>
                </div>
            @endif
            {{-- end alert --}}
            <form action="/insertabsen" method="POST" class="frm" enctype="multipart/form-data"id="myForm">
                @csrf
                <div class="box">
                    <p class="fs-2">Ketua Kelas</p>
                    <img src="{{ asset('assets/img6.jpg') }}" class="img-thumbnail" alt="...">
                    <div class="input">
                        <p class="fs-6">Masukan Nama Ketua Kelas:</p>
                        <input type="text" name="ketua_kelas" id="ketua" placeholder="masukan nama Ketua kelasmu"
                            required>
                    </div>
                </div>

                <div class="box" data-aos="fade-up" data-aos-duration="1000">
                    <p class="fs-2">Phone Number</p>
                    <img src="{{ asset('assets/img3.jpg') }}" class="img-thumbnail" alt="...">
                    <div class="input">
                        <p class="fs-6">masukan No Hp</p>
                        <input type="text" name="no_tlp" id="tlp" placeholder="masukan nomor telepon"
                            required>
                    </div>
                </div>

                <div class="box" data-aos="flip-left" data-aos-duration="1000">
                    <p class="fs-2">Wali Kelas</p>
                    <img src="{{ asset('assets/img7.jpg') }}" class="img-thumbnail" alt="...">
                    <div class="input">
                        <p class="fs-6">Masukan Nama Wali Kelas:</p>
                        <input type="text" name="wali_kelas" id="wali" placeholder="masukan nama Wali kelasmu"
                            required>
                    </div>
                </div>

                <div class="box" data-aos="fade-up" data-aos-duration="1000">
                    <p class="fs-2">Tingkat</p>
                    <img src="{{ asset('assets/img4.jpg') }}" class="img-thumbnail" alt="...">
                    <div class="input">
                        <p class="fs-6">Pilih Tingkatmu:</p>
                        <select id="tingkat" name="tingkat" onchange="hideOption(this)" required>
                            <option value="" selected>Pilih</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                </div>

                <div class="box" data-aos="fade-right" data-aos-duration="1000">
                    <p class="fs-2">Kelas</p>
                    <img src="{{ asset('assets/img5.jpg') }}" class="img-thumbnail" alt="...">
                    <div class="input">
                        <p class="fs-6">Pilih Kelasmu:</p>
                        <select id="jurusan" name="jurusan" onchange="hideOption(this)" required>
                            <option value="" selected>Pilih</option>
                            <option value="DPIB 1">DPIB 1</option>
                            <option value="DPIB 2">DPIB 2</option>
                            <option value="TP 1">TP 1</option>
                            <option value="TP 2">TP 2</option>
                            <option value="TP 3">TP 3</option>
                            <option value="TKR 1">TKR 1</option>
                            <option value="TKR 2">TKR 2</option>
                            <option value="TKR 3">TKR 3</option>
                            <option value="TKR Industri">TKR Industri</option>
                            <option value="TSM 1">TSM 1</option>
                            <option value="TSM 2">TSM 2</option>
                            <option value="TSM 3">TSM 3</option>
                            <option value="TSM Industri">TSM Industri</option>
                            <option value="TAV 1">TAV 1</option>
                            <option value="TAV 2">TAV 2</option>
                            <option value="TITL 1">TITL 1</option>
                            <option value="TITL 2">TITL 2</option>
                            <option value="TITL 3">TITL 3</option>
                            <option value="TITL 4">TITL 4</option>
                            <option value="TITL Industri">TITL Industri</option>
                            <option value="TKJ 1">TKJ 1</option>
                            <option value="TKJ 2">TKJ 2</option>
                            <option value="TKJ 3">TKJ 3</option>
                            <option value="TKJ 4">TKJ 4</option>
                            <option value="TKJ ACP">TKJ ACP</option>
                            <option value="RPL">RPL</option>
                        </select>
                    </div>
                </div>


                <div class="box" data-aos="flip-right" data-aos-duration="1000">
                    <p class="fs-2">Ruang</p>
                    <img src="{{ asset('assets/img8.jpg') }}" class="img-thumbnail" alt="...">
                    <div class="input">
                        <p class="fs-6">Kamu Ruang Berapa?:</p>
                        <input type="text" name="ruang" id="ruang" placeholder="masukan ruang kelasmu"
                            required>
                    </div>
                </div>

                <div class="box" data-aos="flip-up" data-aos-duration="1000">
                    <p class="fs-2">Jumlah tidak hadir</p>
                    <img src="{{ asset('assets/img10pg.jpg') }}" class="img-thumbnail" alt="...">
                    <div class="input">
                        <p class="fs-6">Tulis angka saja:</p>
                        <p class="fs-6">Jika hadir semua tulis "0" saja!!</p>
                        <input type="text" name="jumlah_tidak_hadir" id="jumlah_tidak_hadir"
                            placeholder="Jumlah temanmu yang tidak masuk">
                    </div>
                </div>

                <div class="box" data-aos="flip-down" data-aos-duration="1000">
                    <p class="fs-2">Siswa yang tidak hadir</p>
                    <img src="{{ asset('assets/img9.jpg') }}" class="img-thumbnail" alt="...">
                    <div class="input">
                        <p class="fs-6">contoh: <br>
                            1. Ali (a) <br>
                            2. Budi (s) <br>
                            3. .....dst :</p>
                        <p class="fs-6">Jika hadir semua isi "Nihil"</p>
                        <textarea class="inpt" type="text" name="siswa_tidak_hadir" id="siswa_tidak_hadir"
                            placeholder="Tulis nama temanmu yang tidak masuk seperti contoh"></textarea>
                    </div>
                </div>
            </form>
            <div style="width: 100%">
                <button type="submit" name="submit" id="myButton" class="submit">Kirim</button>
            </div>
        </div>
    </div>

    <div class="container-xxl">
        <div class="container-fluid foot">
            <p class="fs-5">Dibuat dengan ❤️ oleh <a
                    href="https://www.instagram.com/eternalferr_?igsh=MXNmcXI1cGE2dWJkYw==" class="auto-type ig"></a>
            </p>
            <p style="font-weight: 100;">&copy; Copyright by SMKN 4 Palembang, 2024 | All Right
                Reverse</p>
        </div>
    </div>


    <!-- Boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <!-- main Js -->
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Typing Js -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <!-- Animate Aos -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        AOS.init();
    </script>

    <script>
        var typed = new Typed(".auto-type", {
            strings: ["@eternalferr_"],
            typeSpeed: 60,
            backSpeed: 60,
            loop: true
        });
    </script>

    <script>
        $('.submit').click(function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Peringatan!!",
                text: "harap periksa lagi absen sebelum mengirim ya gess😁",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Kirim absen",
                cancelButtonText: "periksa lagi"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Menggunakan metode POST untuk mengirim data
                    $('form').submit(); // Kirim formulir menggunakan metode POST
                }
            });
        });
    </script>

</body>

</html>
