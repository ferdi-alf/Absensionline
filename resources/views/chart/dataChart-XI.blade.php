@extends('layout.admin2')
@section('content')
    <style>
        @media screen and (max-width:400px) {
            .container-xxl .txt {
                font-size: 19px;
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
                            <li class="breadcrumb-item"><a href="/logout">Logout</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container-xxl">
            <h3 class="mt-2 mb-2 text-center txt">diagram data absen <span id="bulan"></span></h3>

            <div class="container d-flex flex-wrap justify-content-between">
                <h4 class="text-left txt">Geser untuk lebih lanjut >></h4>
            </div>

            <div class="container bo" style="overflow-y: auto">
                <div class="row justify-content-center">
                    <div class="p-6 m-20 bg-white rounded shadow mb-4" style="width:600px;">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
