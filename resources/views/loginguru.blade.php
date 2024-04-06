<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login admin</title>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <div class="container-fluid hero">
        <div class="container">
            <div class="card">
                <h3 class="text-center" style="color: white;">Login Wali Kelas</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="var">
                    <i class="fa-solid fa-key icon text-center"></i>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3" width="100%">
                        <input type="text" name="username" id="usename" required>
                        <label for="name"><i class="fa-solid fa-user"
                                style="margin-right: 5px;"></i>Username</label>
                    </div>

                    <div class="mb-3">
                        <select id="tingkat" name="tingkat" onchange="hideOption(this)">
                            <option value="" selected>tingkat</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select id="jurusan" name="jurusan" onchange="hideOption(this)">
                            <option value="" selected>Pilih</option>
                            <option value="DPIB 1">DPIB 1</option>
                            <option value="DPIB 2">DPIB 2</option>
                            <option value="TP 1">TP 1</option>
                            <option value="TP 2">TP 2</option>
                            <option value="TP 3">TP 3</option>
                            <option value="TKR 1">TKR 1</option>
                            <option value="TKR 2">TKR 2</option>
                            <option value="TKR 3">TKR 3</option>
                            <option value="TKR Industri">TKR Industri</option>
                            <option value="TSM 1">TSM 1</option>
                            <option value="TSM 2">TSM 2</option>
                            <option value="TSM 3">TSM 3</option>
                            <option value="TSM Industri">TSM Industri</option>
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
                            <option value="TKJ 4">TKJ 4</option>
                            <option value="TKJ ACP">TKJ ACP</option>
                            <option value="RPL">RPL</option>
                        </select>
                    </div>

                    <div class="mb-3 password-container">
                        <input type="password" name="password" id="password" required>
                        <label for="password"><i class="fa-solid fa-lock"
                                style="margin-right: 5px;"></i>Password</label>
                        <i id="toggleIcon" class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                    </div>
                    <button type="submit" name="submit" id="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
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
