<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>

    <script>
        function register() {
            let username = $("#username").val();
            let namaLengkap = $("#namaLengkap").val();
            let password = $("#password").val();
            let konfirmasiPassword = $("#konfirmasiPassword").val();
            let role = '{{ $role }}';

            if (namaLengkap === "") {
                $("#helpNamaLengkap")
                    .text("Silahkan masukan nama lengkap!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#namaLengkap").focus();
                return;
            }

            if (username === "") {
                $("#helpUsername")
                    .text("Silahkan masukan username!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#username").focus();
                return;
            }

            if (username != "") {
                $("#helpUsername")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (password === "") {
                $("#helpPassword")
                    .text("Silahkan masukan password!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#password").focus();
                return;
            }

            if (password != "") {
                $("#helpPassword")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (!is_password(password)) {
                $("#helpPassword")
                    .text(
                        "Password harus menggunakan 8-20 , angka, atau spesial karakter (!@#$%^&*)!"
                    )
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#password").focus();
                return;
            }

            if (is_password(password)) {
                $("#helpPassword")
                    .text("Password dapat digunakan!")
                    .removeClass("is-danger")
                    .addClass("is-success");
            }

            if (konfirmasiPassword === "") {
                $("#helpKonfirmasiPassword")
                    .text("Silahkan masukan konfirmasi password!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#konfirmasiPassword").focus();
                return;
            }

            if (konfirmasiPassword != password) {
                $("#helpKonfirmasiPassword")
                    .text("Password tidak sesuai!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#konfirmasiPassword").focus();
                return;
            }

            if (konfirmasiPassword === password) {
                $("#helpKonfirmasiPassword")
                    .text("Password sudah sesuai!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#konfirmasiPassword").focus();

            }
            $.ajax({
                type: "POST",
                url: "{{ route('register.save') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username,
                    password: password,
                    role: role,
                    namaLengkap: namaLengkap,
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Registrasi Berhasil",
                        text: "Akun " + role + " berhasil dibuat!",
                        confirmButtonText: "Oke",
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    if (xhr.status === 422) {
                        console.log(xhr.responseJSON);
                        var errors = xhr.responseJSON.errors;
                        if (errors.username) {
                            $("#helpUsername")
                                .text("Username telah digunakan!")
                                .removeClass("is-safe")
                                .addClass("is-danger");
                            $("#username").focus();
                        } else if (errors.password) {
                            console.log(errors.password)
                        } else if (errors.role) {
                            console.log(errors.role)
                        }
                    }

                }
            });

        }

        function is_password(asValue) {
            let regExp = /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%^&*]{8,20}$/;
            return regExp.test(asValue);
        }

        function logout() {
            $.ajax({
                url: "{{ route('logout') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Logout Berhasil",
                        text: "Anda berhasil logout!",
                        confirmButtonText: "Oke",
                    }).then(() => {
                        window.location.href = "{{ route('login') }}";
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Terjadi kesalahan saat logout. Silakan coba lagi.")
                }
            });
        };
    </script>
</head>

<body class="app app-signup p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2"
                                src="assets/images/logo.jpg" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-4">Register Dashboard KKN</h2>

                    <div class="auth-form-container text-start mx-auto">
                        <form class="auth-form auth-signup-form" action="{{ route('register.save') }}" method="POST">
                            @csrf
                            <div class="email mb-3">
                                <label class="sr-only" for="signup-email">Nama Lengkap</label>
                                <input id="namaLengkap" name="namaLengkap" type="text"
                                    class="form-control signup-name" placeholder="Nama Lengkap">

                                <p id="helpNamaLengkap" class="help is-hidden"></p>
                            </div>
                            <div class="email mb-3">
                                <label class="sr-only" for="signup-email">Username</label>
                                <input id="username" name="username" type="text" class="form-control signup-email"
                                    placeholder="Username">

                                <p id="helpUsername" class="help is-hidden"></p>

                            </div>
                            <div class="password mb-3">
                                <label class="sr-only" for="signup-password">Password</label>
                                <input id="password" name="password" type="password"
                                    class="form-control signup-password" placeholder="Password">

                                <p id="helpPassword" class="help is-hidden"></p>

                            </div>
                            <div class="password mb-3">
                                <label class="sr-only" for="signup-password">Konfirmasi Password</label>
                                <input id="konfirmasiPassword" name="konfirmasiPassword" type="password"
                                    class="form-control signup-password" placeholder="Konfirmasi Password">

                                <p id="helpKonfirmasiPassword" class="help is-hidden"></p>

                            </div>

                            <div class="text-center">
                                <button type="button" class="btn app-btn-primary w-100 theme-btn mx-auto mb-2 mt-1"
                                    onclick="register()">Buat Akun</button>
                                <a href="javascript:history.back()"
                                    class="btn app-btn-secondary w-100 theme-btn mx-auto">Kembali</a>

                            </div>
                        </form><!--//auth-form-->


                    </div><!--//auth-form-container-->



                </div><!--//auth-body-->


            </div><!--//flex-column-->
        </div><!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">
            </div>
            <div class="auth-background-mask"></div>
            <div class="auth-background-overlay p-3 p-lg-5">
                <div class="d-flex flex-column align-content-end h-100">


                </div>
            </div><!--//auth-background-overlay-->
        </div><!--//auth-background-col-->

    </div><!--//row-->


</body>

</html>
