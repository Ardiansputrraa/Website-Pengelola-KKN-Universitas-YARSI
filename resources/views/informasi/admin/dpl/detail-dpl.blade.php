<!DOCTYPE html>
<html lang="en">

<head>

    <x-header></x-header>
    <script>
        function updateDataDpl() {
            let data_dpl = new FormData();
            let namaLengkap = $("#namaLengkap").val() || (@json($dpl->nama_lengkap) === null ? "Nama Lengkap" :
                @json($dpl->nama_lengkap));
            let nip = $("#nip").val() || @json($dpl->nip);
            let gelar = $("#gelar").val() || (@json($dpl->gelar) === null ? "Nama Lengkap" :
                @json($dpl->gelar));
            let fakultas = $("#fakultas").val() || @json($dpl->fakultas);
            let prodi = $("#prodi").val() || @json($dpl->prodi);
            let email = $("#email").val() || @json($dpl->email);
            let namaBank = $("#namaBank").val() || @json($dpl->namaBank);
            let nomerRekening = $("#nomerRekening").val() || (@json($dpl->nomer_rekening) === null ? "Nomer Whatsapp" :
                @json($dpl->nomer_rekening));
            let nomerWhatsapp = $("#nomerWhatsapp").val() ||
                (@json($dpl->nomer_whatsapp) === null ? "Nomer Whatsapp" : @json($dpl->nomer_whatsapp));

            data_dpl.append("_token", "{{ csrf_token() }}");
            data_dpl.append("user_id", "{{ $dpl->user_id }}");
            data_dpl.append("namaLengkap", namaLengkap);
            data_dpl.append("fakultas", fakultas);
            data_dpl.append("prodi", prodi);
            data_dpl.append("namaBank", namaBank);
            data_dpl.append("nomerRekening", nomerRekening);
            data_dpl.append("nomerWhatsapp", nomerWhatsapp);

            if ($("#email").val() != "") {
                data_dpl.append("email", email);
            }
            if ($("#nip").val() != "") {
                data_dpl.append("nip", nip);
            }

            $.ajax({
                type: "POST",
                url: "{{ route('update.data.dpl') }}",
                data: data_dpl,
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
                        } else if (response.message === "NIP sudah digunakan!") {
                            Swal.fire({
                                title: "Update Gagal",
                                text: "NIP tersebut telah terdaftar. Silakan gunakan NPM lain!",
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

                <h1 class="app-page-title">Profil DPL</h1>
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
                                        <h4 class="app-card-title">Data Diri {{ $dpl->nama_lengkap }}</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">
                                <div class="row py-3">
                                    <div class="col-md-4">
                                        <label for="namaLengkap" class="form-label"><strong>Nama
                                                Lengkap</strong></label>
                                        <input type="text" class="form-control" id="namaLengkap"
                                            placeholder="{{ $dpl->nama_lengkap ?? 'Nama Lengkap' }}" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="npm" class="form-label"><strong>NIP</strong></label>
                                        <input type="text" class="form-control" id="nip"
                                            placeholder="{{ $dpl->nip ?? 'NIP' }}" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="npm" class="form-label"><strong>Gelar</strong></label>
                                        <input type="text" class="form-control" id="gelar"
                                            placeholder="{{ $dpl->gelar ?? 'Gelar' }}" />
                                    </div>
                                </div>

                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <label for="fakultas" class="form-label"><strong>Fakultas</strong></label>
                                        <select class="form-control" id="fakultas" name="fakultas">
                                            <option disabled selected>Pilih Fakultas</option>
                                            <option value="Fakultas Kedokteran"
                                                {{ $dpl->fakultas == 'Fakultas Kedokteran' ? 'selected' : '' }}>
                                                Fakultas Kedokteran</option>
                                            <option value="Fakultas Kedokteran Gigi"
                                                {{ $dpl->fakultas == 'Fakultas Kedokteran Gigi' ? 'selected' : '' }}>
                                                Fakultas Kedokteran Gigi</option>
                                            <option value="Fakultas Psikologi"
                                                {{ $dpl->fakultas == 'Fakultas Psikologi' ? 'selected' : '' }}>
                                                Fakultas Psikologi</option>
                                            <option value="Fakultas Ekonomi"
                                                {{ $dpl->fakultas == 'Fakultas Ekonomi' ? 'selected' : '' }}>
                                                Fakultas Ekonomi</option>
                                            <option value="Fakultas Teknologi Informasi"
                                                {{ $dpl->fakultas == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>
                                                Fakultas Teknologi Informasi</option>
                                            <option value="Fakultas Hukum"
                                                {{ $dpl->fakultas == 'Fakultas Hukum' ? 'selected' : '' }}>
                                                Fakultas Hukum</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="prodi" class="form-label"><strong>Prodi</strong></label>
                                        <select class="form-control" id="prodi" name="prodi">
                                            <option disabled selected>Pilih Program Studi</option>
                                            <option value="Prodi Kedokteran"
                                                {{ $dpl->prodi == 'Prodi Kedokteran' ? 'selected' : '' }}>Prodi
                                                Kedokteran</option>
                                            <option value="Prodi Kedokteran Gigi"
                                                {{ $dpl->prodi == 'Prodi Kedokteran Gigi' ? 'selected' : '' }}>
                                                Prodi Kedokteran Gigi</option>
                                            <option value="Prodi Psikologi"
                                                {{ $dpl->prodi == 'Prodi Psikologi' ? 'selected' : '' }}>Prodi
                                                Psikologi</option>
                                            <option value="Prodi Akutansi"
                                                {{ $dpl->prodi == 'Prodi Akutansi' ? 'selected' : '' }}>Prodi
                                                Akutansi</option>
                                            <option value="Prodi Manajemen"
                                                {{ $dpl->prodi == 'Prodi Manajemen' ? 'selected' : '' }}>Prodi
                                                Manajemen</option>
                                            <option value="Prodi Teknik Informatika"
                                                {{ $dpl->prodi == 'Prodi Teknik Informatika' ? 'selected' : '' }}>
                                                Prodi Teknik Informatika</option>
                                            <option value="Prodi Perpustakaan Sains Informasi"
                                                {{ $dpl->prodi == 'Prodi Perpustakaan Sains Informasi' ? 'selected' : '' }}>
                                                Prodi Perpustakaan Sains Informasi</option>
                                            <option value="Prodi Hukum"
                                                {{ $dpl->prodi == 'Prodi Hukum' ? 'selected' : '' }}>Prodi Hukum
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <label for="bank" class="form-label"><strong>Bank</strong></label>
                                        <select class="form-control" id="namaBank" name="namaBank">
                                            <option disabled selected>Pilih Nama Bank</option>
                                            <option value="Bank BCA"
                                                {{ $dpl->namaBank == 'Bank BCA' ? 'selected' : '' }}>
                                                Bank BCA</option>
                                            <option value="Bank Mandiri"
                                                {{ $dpl->namaBank == 'Bank Mandiri' ? 'selected' : '' }}>
                                                Bank Mandiri</option>
                                            <option value="Bank BRI"
                                                {{ $dpl->namaBank == 'Bank BRI' ? 'selected' : '' }}>
                                                Bank BRI</option>
                                            <option value="Bank BNI"
                                                {{ $dpl->namaBank == 'Bank BNI' ? 'selected' : '' }}>
                                                Bank BNI</option>
                                            <option value="Bank CIMB Niaga"
                                                {{ $dpl->namaBank == 'Bank CIMB Niaga' ? 'selected' : '' }}>
                                                Bank CIMB Niaga</option>
                                            <option value="Bank Danamon"
                                                {{ $dpl->namaBank == 'Bank Danamon' ? 'selected' : '' }}>
                                                Bank Danamon</option>
                                            <option value="Bank BTN"
                                                {{ $dpl->namaBank == 'Bank BTN' ? 'selected' : '' }}>
                                                Bank BTN</option>
                                            <option value="Bank Permata"
                                                {{ $dpl->namaBank == 'Bank Permata' ? 'selected' : '' }}>
                                                Bank Permata</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomerRekening" class="form-label"><strong>Nomer
                                                Rekening</strong></label>
                                        <input type="text" class="form-control" id="nomerRekening"
                                            placeholder="{{ $dpl->nomer_rekening ?? 'Nomer Rekening' }}" />
                                    </div>
                                </div>

                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label"><strong>Email</strong></label>
                                        <input type="text" class="form-control" id="email"
                                            placeholder="{{ $dpl->email ?? 'Email' }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomerWhatsapp" class="form-label"><strong>Nomer
                                                Whatsapp</strong></label>
                                        <input type="text" class="form-control" id="nomerWhatsapp"
                                            placeholder="{{ $dpl->nomer_whatsapp ?? 'Nomer Whatsapp' }}" />
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <button class="btn app-btn-primary me-2" type="button"
                                            onclick="updateDataDpl()">Update
                                            Data</button>
                                        <a class="btn app-btn-secondary" href="{{ route('view.data.dpl') }}">Kembali</a>
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
