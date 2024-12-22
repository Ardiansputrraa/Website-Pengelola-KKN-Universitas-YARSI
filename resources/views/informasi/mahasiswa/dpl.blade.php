<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>

    <script></script>
</head>

<body class="app">
    <header class="app-header fixed-top">
        <x-navbar></x-navbar>

        <x-sidebar></x-sidebar>
    </header><!--//app-header-->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                @if (Auth::user()->mahasiswa->status != 'terdaftar')
                    <div class="row">
                        <div class="col-12 col-md-11 col-lg-7 col-xl-6 mx-auto">
                            <div class="app-branding text-center mb-1">

                            </div><!--//app-branding-->
                            <div class="app-card p-5 text-center shadow-sm">
                                <h1 class="page-title mb-4"><br><span class="font-weight-light">Kelompok KKN</span>
                                </h1>
                                @if (Auth::user()->mahasiswa->status == 'diproses')
                                    <div class="mb-4">
                                        Kelompok KKN anda sedang {{ Auth::user()->mahasiswa->status }} silahkan tunggu
                                        beberapa hari.
                                    </div>
                                @endif
                                @if (Auth::user()->mahasiswa->status == 'belum terdaftar')
                                    <div class="mb-4">
                                        Tidak memiliki kelompok karena {{ Auth::user()->mahasiswa->status }} silahkan
                                        melakukan pengajuan kkn.
                                    </div>
                                    <div class="mb-3">
                                        <a href="/pwngajuan-kkn" class="btn app-btn-primary">Pengajuan KKN
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div><!--//col-->
                    </div><!--//row-->
                @else
                
                <section class="vh-auto">
                    <div class="container py-3">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-12 col-xl-4">
                                @if ($dpl)
                                    <div class="card" style="border-radius: 15px;">
                                        <div class="card-body text-center">
                                            <!-- Foto DPL -->
                                            <div class="mt-3 mb-3">
                                                <img src="{{ asset($dpl->foto) }}" class="rounded-circle img-fluid"
                                                    style="width: 100px;" alt="DPL Avatar" />
                                            </div>
                                            <!-- Nama dan Gelar -->
                                            <h4 class="mb-2">{{ $dpl->nama_lengkap }}, {{ $dpl->gelar }}</h4>
                                            <!-- Informasi Email dan WhatsApp -->
                                            <p class="text-muted mb-4">
                                                Dosen Pembimbing Lapangan
                                                <br>
                                                <a href="mailto:{{ $dpl->email }}">{{ $dpl->email }}</a>
                                                <br>
                                                <a href="https://wa.me/{{ $dpl->nomer_whatsapp }}">{{ $dpl->nomer_whatsapp }}</a>
                                            </p>
                                            <!-- Informasi Detail -->
                                            <div class="text-left px-4">
                                                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                                    <strong>NIP:</strong> {{ $dpl->nip }}
                                                </p>
                                                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                                    <strong>Fakultas:</strong> {{ $dpl->fakultas }}
                                                </p>
                                                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                                    <strong>Prodi:</strong> {{ $dpl->prodi }}
                                                </p>
                                            </div>
                                            <a href="https://wa.me/{{ $dpl->nomer_whatsapp }}" class="btn btn-primary btn-rounded btn-lg mt-4 text-white">
                                                Kirim Pesan Whatsapp
                                              </a>
                                        </div>
                                    </div>
                                @else
                                    <!-- Jika Data DPL Tidak Ditemukan -->
                                    <div class="text-center">
                                        <p class="text-muted">Data DPL tidak ditemukan.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                
                @endif
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
