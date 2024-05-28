<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>crud laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <h1 class="text-center mb-5 mt-5">Edit akses Guru</h1>
        <div class="row justify-content-center align-items-center">
            <div class="col-8" style="width: 100%">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card" style="width: 100%">
                    <div class="card-body">

                        <form action="/kelas/update/{{ $kelas->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <p class="fs-2">Tingkat</p>
                                <select class="form-select form-control" name="tingkat"
                                    aria-label="Default select example" onchange="hideOption(this)" required>
                                    <option value="{{ $kelas->tingkat }}"selected>{{ $kelas->tingkat }}</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <p class="fs-2">Jurusan</p>
                                <select class="form-select form-control" id="jurusan" name="jurusan"
                                    onchange="hideOption(this)" required>
                                    <option value="{{ $kelas->jurusan }}" selected>{{ $kelas->jurusan }}</option>
                                    <option value="DPIB 1">DPIB 1</option>
                                    <option value="DPIB 2">DPIB 2</option>
                                    <option value="TP 1">TP 1</option>
                                    <option value="TP 2">TP 2</option>
                                    <option value="TP 3">TP 3</option>
                                    <option value="TKR 1">TKR 1</option>
                                    <option value="TKR 2">TKR 2</option>
                                    <option value="TKR Industri">TKR Industri</option>
                                    <option value="TSM 1">TSM 1</option>
                                    <option value="TSM 2">TSM 2</option>
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
                                    <option value="TKJ ACP">TKJ ACP</option>
                                    <option value="RPL">RPL</option>
                                </select>
                            </div>
                            <div class="modal-footer gap-1">
                                <a href="/kelas" class="btn btn-primary">Kembali</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>



</body>

</html>
