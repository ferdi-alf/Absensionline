<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>crud laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

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

        .toggle-password {
            position: absolute;
            top: 60%;
            right: 10px;
            cursor: pointer;
            transform: translateX(-90%);
            color: black;
            font-size: 15px;
        }

        @media screen and (max-width:488px) {
            .col-8 {
                width: 90%;
            }

            .card-body {
                height: 300px;
            }

            .mb-3 {
                margin-top: 12px;
            }

            button {
                margin-top: 15px;
            }

            .container {
                min-heightht: 100vh;
                display: flex;
                align-items: center;
                flex-direction: column;
                justify-content: center;
            }

            .row {
                width: 100%;
                display: flex;
                align-items: center;
            }

            .toggle-password {
                position: absolute;
                top: 53%;
            }
        }
    </style>
</head>

<body>


    <div class="container  d-flex flex-column align-items-center" style="min-height: 100vh; ">
        <h1 class="text-center mb-5">Edit hak akses Admin</h1>
        <div class="row justify-content-center " style="width: 100%">
            <div class="col-8 ">
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
                        <form action="/insert/admin/{{ $admin->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    value="{{ $admin->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" placeholder="masukan password baru" name="password"
                                    id="password" class="form-control">
                                <i id="toggleIcon" class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <!-- main Js -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>
