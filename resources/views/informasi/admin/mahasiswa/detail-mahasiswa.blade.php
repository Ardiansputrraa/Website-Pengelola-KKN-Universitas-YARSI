<!DOCTYPE html>
<html lang="en">

<head>

    <x-header></x-header>
    <script>
        function updateDataMahasiswa() {
            let data_mahasiswa = new FormData();
            let namaLengkap = $("#namaLengkap").val() || (@json($mahasiswa->nama_lengkap) === null ? "Nama Lengkap" :
                @json($mahasiswa->nama_lengkap));
            let npm = $("#npm").val() || @json($mahasiswa->npm);
            let fakultas = $("#fakultas").val() || @json($mahasiswa->fakultas);
            let prodi = $("#prodi").val() || @json($mahasiswa->prodi);
            let email = $("#email").val() || @json($mahasiswa->email);
            let nomerWhatsapp = $("#nomerWhatsapp").val() ||
                (@json($mahasiswa->nomer_whatsapp) === null ? "Nomer Whatsapp" : @json($mahasiswa->nomer_whatsapp));

            data_mahasiswa.append("_token", "{{ csrf_token() }}");
            data_mahasiswa.append("user_id", "{{ $mahasiswa->user_id }}");
            data_mahasiswa.append("namaLengkap", namaLengkap);
            data_mahasiswa.append("fakultas", fakultas);
            data_mahasiswa.append("prodi", prodi);
            data_mahasiswa.append("nomerWhatsapp", nomerWhatsapp);

            if ($("#email").val() != "") {
                data_mahasiswa.append("email", email);
            }
            if ($("#npm").val() != "") {
                data_mahasiswa.append("npm", npm);
            }

            $.ajax({
                type: "POST",
                url: "{{ route('update.data.mahasiswa') }}",
                data: data_mahasiswa,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: "Update Berhasil",
                        text: "Data Mahasiswa Berhasil Diubah!",
                        icon: "success",
                        confirmButtonText: "Oke",
                    });
                },
                error: function(xhr) {
                    let response;
                    try {
                        response = JSON.parse(xhr.responseText);
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }

                    if (response && response.message) {
                        if (response.message === "Email sudah digunakan!") {
                            Swal.fire({
                                title: "Update Gagal",
                                text: "Email tersebut telah terdaftar. Silakan gunakan email lain!",
                                icon: "error",
                                confirmButtonText: "Oke",
                            });
                        } else if (response.message === "NPM sudah digunakan!") {
                            Swal.fire({
                                title: "Update Gagal",
                                text: "NPM tersebut telah terdaftar. Silakan gunakan NPM lain!",
                                icon: "error",
                                confirmButtonText: "Oke",
                            });
                        }
                    } else {
                        Swal.fire({
                            title: "Update Gagal",
                            text: "Terjadi kesalahan tidak dikenal. Silakan coba lagi!",
                            icon: "error",
                            confirmButtonText: "Oke",
                        });
                    }
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

                <h1 class="app-page-title">Profil Mahasiswa</h1>
                <div class="row gy-4">
                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                            </svg>
                                        </div><!--//icon-holder-->

                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Data Diri {{ $mahasiswa->nama_lengkap }}</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">
                                <div class="row py-3">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <label for="namaLengkap" class="form-label"><strong>Nama
                                                Lengkap</strong></label>
                                        <input type="text" class="form-control" id="namaLengkap"
                                            placeholder="{{ $mahasiswa->nama_lengkap ?? 'Nama Lengkap' }}" />
                                    </div>
                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <label for="npm" class="form-label"><strong>NPM</strong></label>
                                        <input type="text" class="form-control" id="npm"
                                            placeholder="{{ $mahasiswa->npm ?? 'NPM' }}" />
                                    </div>
                                </div>

                                <div class="row py-3">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <label for="fakultas" class="form-label"><strong>Fakultas</strong></label>
                                        <select class="form-control" id="fakultas" name="fakultas">
                                            <option disabled selected>Pilih Fakultas</option>
                                            <option value="Fakultas Kedokteran"
                                                {{ $mahasiswa->fakultas == 'Fakultas Kedokteran' ? 'selected' : '' }}>
                                                Fakultas Kedokteran</option>
                                            <option value="Fakultas Kedokteran Gigi"
                                                {{ $mahasiswa->fakultas == 'Fakultas Kedokteran Gigi' ? 'selected' : '' }}>
                                                Fakultas Kedokteran Gigi</option>
                                            <option value="Fakultas Psikologi"
                                                {{ $mahasiswa->fakultas == 'Fakultas Psikologi' ? 'selected' : '' }}>
                                                Fakultas Psikologi</option>
                                            <option value="Fakultas Ekonomi"
                                                {{ $mahasiswa->fakultas == 'Fakultas Ekonomi' ? 'selected' : '' }}>
                                                Fakultas Ekonomi</option>
                                            <option value="Fakultas Teknologi Informasi"
                                                {{ $mahasiswa->fakultas == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>
                                                Fakultas Teknologi Informasi</option>
                                            <option value="Fakultas Hukum"
                                                {{ $mahasiswa->fakultas == 'Fakultas Hukum' ? 'selected' : '' }}>
                                                Fakultas Hukum</option>
                                        </select>
                                    </div>
                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <label for="prodi" class="form-label"><strong>Prodi</strong></label>
                                        <select class="form-control" id="prodi" name="prodi">
                                            <option disabled selected>Pilih Program Studi</option>
                                            <option value="Prodi Kedokteran"
                                                {{ $mahasiswa->prodi == 'Prodi Kedokteran' ? 'selected' : '' }}>Prodi
                                                Kedokteran</option>
                                            <option value="Prodi Kedokteran Gigi"
                                                {{ $mahasiswa->prodi == 'Prodi Kedokteran Gigi' ? 'selected' : '' }}>
                                                Prodi Kedokteran Gigi</option>
                                            <option value="Prodi Psikologi"
                                                {{ $mahasiswa->prodi == 'Prodi Psikologi' ? 'selected' : '' }}>Prodi
                                                Psikologi</option>
                                            <option value="Prodi Akutansi"
                                                {{ $mahasiswa->prodi == 'Prodi Akutansi' ? 'selected' : '' }}>Prodi
                                                Akutansi</option>
                                            <option value="Prodi Manajemen"
                                                {{ $mahasiswa->prodi == 'Prodi Manajemen' ? 'selected' : '' }}>Prodi
                                                Manajemen</option>
                                            <option value="Prodi Teknik Informatika"
                                                {{ $mahasiswa->prodi == 'Prodi Teknik Informatika' ? 'selected' : '' }}>
                                                Prodi Teknik Informatika</option>
                                            <option value="Prodi Perpustakaan Sains Informasi"
                                                {{ $mahasiswa->prodi == 'Prodi Perpustakaan Sains Informasi' ? 'selected' : '' }}>
                                                Prodi Perpustakaan Sains Informasi</option>
                                            <option value="Prodi Hukum"
                                                {{ $mahasiswa->prodi == 'Prodi Hukum' ? 'selected' : '' }}>Prodi Hukum
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row py-3">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label"><strong>Email</strong></label>
                                        <input type="text" class="form-control" id="email"
                                            placeholder="{{ $mahasiswa->email ?? 'Email' }}" />
                                    </div>
                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <label for="nomerWhatsapp" class="form-label"><strong>Nomer
                                                Whatsapp</strong></label>
                                        <input type="text" class="form-control" id="nomerWhatsapp"
                                            placeholder="{{ $mahasiswa->nomer_whatsapp ?? 'Nomer Whatsapp' }}" />
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <label class="form-label"><strong>Kartu Tanda Mahasiswa</strong></label>
                                        <div>
                                            @if (!empty($mahasiswa->file_ktm))
                                                <img src="{{ asset($mahasiswa->file_ktm) }}"
                                                    alt="Kartu Tanda Mahasiswa" class="img-fluid"
                                                    style="max-width: 100%; height: 250px;" />
                                            @else
                                                <p>Mahasiswa belum mengupload Kartu Tanda Mahasiswa.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <button class="btn app-btn-primary me-2" type="button"
                                            onclick="updateDataMahasiswa()">Update
                                            Data</button>
                                        <a class="btn app-btn-secondary" href="{{ route('view.data.mahasiswa') }}">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div><!--//app-card-body-->


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
