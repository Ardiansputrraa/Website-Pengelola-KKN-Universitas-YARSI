<!DOCTYPE html>
<html lang="en">

<head>

    <x-header></x-header>
    <script>
        function data() {
            let form_data = new FormData();
            let role = "{{ $user->role }}";
            let file = $("#foto")[0].files[0];
            let namaLengkap = $("#namaLengkap").val() || (@json($user->getTableDatabase()->nama_lengkap) === null ? "Nama Lengkap" :
                @json($user->getTableDatabase()->nama_lengkap));
            let email = $("#email").val() || @json($user->getTableDatabase()->email);
            let gelar = $("#gelar").val() || (@json($user->getTableDatabase()->gelar) === null ? "Gelar" :
                @json($user->getTableDatabase()->gelar));
            let namaBank = $("#namaBank").val() || @json($user->getTableDatabase()->nama_bank);
            let nomerRekening = $("#nomerRekening").val() || (@json($user->getTableDatabase()->nomer_rekening) === null ? "Nomer Rekening" :
                @json($user->getTableDatabase()->nomer_rekening));
            let npm = $("#npm").val() || @json($user->getTableDatabase()->npm);
            let nip = $("#nip").val() || @json($user->getTableDatabase()->nip);
            let fakultas = $("#fakultas").val() || @json($user->getTableDatabase()->fakultas);
            let prodi = $("#prodi").val() || @json($user->getTableDatabase()->prodi);
            let nomerWhatsapp = $("#nomerWhatsapp").val() ||
                (@json($user->getTableDatabase()->nomer_whatsapp) === null ? "Nomer Whatsapp" : @json($user->getTableDatabase()->nomer_whatsapp));

            form_data.append("_token", "{{ csrf_token() }}");
            form_data.append("foto", file);
            form_data.append("namaLengkap", namaLengkap);
            if ($("#email").val() != "") {
                form_data.append("email", email);
            }
            form_data.append("nomerWhatsapp", nomerWhatsapp);

            if (role == 'mahasiswa') {
                if ($("#npm").val() != "") {
                    form_data.append("npm", npm);
                }
                form_data.append("fakultas", fakultas);
                form_data.append("prodi", prodi);
            } else if (role == 'dpl') {
                if ($("#nip").val() != "") {
                    form_data.append("nip", nip);
                }
                form_data.append("gelar", gelar);
                form_data.append("fakultas", fakultas);
                form_data.append("prodi", prodi);
                form_data.append("namaBank", namaBank);
                form_data.append("nomerRekening", nomerRekening);
            }

            return form_data;
        }

        function updateProfile() {
            $.ajax({
                type: "POST",
                url: "{{ route('profile.update') }}",
                data: data(),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: "Update Berhasil",
                        text: "Profile Berhasil Diubah!",
                        icon: "success",
                        confirmButtonText: "Oke",
                    }).then(() => {
                        window.location.reload();

                    });
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.message === "Email sudah digunakan!") {
                        Swal.fire({
                            title: "Update Gagal",
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
                            title: "Update Gagal",
                            text: "NPM tersebut telah terdaftar. Silakan gunakan NPM lain!",
                            icon: "error",
                            confirmButtonText: "Oke",
                            customClass: {
                                confirmButton: 'btn app-btn-primary',
                                cancelButton: 'btn app-btn-secondary',
                            },
                        });
                    } else if (response.message === "NIP sudah digunakan!") {
                        Swal.fire({
                            title: "Update Gagal",
                            text: "NIP tersebut telah terdaftar. Silakan gunakan NIP lain!",
                            icon: "error",
                            confirmButtonText: "Oke",
                            customClass: {
                                confirmButton: 'btn app-btn-primary',
                                cancelButton: 'btn app-btn-secondary',
                            },
                        });
                    } else {
                        console.log("Error lain:", response.errors);
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

                <h1 class="app-page-title">Profil {{ Auth::user()->role }}</h1>
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
                                        <h4 class="app-card-title">Data Diri</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label mb-2"><strong>Foto</strong></div>
                                            <div class="item-data">
                                                <img class="profile-image img-fluid"
                                                    src="{{ asset(Auth::user()->getTableDatabase()->foto) }}"
                                                    alt=""
                                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;" />
                                            </div>
                                        </div><!--//col-->
                                        <div class="col text-end">
                                            <div class="col-md-10">
                                                <input type="file" class="form-control" id="foto"
                                                    placeholder="Foto" accept="image/*" />

                                            </div>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//item-->


                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="namaLengkap" class="form-label"><strong>Nama
                                                    Lengkap</strong></label>
                                            <input type="text" class="form-control" id="namaLengkap"
                                                placeholder="{{ $user->getTableDatabase()->nama_lengkap ? $user->getTableDatabase()->nama_lengkap : 'Nama Lengkap' }}" />
                                        </div>

                                    </div>
                                </div>
                                @if (Auth::check() && Auth::user()->role == 'dpl')
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="nip" class="form-label"><strong>NIP</strong></label>
                                                <input type="text" class="form-control" id="nip"
                                                    placeholder="{{ $user->getTableDatabase()->nip ? $user->getTableDatabase()->nip : 'NIP' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="gelar" class="form-label"><strong>Gelar</strong></label>
                                                <input type="text" class="form-control" id="gelar"
                                                    placeholder="{{ $user->getTableDatabase()->gelar ? $user->getTableDatabase()->gelar : 'Gelar' }}" />
                                            </div>

                                        </div>
                                    </div>
                                @endif

                                @if (Auth::check() && Auth::user()->role == 'mahasiswa')
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="npm" class="form-label"><strong>NPM</strong></label>
                                                <input type="text" class="form-control" id="npm"
                                                    placeholder="{{ $user->getTableDatabase()->npm ? $user->getTableDatabase()->npm : 'NPM' }}" />
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ((Auth::check() && Auth::user()->role == 'mahasiswa') || Auth::user()->role == 'dpl')
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="falkutas"
                                                    class="form-label"><strong>Fakultas</strong></label>
                                                <select class="form-control" id="fakultas" name="fakultas">
                                                    <option disabled selected>Pilih Fakultas</option>
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="prodi" class="form-label"><strong>Prodi</strong></label>
                                                <select class="form-control" id="prodi" name="prodi">
                                                    <option disabled selected>Pilih Program Studi</option>
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
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (Auth::check() && Auth::user()->role == 'dpl')
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="bank" class="form-label"><strong>Bank</strong></label>
                                                <select class="form-control" id="namaBank" name="namaBank">
                                                    <option disabled selected>Pilih Nama Bank</option>
                                                    <option value="Bank BCA"
                                                        {{ $user->getTableDatabase()->nama_bank == 'Bank BCA' ? 'selected' : '' }}>
                                                        Bank BCA</option>
                                                    <option value="Bank Mandiri"
                                                        {{ $user->getTableDatabase()->nama_bank == 'Bank Mandiri' ? 'selected' : '' }}>
                                                        Bank Mandiri</option>
                                                    <option value="Bank BRI"
                                                        {{ $user->getTableDatabase()->nama_bank == 'Bank BRI' ? 'selected' : '' }}>
                                                        Bank BRI</option>
                                                    <option value="Bank BNI"
                                                        {{ $user->getTableDatabase()->nama_bank == 'Bank BNI' ? 'selected' : '' }}>
                                                        Bank BNI</option>
                                                    <option value="Bank CIMB Niaga"
                                                        {{ $user->getTableDatabase()->nama_bank == 'Bank CIMB Niaga' ? 'selected' : '' }}>
                                                        Bank CIMB Niaga</option>
                                                    <option value="Bank Danamon"
                                                        {{ $user->getTableDatabase()->nama_bank == 'Bank Danamon' ? 'selected' : '' }}>
                                                        Bank Danamon</option>
                                                    <option value="Bank BTN"
                                                        {{ $user->getTableDatabase()->nama_bank == 'Bank BTN' ? 'selected' : '' }}>
                                                        Bank BTN</option>
                                                    <option value="Bank Permata"
                                                        {{ $user->getTableDatabase()->nama_bank == 'Bank Permata' ? 'selected' : '' }}>
                                                        Bank Permata</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-start align-items-center">
                                            <div class="col-md-10">
                                                <label for="nomerRekening" class="form-label"><strong>Nomer
                                                        Rekening</strong></label>
                                                <input type="text" class="form-control" id="nomerRekening"
                                                    placeholder="{{ $user->getTableDatabase()->nomer_rekening ?? 'Nomer Rekening' }}" />
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="email" class="form-label"><strong>Email</strong></label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="{{ $user->getTableDatabase()->email ? $user->getTableDatabase()->email : 'Email' }}" />
                                        </div>

                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-10">
                                            <label for="nomerWhatsapp" class="form-label"><strong>Nomer
                                                    Whatsapp Aktif</strong></label>
                                            <input type="text" class="form-control" id="nomerWhatsapp"
                                                placeholder="{{ $user->getTableDatabase()->nomer_whatsapp ? $user->getTableDatabase()->nomer_whatsapp : 'Nomer Whatsapp' }}" />
                                        </div>

                                    </div>
                                </div>

                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <button class="btn app-btn-primary" type="button" onclick="updateProfile()">Update
                                    Profile</button>
                                <a href="javascript:history.back()" class="btn app-btn-secondary">Kembali</a>
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
