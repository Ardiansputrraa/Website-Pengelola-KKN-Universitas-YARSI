<!DOCTYPE html>
<html lang="en">

<head>

    <x-header></x-header>
    <script>
        $(document).ready(function() {

        });

        function pengajuanKKNReguler() {
            $('#pengajuanKKNRegulerModal').modal('show');
        }

        function daftarKKNReguler() {
            let namaLengkap = $('#namaLengkap').val();
            let npm = $('#npm').val();
            let fakultas = $('#fakultas').val();
            let prodi = $('#prodi').val();
            let email = $('#email').val();
            let nomerWhatsapp = $('#nomerWhatsapp').val();
            let fileInput = $('#ktm')[0];
            let file = fileInput.files[0];

            if (namaLengkap === "") {
                $("#helpNama")
                    .text("Silahkan masukan nama lengkap!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#namaLengkap").focus();
                return;
            }

            if (namaLengkap != "") {
                $("#helpNama")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (npm === "") {
                $("#helpNPM")
                    .text("Silahkan masukan npm!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#npm").focus();
                return;
            }

            if (npm != "") {
                $("#helpNPM")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (email === "") {
                $("#helpEmail")
                    .text("Silahkan masukan email!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#email").focus();
                return;
            }

            if (email != "") {
                $("#helpEmail")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (nomerWhatsapp === "") {
                $("#helpNoWa")
                    .text("Silahkan masukan nomer Whatsapp!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#nomerWhatsapp").focus();
                return;
            }

            if (nomerWhatsapp != "") {
                $("#helpNoWa")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (!file) {
                $("#helpKTM")
                    .text("Silahkan pilih file terlebih dahulu!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                return;
            }

            if (file) {
                $("#helpKTM")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            Swal.fire({
                title: "Validasi Data",
                text: "Apakah data yang dimasukan sudah sesuai?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Lanjutkan Mendaftar",
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn app-btn-primary',
                    cancelButton: 'btn app-btn-secondary',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('user_id', "{{ $user->id }}");
                    formData.append('namaLengkap', namaLengkap);
                    formData.append('npm', npm);
                    formData.append('fakultas', fakultas);
                    formData.append('prodi', prodi);
                    formData.append('email', email);
                    formData.append('nomerWhatsapp', nomerWhatsapp);
                    formData.append('file_ktm', file);
                    formData.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('daftar.kkn.reguler') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                title: "Berhasil",
                                text: "Selamat Anda Berhasil Mendaftar KKN Reguler!",
                                icon: "success",
                                confirmButtonText: "Oke",
                                customClass: {
                                    confirmButton: 'btn app-btn-primary',
                                    cancelButton: 'btn app-btn-secondary',
                                },
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/dahsboard-kkn-universitas-yarsi";
                                }
                            });
                        },
                        error: function(xhr) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.message === "Email sudah digunakan!") {
                                Swal.fire({
                                    title: "Registrasi Gagal",
                                    text: "Email tersebut telah terdaftar. Silakan gunakan email lain!",
                                    icon: "error",
                                    confirmButtonText: "Oke",
                                    customClass: {
                                        confirmButton: 'btn app-btn-primary',
                                        cancelButton: 'btn app-btn-secondary',
                                    },
                                });
                            } else if (response.message === "NPM sudah digunakan!") {
                                Swal.fire({
                                    title: "Registrasi Gagal",
                                    text: "NPM tersebut telah terdaftar. Silakan gunakan NPM lain!",
                                    icon: "error",
                                    confirmButtonText: "Oke",
                                    customClass: {
                                        confirmButton: 'btn app-btn-primary',
                                        cancelButton: 'btn app-btn-secondary',
                                    },
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: "Registrasi Gagal Silahkan Coba Nanti!",
                                    icon: "error",
                                    confirmButtonText: "Oke",
                                    customClass: {
                                        confirmButton: 'btn app-btn-primary',
                                        cancelButton: 'btn app-btn-secondary',
                                    },
                                });
                            }
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Dibatalkan",
                        text: "Registrasi telah dibatalkan!",
                        icon: "info",
                        confirmButtonText: "Oke",
                        customClass: {
                            confirmButton: 'btn app-btn-primary',
                            cancelButton: 'btn app-btn-secondary',
                        },
                    });
                }
            });

        }
    </script>
</head>

