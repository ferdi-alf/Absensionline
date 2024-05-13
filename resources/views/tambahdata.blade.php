@extends('layout.admin2')

@section('content')
    <style>
        .card-body {
            border: 1px solid rgba(0, 0, 0, 0.491);
            box-shadow: -5px 5px 7px grey;
        }

        .mb-3 input {
            border: 1px solid rgba(0, 0, 0, 0.491);
        }

        .mb-3 select {
            border: 1px solid rgba(0, 0, 0, 0.491);
        }

        .card .mb-3 input:-webkit-autofill,
        .card .mb-3 input:-webkit-autofill:hover,
        .card .mb-3 input:-webkit-autofill:focus,
        .card .mb-3 input:-webkit-autofill:active {
            transition: background-color 5000s ease-in-out 0s, color 5000s ease-in-out 0s;
            background-color: transparent !important;
            color: white !important;
        }

        .card .mb-3 input:focus~label,
        .card .mb-3 input:valid:not(:placeholder-shown)~label {
            top: -8px;
            font-size: 12px;
        }

        .card .mb-3 select:-webkit-autofill,
        .card .mb-3 select:-webkit-autofill:hover,
        .card .mb-3 select:-webkit-autofill:focus,
        .card .mb-3 select:-webkit-autofill:active {
            transition: background-color 5000s ease-in-out 0s, color 5000s ease-in-out 0s;
            background-color: transparent !important;
            color: white !important;
        }

        .containerG {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80%;
            flex-direction: column;
        }


        @media screen and (max-width:488px) {
            .col-8 {
                width: 90%;
            }

            .containerG {
                width: 90%;
            }
        }
    </style>

    <div class="content-wrapper" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
        <!-- Content Header (Page header) -->
        <div class="content-header" style="width: 80%;">
            <div class="container-fluid">
                <div class="row-rt mb-2" style="display: flex; justify-content: space-between; align-items: center; ">
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

        <div class="containerG">
            <h1 class="text-center mb-5">Tambah hak akses Guru</h1>
            <div class="row-rt" style="width: 100%;">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <form action="/insertdata" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('nama') }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">username untuk login</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                                    id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <select id="tingkat" name="tingkat" onchange="hideOption(this)" class="form-control">
                                    <option value="" {{ old('tingkat') == '' ? 'selected' : '' }}>Tingkat
                                    </option>
                                    <option value="X" {{ old('tingkat') == 'X' ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ old('tingkat') == 'XI' ? 'selected' : '' }}>XI
                                    </option>
                                    <option value="XII" {{ old('tingkat') == 'XII' ? 'selected' : '' }}>XII
                                    </option>
                                </select>


                            </div>
                            <div class="mb-3">

                                <select id="jurusan" name="jurusan" onchange="hideOption(this)" class="form-control">
                                    <option value="" {{ old('jurusan') == '' ? 'selected' : '' }}>Jurusan
                                    </option>
                                    <option value="DPIB 1" {{ old('jurusan') == 'DPIB 1' ? 'selected' : '' }}>DPIB 1
                                    </option>
                                    <option value="DPIB 2" {{ old('jurusan') == 'DPIB 2' ? 'selected' : '' }}>DPIB 2
                                    </option>
                                    <option value="TP 1" {{ old('jurusan') == 'TP 1' ? 'selected' : '' }}>TP 1
                                    </option>
                                    <option value="TP 2" {{ old('jurusan') == 'TP 2' ? 'selected' : '' }}>TP 2
                                    </option>
                                    <option value="TP 3" {{ old('jurusan') == 'TP 3' ? 'selected' : '' }}>TP 3
                                    </option>
                                    <option value="TKR 1" {{ old('jurusan') == 'TKR 1' ? 'selected' : '' }}>TKR 1
                                    </option>
                                    <option value="TKR 2" {{ old('jurusan') == 'TKR 2' ? 'selected' : '' }}>TKR 2
                                    </option>
                                    <option value="TKR 3" {{ old('jurusan') == 'TKR 3' ? 'selected' : '' }}>TKR 3
                                    </option>
                                    <option value="TSM 1" {{ old('jurusan') == 'TSM 1' ? 'selected' : '' }}>TSM 1
                                    </option>
                                    <option value="TSM 2" {{ old('jurusan') == 'TSM 2' ? 'selected' : '' }}>TSM 2
                                    </option>
                                    <option value="TSM 3" {{ old('jurusan') == 'TSM 3' ? 'selected' : '' }}>TSM 3
                                    </option>
                                    <option value="TAV 1" {{ old('jurusan') == 'TAV 1' ? 'selected' : '' }}>TAV 1
                                    </option>
                                    <option value="TAV 2" {{ old('jurusan') == 'TAV 2' ? 'selected' : '' }}>TAV 2
                                    </option>
                                    <option value="TITL 1" {{ old('jurusan') == 'TITL 1' ? 'selected' : '' }}>TITL
                                        1</option>
                                    <option value="TITL 2" {{ old('jurusan') == 'TITL 2' ? 'selected' : '' }}>TITL
                                        2</option>
                                    <option value="TITL 3" {{ old('jurusan') == 'TITL 3' ? 'selected' : '' }}>TITL
                                        3</option>
                                    <option value="TITL 4" {{ old('jurusan') == 'TITL 4' ? 'selected' : '' }}>TITL
                                        4</option>
                                    <option value="TKJ 1" {{ old('jurusan') == 'TKJ 1' ? 'selected' : '' }}>TKJ 1
                                    </option>
                                    <option value="TKJ 2" {{ old('jurusan') == 'TKJ 2' ? 'selected' : '' }}>TKJ 2
                                    </option>
                                    <option value="TKJ 3" {{ old('jurusan') == 'TKJ 3' ? 'selected' : '' }}>TKJ 3
                                    </option>
                                    <option value="TKJ 4" {{ old('jurusan') == 'TKJ 4' ? 'selected' : '' }}>TKJ 4
                                    </option>
                                    <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>RPL
                                    </option>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
