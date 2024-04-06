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
            <h1 class="text-center mb-5">Data Admin</h1>
            <div class="container bo one">
                <a href="/tambahdata/admin" class="btn btn-success mb-2" style="box-shadow: -5px 5px 7px grey;">Tambah +
                </a>
                <div class="row" style="overflow-y: auto">
                    <table class="table table-striped table-hover table-bordered tab"
                        style="box-shadow: -5px 5px 7px grey;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">username</th>
                                <th scope="col">role</th>
                                <th scope="col">dibuat</th>
                                <th scope="col text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($admin as $user)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="text-truncate">{{ $user->created_at->diffForHumans() }}</td>
                                    <td class="gap-2">
                                        <a href="/admin/{{ $user->id }}" class="btn btn-info mb-2 mb-md-0">Edit</a>
                                        <a href="/delete/admin/{{ $user->id }}" class="btn btn-danger delete"
                                            data-id="{{ $user->id }}" data-nama="{{ $user->name }}">Hapus</a>
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
