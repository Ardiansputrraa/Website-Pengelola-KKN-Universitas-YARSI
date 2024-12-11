<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>

    <script>
        function ubahPassword() {
            let username = $("#username").val();
            let passwordLama = $("#passwordLama").val();
            let passwordBaru = $("#passwordBaru").val();
            let konfirmasiPassword = $("#konfirmasiPassword").val();

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

            if (passwordLama === "") {
                $("#helpPasswordLama")
                    .text("Silahkan masukan password lama!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#passwordLama").focus();
                return;
            }

            if (passwordLama != "") {
                $("#helpPasswordLama")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (passwordBaru === "") {
                $("#helpPasswordBaru")
                    .text("Silahkan masukan password baru!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#passwordBaru").focus();
                return;
            }

            if (passwordBaru != "") {
                $("#helpPasswordBaru")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (!is_password(passwordBaru)) {
                $("#helpPasswordBaru")
                    .text(
                        "Password harus menggunakan 8-20 , angka, atau spesial karakter (!@#$%^&*)!"
                    )
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#password").focus();
                return;
            }

            if (is_password(passwordBaru)) {
                $("#helpPasswordBaru")
                    .text("Password dapat digunakan!")
                    .removeClass("is-danger")
                    .addClass("is-success");
            }

            if (konfirmasiPassword === "") {
                $("#helpKonfirmasiPassword")
                    .text("Silahkan masukan konfirmasi password baru!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#konfirmasiPassword").focus();
                return;
            }

            if (konfirmasiPassword != passwordBaru) {
                $("#helpKonfirmasiPassword")
                    .text("Password tidak sesuai!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#konfirmasiPassword").focus();
                return;
            }

            if (konfirmasiPassword === passwordBaru) {
                $("#helpKonfirmasiPassword")
                    .text("Password sudah sesuai!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#konfirmasiPassword").focus();
            }

            $.ajax({
                type: "POST",
                url: "{{ route('update.password') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username,
                    passwordLama: passwordLama,
                    passwordBaru: passwordBaru,
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Update Berhasil",
                        text: response.message,
                        confirmButtonText: "Oke",
                        customClass: {
                            confirmButton: 'btn app-btn-primary',
                            cancelButton: 'btn app-btn-secondary',
                        },
                    }).then(() => {
                        window.location.href = "{{ route('profile') }}"
                    });

                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Update Gagal",
                        text: xhr.responseJSON.message,
                        confirmButtonText: "Oke",
                        customClass: {
                            confirmButton: 'btn app-btn-primary',
                            cancelButton: 'btn app-btn-secondary',
                        },
                    });
                }
            });
        }

        function is_password(asValue) {
            let regExp = /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%^&*]{8,20}$/;
            return regExp.test(asValue);
        }
    </script>
</head>

<body class="app app-signup p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2"
                                src="assets/images/logo.jpg" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-4">Dashboard KKN</h2>

                    <div class="auth-form-container text-start mx-auto">
                        <form class="auth-form auth-signup-form" action="{{ route('register.save') }}" method="POST">
                            @csrf
                            <div class="email mb-3">
                                <label class="sr-only" for="signup-email">Username</label>
                                <input id="username" name="username" type="text" class="form-control signup-email"
                                    placeholder="Username" value="{{ $user->username }}">

                                <p id="helpUsername" class="help is-hidden"></p>

                            </div>
                            <div class="password mb-3">
                                <label class="sr-only" for="signup-password">Password Lama</label>
                                <input id="passwordLama" name="passwordLama" type="password"
                                    class="form-control signup-password" placeholder="Password Lama">
                                <p id="helpPasswordLama" class="help is-hidden"></p>

                            </div>
                            <div class="password mb-3">
                                <label class="sr-only" for="signup-password">Password Baru</label>
                                <input id="passwordBaru" name="passwordBaru" type="password"
                                    class="form-control signup-password" placeholder="Password Baru">
                                <p id="helpPasswordBaru" class="help is-hidden"></p>

                            </div>
                            <div class="password mb-3">
                                <label class="sr-only" for="signup-password">Konfirmasi Password Baru</label>
                                <input id="konfirmasiPassword" name="konfirmasiPassword" type="password"
                                    class="form-control signup-password" placeholder="Konfirmasi Password Baru">

                                <p id="helpKonfirmasiPassword" class="help is-hidden"></p>

                            </div>

                            <div class="text-center">
                                <button type="button" class="btn app-btn-primary w-100 theme-btn mx-auto mb-2 mt-1"
                                    onclick="ubahPassword()">Ubah Password</button>
                                    <a href="javascript:history.back()" class="btn app-btn-secondary w-100 theme-btn mx-auto">Kembali</a>

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
