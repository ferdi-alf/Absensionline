@extends('layout.guru2')

@section('content')
    <style>
        @media screen and (max-width:500px) {
            .txt {
                font-size: 17px;
            }
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard v2</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=/logout>Logout</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="container-xxl">
            <h3 class="mt-2 mb-2 text-center txt">data absen Kelas Anda <span id="bulan"></span></h3>

            <div class="container d-flex flex-wrap justify-content-between">
                <h4 class="text-left txt">Geser untuk lebih lanjut >></h4>

                <form class="d-flex" action="/guru/absen/bulan-ini" method="GET">
                    <input class="form-control me-2 mb-2" type="search" placeholder="Cari data absen" aria-label="Search"
                        name="search" style="width: 100%; border:2px solid grey;">
                    <button class="btn btn-outline-success mb-2" type="submit" name="submit">Search</button>
                </form>
            </div>

            <div class="container bo" style="overflow-y: auto">
                <div class="row">
                    <table class="table table-striped table-hover table-bordered tab">
                        <thead>
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

                        </thead>
                        <tbody>
                            @php
                                $noabsen = 1;
                            @endphp
                            @foreach ($absensiBulanan as $index => $items)
                                <tr>
                                    <th>{{ $index + $absensiBulanan->firstItem() }}</th>
                                    <th class="text-truncate">{{ $items->created_at->format('d-m-Y') }}</th>
                                    <th class="text-truncate">{{ $items->ketua_kelas }}</th>
                                    <th>{{ $items->no_tlp }}</th>
                                    <th class=" text-center text-truncate">{{ $items->wali_kelas }}</th>
                                    <th class="text-center">{{ $items->tingkat }}</th>
                                    <th class="text-center">{{ $items->jurusan }}</th>
                                    <th class="text-center">{{ $items->ruang }}</th>
                                    <th class="text-center">{{ $items->jumlah_tidak_hadir }}</th>
                                    <th class="text-truncate">{{ $items->siswa_tidak_hadir }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container mt-2">
                {{ $absensiBulanan->links() }}
            </div>
        </div>



    </div>
@endsection
