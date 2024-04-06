@extends('layout.admin2')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 40px;">
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
            <h1 class="text-center mb-5">Data Akses Guru/Wali Kelas</h1>
            <div class="container bo one">
                <a href="/tambahdata" class="btn btn-success mb-2" style="box-shadow: -5px 5px 7px grey;">Tambah + </a>
                <div class="row" style="overflow-y: auto">
                    <table class="table table-striped table-hover table-bordered tab"
                        style="box-shadow: -5px 5px 7px grey;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">nama</th>
                                <th scope="col">username</th>
                                <th scope="col">tingkat</th>
                                <th scope="col">jurusan</th>
                                <th scope="col">dibuat</th>
                                <th scope="col text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $row)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td class="align-items-center text-truncate px-3">{{ $row->nama }}</td>
                                    <td class="align-items-center px-3">{{ $row->username }}</td>
                                    <td class="align-items-center px-3">{{ $row->tingkat }}</td>
                                    <td class="align-items-center px-3">{{ $row->jurusan }}</td>
                                    <td class=" text-truncate px-3">{{ $row->created_at->format('D M Y') }}</td>
                                    <td g-3">
                                        <a href="/tampildata/{{ $row->id }}" class="btn btn-info mb-2 mb-md-0">Edit</a>
                                        <a href="/delete/{{ $row->id }}" class="btn btn-danger deleteGuru"
                                            data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