<body class="app">
    <header class="app-header fixed-top">

        <x-navbar></x-navbar>

        <x-sidebar></x-sidebar>


    </header><!--//app-header-->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row">
                    <div class="col-12 col-md-11 col-lg-7 col-xl-6 mx-auto">
                        <div class="app-branding text-center mb-1">

                        </div><!--//app-branding-->
                        <div class="app-card p-5 text-center shadow-sm">
                            <h1 class="page-title mb-4"><br><span class="font-weight-light">Registrasi KKN</span>
                            </h1>
                            <div class="mb-4">
                                Silahkan anda melakukan pengajuan KKN
                            </div>
                            <div class="mb-3">
                                <button type="button" onclick="pengajuanKKNReguler()" class="btn app-btn-primary">Pengajuan KKN
                                    Reguler</button>
                            </div>
                            <div class="mb-3">
                                <a class="btn app-btn-secondary" href="index.html">Pengajuan KKN Konversi</a>
                            </div>
                        </div>
                    </div><!--//col-->
                </div><!--//row-->

            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <div class="modal fade" id="pengajuanKKNRegulerModal" tabindex="-1"
            aria-labelledby="pengajuanKKNRegulerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pengajuanKKNRegulerModalLabel">Pengajuan KKN Reguler</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="namaLengkap" class="col-form-label"><strong>Nama
                                        Lengkap</strong></label>
                                <input type="text" class="form-control" id="namaLengkap"
                                    value="{{ $user->getTableDatabase()->nama_lengkap ? $user->getTableDatabase()->nama_lengkap : '' }}" />
                                <p id="helpNama" class="help is-hidden"></p>
                            </div>
                            <div class="mb-3">
                                <label for="npm" class="col-form-label"><strong>NPM</strong></label>
                                <input type="text" class="form-control" id="npm"
                                    value="{{ $user->getTableDatabase()->npm ? $user->getTableDatabase()->npm : '' }}" />
                                <p id="helpNPM" class="help is-hidden"></p>
                            </div>
                            <div class="mb-3">
                                <label for="falkutas" class="col-form-label"><strong>Fakultas</strong></label>
                                <select class="form-control" id="fakultas" name="fakultas">
                                    <option value="none" disabled selected>Pilih Fakultas</option>
                                    <option value="Fakultas Kedokteran"
                                        {{ $user->getTableDatabase()->fakultas == 'Fakultas Kedokteran' ? 'selected' : '' }}>
                                        Fakultas Kedokteran</option>
                                    <option value="Fakultas Kedokteran Gigi"
                                        {{ $user->getTableDatabase()->fakultas == 'Fakultas Kedokteran Gigi' ? 'selected' : '' }}>
                                        Fakultas Kedokteran Gigi</option>
                                    <option value="Fakultas Psikologi"
                                        {{ $user->getTableDatabase()->fakultas == 'Fakultas Psikologi' ? 'selected' : '' }}>
                                        Fakultas Psikologi</option>
                                    <option value="Fakultas Ekonomi"
                                        {{ $user->getTableDatabase()->fakultas == 'Fakultas Ekonomi' ? 'selected' : '' }}>
                                        Fakultas Ekonomi dan Bisnis</option>
                                    <option value="Fakultas Teknologi Informasi"
                                        {{ $user->getTableDatabase()->fakultas == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>
                                        Fakultas Teknologi Informasi</option>
                                    <option value="Fakultas Hukum"
                                        {{ $user->getTableDatabase()->fakultas == 'Fakultas Hukum' ? 'selected' : '' }}>
                                        Fakultas Hukum</option>
                                </select>
                                <p id="helpFakultas" class="help is-hidden"></p>
                            </div>
                            <div class="mb-3">
                                <label for="prodi" class="col-form-label"><strong>Prodi</strong></label>
                                <select class="form-control" id="prodi" name="prodi">
                                    <option value="none" disabled selected>Pilih Program Studi</option>
                                    <option value="Prodi Kedokteran"
                                        {{ $user->getTableDatabase()->prodi == 'Prodi Kedokteran' ? 'selected' : '' }}>
                                        Prodi Kedokteran</option>
                                    <option value="Prodi Kedokteran Gigi"
                                        {{ $user->getTableDatabase()->prodi == 'Prodi Kedokteran Gigi' ? 'selected' : '' }}>
                                        Prodi Kedokteran Gigi</option>
                                    <option value="Prodi Psikologi"
                                        {{ $user->getTableDatabase()->prodi == 'Prodi Psikologi' ? 'selected' : '' }}>
                                        Prodi Psikologi</option>
                                    <option value="Prodi Akutansi"
                                        {{ $user->getTableDatabase()->prodi == 'Prodi Akutansi' ? 'selected' : '' }}>
                                        Prodi Akutansi</option>
                                    <option value="Prodi Manajemen"
                                        {{ $user->getTableDatabase()->prodi == 'Prodi Manajemen' ? 'selected' : '' }}>
                                        Prodi Manajemen</option>
                                    <option value="Prodi Teknik Informatika"
                                        {{ $user->getTableDatabase()->prodi == 'Prodi Teknik Informatika' ? 'selected' : '' }}>
                                        Prodi Teknik Informatika</option>
                                    <option value="Prodi Perpustakaan Sains Informasi"
                                        {{ $user->getTableDatabase()->prodi == 'Prodi Perpustakaan Sains Informasi' ? 'selected' : '' }}>
                                        Prodi Perpustakaan Sains Informasi</option>
                                    <option value="Prodi Hukum"
                                        {{ $user->getTableDatabase()->prodi == 'Prodi Hukum' ? 'selected' : '' }}>
                                        Prodi Hukum</option>
                                </select>
                                <p id="helpProdi" class="help is-hidden"></p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label"><strong>Email</strong></label>
                                <input type="email" class="form-control" id="email"
                                    value="{{ $user->getTableDatabase()->email ? $user->getTableDatabase()->email : '' }}" />
                                <p id="helpEmail" class="help is-hidden"></p>
                            </div>
                            <div class="mb-3">
                                <label for="nomerWhatsapp" class="col-form-label"><strong>Nomer
                                        Whatsapp Aktif</strong></label>
                                <input type="text" class="form-control" id="nomerWhatsapp"
                                    value="{{ $user->getTableDatabase()->nomer_whatsapp ? $user->getTableDatabase()->nomer_whatsapp : '' }}" />
                                <p id="helpNoWa" class="help is-hidden"></p>
                            </div>
                            <div class="mb-3">
                                <label for="ktm" class="col-form-label"><strong>
                                        Upload File KTM</strong></label>
                                <input type="file" class="form-control" id="ktm"
                                    placeholder="Upload File KTM" />
                                <p id="helpKTM" class="help is-hidden"></p>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn app-btn-primary" onclick="daftarKKNReguler()">Daftar KKN
                            Reguler</button>
                    </div>
                </div>
            </div>
        </div>


        <x-footer></x-footer>

    </div><!--//app-wrapper-->

</body>
<!-- Javascript -->
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script>

</html>
