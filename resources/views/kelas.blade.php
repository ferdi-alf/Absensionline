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
            <h1 class="text-center mb-5">Data kelas</h1>
            <div class="container bo one">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- modal tambah kelas --}}
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-bs-whatever="@mdo">Tambah +</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah kelas</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/post/kelas" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <p class="fs-2">Tingkat</p>
                                        <select class="form-select form-control" name="tingkat"
                                            aria-label="Default select example" required>
                                            <option value="" selected>pilih</option>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <p class="fs-2">Jurusan</p>
                                        <p>pilih jurusan apa saja yang ingin di masukan pada tingkat tertentu</p>
                                        @foreach (['DPIB 1', 'DPIB 2', 'TP 1', 'TP 2', 'TP 3', 'TKR 1', 'TKR 2', 'TKR Industri', 'TSM 1', 'TSM 2', 'TAV 1', 'TAV 2', 'TITL 1', 'TITL 2', 'TITL 3', 'TITL 4', 'TITL Industri', 'TKJ 1', 'TKJ 2', 'TKJ 3', 'TKJ ACP', 'RPL'] as $jurusan)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="jurusan[]"
                                                    value="{{ $jurusan }}" id="jurusan_{{ $jurusan }}">
                                                <label class="form-check-label"
                                                    for="jurusan_{{ $jurusan }}">{{ $jurusan }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modal edit tingkat X --}}
                @foreach (['X', 'XI', 'XII'] as $tingkat)
                    {{-- Modal Edit Tingkat {{ $tingkat }} --}}
                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $tingkat }}" data-bs-whatever="@mdo">Tingkat
                        {{ $tingkat }}</button>
                    <div class="modal fade" id="exampleModal{{ $tingkat }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit tingkat {{ $tingkat }}
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/kelas/update" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <p class="fs-2">Tingkat</p>
                                            <select class="form-select form-control" name="tingkat"
                                                aria-label="Default select example" required>
                                                @foreach (['X', 'XI', 'XII'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ $opt == $tingkat ? 'selected' : '' }}>{{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <p class="fs-2">Jurusan</p>
                                            <p>Pilih jurusan apa saja yang ingin diperbarui pada tingkat tertentu</p>
                                            @foreach (['DPIB 1', 'DPIB 2', 'TP 1', 'TP 2', 'TP 3', 'TKR 1', 'TKR 2', 'TKR Industri', 'TSM 1', 'TSM 2', 'TAV 1', 'TAV 2', 'TITL 1', 'TITL 2', 'TITL 3', 'TITL 4', 'TITL Industri', 'TKJ 1', 'TKJ 2', 'TKJ 3', 'TKJ ACP', 'RPL'] as $jurusan)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="jurusan[]"
                                                        value="{{ $jurusan }}"
                                                        id="jurusan_{{ $jurusan }}_{{ $tingkat }}"
                                                        @if (isset($groupByTingkat[$tingkat]) && $groupByTingkat[$tingkat]->contains('jurusan', $jurusan)) checked @endif>
                                                    <label class="form-check-label"
                                                        for="jurusan_{{ $jurusan }}_{{ $tingkat }}">{{ $jurusan }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



                <div class="row" style="overflow-y: auto">
                    <table class="table table-striped table-hover table-bordered tab"
                        style="box-shadow: -5px 5px 7px grey;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
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
                            @foreach ($data as $kelas)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $kelas->tingkat }}</td>
                                    <td>{{ $kelas->jurusan }}</td>
                                    <td class="text-truncate">{{ $kelas->created_at->diffForHumans() }}</td>
                                    <td class="gap-2">
                                        <a href="/delete/kelas/{{ $kelas->id }}" class="btn btn-danger deleteClass"
                                            data-id="{{ $kelas->id }}"
                                            data-nama="{{ $kelas->tingkat }} {{ $kelas->jurusan }}">Hapus</a>
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
