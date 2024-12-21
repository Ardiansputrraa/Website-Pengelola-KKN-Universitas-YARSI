<!DOCTYPE html>
<html lang="en">

<head>

    <x-header></x-header>
    <script>
        function buatKelompok() {
            let namaKelompok = $("#namaKelompok").val();
            let dplId = $("#namaDosen").val();
            let lokasi = $("#lokasi").val();
            let mahasiswaFK = $("#mahasiswaFK").val();
            let mahasiswaFKG = $("#mahasiswaFKG").val();
            let mahasiswaFH = $("#mahasiswaFH").val();
            let mahasiswaFEB = $("#mahasiswaFEB").val();
            let mahasiswaFTI = $("#mahasiswaFTI").val();
            let mahasiswaPsikologi = $("#mahasiswaPsikologi").val();


            if (namaKelompok === "") {
                $("#helpNamaKelompok")
                    .text("Silahkan pilih Nama Kelompok!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#namaKelompok").focus();
                return;
            }

            if (namaKelompok != "") {
                $("#helpNamaKelompok")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (dplId === "") {
                $("#helpNamaDosen")
                    .text("Silahkan pilih DPL!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#namaDosen").focus();
                return;
            }

            if (dplId != "") {
                $("#helpNamaDosen")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (lokasi === "") {
                $("#helpLokasi")
                    .text("Silahkan pilih Nama Kelompok!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#lokasi").focus();
                return;
            }

            if (lokasi != "") {
                $("#helpLokasi")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }
            validasi = mahasiswaFK.length + mahasiswaFKG.length + mahasiswaFEB.length + mahasiswaFH.length + mahasiswaFTI
                .length + mahasiswaPsikologi.length;
            if (validasi <= 0) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Belum memilih mahasiswa.",
                    confirmButtonText: "Tutup",
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('create.kelompok.kkn') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    nama_kelompok: namaKelompok,
                    lokasi: lokasi,
                    dpl_id: dplId,
                },
                success: function(response) {
                    let kelompok_kkn_id = response.kelompok_kkn_id;

                    for (let i = 0; i < mahasiswaFK.length; i++) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('add.mahasiswa.to.kelompok') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kelompok_kkn_id: kelompok_kkn_id,
                                mahasiswa_id: mahasiswaFK[i],
                            },
                            success: function(response) {
                                console.log("Mahasiswa berhasil dibuat");
                            },
                        });
                    }

                    for (let i = 0; i < mahasiswaFKG.length; i++) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('add.mahasiswa.to.kelompok') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kelompok_kkn_id: kelompok_kkn_id,
                                mahasiswa_id: mahasiswaFKG[i],
                            },
                            success: function(response) {
                                console.log("Mahasiswa berhasil dibuat");
                            },
                        });
                    }

                    for (let i = 0; i < mahasiswaFH.length; i++) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('add.mahasiswa.to.kelompok') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kelompok_kkn_id: kelompok_kkn_id,
                                mahasiswa_id: mahasiswaFH[i],
                            },
                            success: function(response) {
                                console.log("Mahasiswa berhasil dibuat");
                            },
                        });
                    }

                    for (let i = 0; i < mahasiswaFEB.length; i++) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('add.mahasiswa.to.kelompok') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kelompok_kkn_id: kelompok_kkn_id,
                                mahasiswa_id: mahasiswaFEB[i],
                            },
                            success: function(response) {
                                console.log("Mahasiswa berhasil dibuat");
                            },
                        });
                    }

                    for (let i = 0; i < mahasiswaFTI.length; i++) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('add.mahasiswa.to.kelompok') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kelompok_kkn_id: kelompok_kkn_id,
                                mahasiswa_id: mahasiswaFTI[i],
                            },
                            success: function(response) {
                                console.log("Mahasiswa berhasil dibuat");
                            },
                        });
                    }

                    for (let i = 0; i < mahasiswaPsikologi.length; i++) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('add.mahasiswa.to.kelompok') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kelompok_kkn_id: kelompok_kkn_id,
                                mahasiswa_id: mahasiswaPsikologi[i],
                            },
                            success: function(response) {
                                console.log("Mahasiswa berhasil dibuat");
                            },
                        });
                    }
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.nama_kelompok) {
                            $("#helpNamaKelompok")
                                .text("Nama kelompok telah digunakan!")
                                .removeClass("is-safe")
                                .addClass("is-danger");
                            $("#namaKelompok").focus();
                        }
                    }
                },
            });

            if (validasi > 0) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Kelompok KKN berhasil dibuat.",
                    confirmButtonText: "Tutup",
                }).then(() => {
                        window.location.href = "{{ route('view.data.kelompok') }}"
                });
            }
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
                <h1 class="app-page-title">Kelompok KKN</h1>
                <div class="row gy-4">


                    <div class="col-4 col-lg-4">
                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                            </svg>
                                        </div><!--//icon-holder-->

                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Data Kelompok KKN</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">

                                <!--Content Buat Akun Kelompok KKN-->
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-14">
                                            <label for="namaKelompok" class="form-label"><strong>Nama
                                                    Kelompok</strong></label>
                                            <input type="text" class="form-control" id="namaKelompok"
                                                placeholder="Nama Kelompok" />
                                            <p id="helpNamaKelompok" class="help is-hidden"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-14">
                                            <label for="namaDosen" class="form-label"><strong>Nama
                                                    Dosen</strong></label>
                                            <select class="form-control" id="namaDosen" name="namaDosen">
                                                <option value="" selected>Pilih DPL</option>
                                                @foreach ($dpls as $dpl)
                                                    <option value={{ $dpl->id }}>
                                                        {{ $dpl->nama_lengkap }}, {{ $dpl->gelar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <p id="helpNamaDosen" class="help is-hidden"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-14">
                                            <label for="lokasi" class="form-label"><strong>Lokasi KKN</strong></label>
                                            <input type="text" class="form-control" id="lokasi"
                                                placeholder="Lokasi KKN" />
                                            <p id="helpLokasi" class="help is-hidden"></p>
                                        </div>
                                    </div>
                                </div>

                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <button class="btn app-btn-primary" type="button" onclick="buatKelompok()">Buat
                                    Kelompok</button>
                                <a href="javascript:history.back()" class="btn app-btn-secondary">Kembali</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->


                    <div class="col-8 col-lg-8">
                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Daftar Mahasiswa</h4>
                                        <p>Bisa pilih lebih dari satu.</p>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">

                                <!--Content Buat Akun Kelompok KKN-->
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-6">
                                            <label for="mahasiswaFK" class="form-label"><strong>Mahasiswa
                                                    FK</strong></label>
                                            <select class="form-control" id="mahasiswaFK" name="mahasiswaFK" multiple
                                                size="6" style="height: 120px;">
                                                @foreach ($mahasiswaFK as $mahasiswa)
                                                    <option value={{ $mahasiswa->id }}>
                                                        {{ $mahasiswa->nama_lengkap }} - {{ $mahasiswa->npm }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mahasiswaFKG" class="form-label"><strong>Mahasiswa
                                                    FKG</strong></label>
                                            <select class="form-control" id="mahasiswaFKG" name="mahasiswaFKG" multiple
                                                size="6" style="height: 120px;">

                                                @foreach ($mahasiswaFKG as $mahasiswa)
                                                    <option value={{ $mahasiswa->id }}>
                                                        {{ $mahasiswa->nama_lengkap }} - {{ $mahasiswa->npm }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-6">
                                            <label for="mahasiswaFH" class="form-label"><strong>Mahasiswa
                                                    FH</strong></label>
                                            <select class="form-control" id="mahasiswaFH" name="mahasiswaFH" multiple
                                                size="6" style="height: 50px;">

                                                @foreach ($mahasiswaFH as $mahasiswa)
                                                    <option value={{ $mahasiswa->id }}>
                                                        {{ $mahasiswa->nama_lengkap }} - {{ $mahasiswa->npm }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mahasiswaFEB" class="form-label"><strong>Mahasiswa
                                                    FEB</strong></label>
                                            <select class="form-control" id="mahasiswaFEB" name="mahasiswaFEB"
                                                multiple size="6" style="height: 50px;">

                                                @foreach ($mahasiswaFEB as $mahasiswa)
                                                    <option value={{ $mahasiswa->id }}>
                                                        {{ $mahasiswa->nama_lengkap }} - {{ $mahasiswa->npm }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-6">
                                            <label for="mahasiswaFTI" class="form-label"><strong>Mahasiswa
                                                    FTI</strong></label>
                                            <select class="form-control" id="mahasiswaFTI" name="mahasiswaFTI"
                                                multiple size="6" style="height: 50px;">

                                                @foreach ($mahasiswaFTI as $mahasiswa)
                                                    <option value={{ $mahasiswa->id }}>
                                                        {{ $mahasiswa->nama_lengkap }} - {{ $mahasiswa->npm }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mahasiswaPsikologi" class="form-label"><strong>Mahasiswa
                                                    Psikologi</strong></label>
                                            <select class="form-control" id="mahasiswaPsikologi"
                                                name="mahasiswaPsikologi" multiple size="6"
                                                style="height: 50px;">

                                                @foreach ($mahasiswaPsikologi as $mahasiswa)
                                                    <option value={{ $mahasiswa->id }}>
                                                        {{ $mahasiswa->nama_lengkap }} - {{ $mahasiswa->npm }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->

                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <x-footer></x-footer>

    </div><!--//app-wrapper-->

</body>
<!-- Javascript -->
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script>

</html>
