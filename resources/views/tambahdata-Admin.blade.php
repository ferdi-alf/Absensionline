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

        @media screen and (max-width:488px) {
            .col-8 {
                width: 90%;
            }
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row-rt mb-2">
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

        <div class="container">
            <h1 class="text-center mb-5">Tambah hak akses Admin</h1>
            <div class="row-rt">
                <div class="col-8">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="/insertdata/admin" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        value="{{ old('name') }}">
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
    </div>
@endsection
