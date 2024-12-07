<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>

    <script>
        function login() {
            let username = $("#username").val();
            let password = $("#password").val();

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

            $.ajax({
                type: "POST",
                url: "{{ route('login.check') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username,
                    password: password,
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Login Berhasil",
                        text: "Selamat anda berhasil login!",
                        confirmButtonText: "Oke",
                    }).then(() => {
                        window.location.href = "/register?role=admin";
                        
                    });
                },
                error: function(xhr) {
                    var errorResponse = JSON.parse(xhr.responseText);
                    var errorMessage = errorResponse.message || 'Terjadi kesalahan. Silakan coba lagi.';
                    Swal.fire({
                        icon: "error",
                        title: "Login Gagal!",
                        text: "Pastikan username dan password telah sesuai!",
                        confirmButtonText: "Oke",
                    });
                }
            });
        }
    </script>
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2"
                                src="assets/images/logo.jpg" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-5">Login Dashboard KKN</h2>
                    <div class="auth-form-container text-start">
                        <form class="auth-form login-form">
                            <div class="email mb-3">
                                <label class="sr-only" for="signin-email">Username</label>
                                <input id="username" name="username" type="text" class="form-control signin-email"
                                    placeholder="Username">
                                <p id="helpUsername" class="help is-hidden"></p>
                            </div><!--//form-group-->
                            <div class="password mb-3">
                                <label class="sr-only" for="signin-password">Password</label>
                                <input id="password" name="password" type="password"
                                    class="form-control signin-password" placeholder="Password">
                                <p id="helpPassword" class="help is-hidden"></p>
                                <div class="extra mt-3 row justify-content-between">
                                    <div class="col-6">
                                        <div class="form-check">

                                        </div>
                                    </div><!--//col-6-->
                                    <div class="col-6">
                                    </div><!--//col-6-->
                                </div><!--//extra-->
                            </div><!--//form-group-->
                            <div class="text-center">
                                <button type="button" class="btn app-btn-primary w-100 theme-btn mx-auto"
                                    onclick="login()">Log In</button>
                            </div>
                        </form>


                    </div><!--//auth-form-container-->

                </div><!--//auth-body-->

            </div><!--//flex-column-->
        </div><!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">
            </div>
            <div class="auth-background-mask"></div>

        </div><!--//auth-background-col-->
    </div><!--//row-->


</body>

</html>
