@extends('layout.admin2')

@section('content')
    <style>
        .dll {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: start;
            flex-wrap: wrap;
        }

        .dll .card {
            width: 65%
        }

        .dll .containerN {
            width: 30%;
            height: 310px;
            background-color: white;
            padding: 7px;
            border-radius: 10px;
            overflow-y: auto
        }

        @media (max-width:750px) {
            .dll {
                flex-direction: column;
            }

            .dll .containerN {
                width: 100%;
                margin-bottom: 25px;
            }

            .dll .card {
                width: 100%;
            }
        }

        @media (max-width:430px) {
            .dll .containerN {
                margin-bottom: 45px;
            }
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/logout">Logout</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row-rt">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i
                                    class="fa-solid fa-calendar-days"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Absen hari ini</span>
                                <span class="info-box-number">{{ $totalAbsenHariIni }} Data Absen</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    @if (Auth::guard()->user()->role == 'guru piket')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i
                                        class="fa-solid fa-calendar-days"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Absen minggu ini</span>
                                    <span class="info-box-number">{{ $totalAbsenMingguIni }} data absen</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i
                                        class="fa-solid fa-calendar-days"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Absen Bulan ini</span>
                                    <span class="info-box-number">{{ $totalAbsenBulanIni }} Data Absen</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1"><i
                                        class="fa-solid fa-rectangle-xmark"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">total kelas yang belum mengabsen</span>
                                    <span class="info-box-number">{{ $totalMissing }} kelas</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                </div>
            @else
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i
                                class="fa-solid fa-rectangle-xmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">total kelas yang belum mengabsen</span>
                            <span class="info-box-number">{{ $totalMissing }} kelas</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total akses guru</span>
                            <span class="info-box-number">{{ $totalHakAksesGuru }} Akses Guru</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total akses admin</span>
                            <span class="info-box-number">{{ $totalHakAksesAdmin }} Akses Admin</span>
                        </div>
                    </div>
                </div>
                @endif



                <!-- /.row -->

                <div class="dll">
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                        data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="containerN">
                        <p style="color: black; text-align: center">Tingkat dan Jurusan yang Belum Mengisi Absensi Hari Ini
                        </p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tingkat</th>
                                    <th>Jurusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($missingData as $data)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $data['tingkat'] }}</td>
                                        <td>{{ $data['jurusan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
