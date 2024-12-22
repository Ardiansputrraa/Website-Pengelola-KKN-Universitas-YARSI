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
                    <div class="row g-3 mb-0 align-items-center justify-content-between">
                        <!-- Judul Kelompok KKN -->
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Kelompok KKN</h1>
                        </div>

                        <!-- Informasi Lokasi -->
                        <div class="col-auto">
                            <div class="card border-0 shadow-sm d-inline-flex align-items-center"
                                style="border-radius: 10px; max-width: 300px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon text-white bg-primary rounded-circle d-flex justify-content-center align-items-center"
                                        style="width: 40px; height: 40px; font-size: 20px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="card-title mb-1">Lokasi KKN</h5>
                                        <p class="card-text text-muted mb-0">{{ $lokasi->lokasi }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container py-5">
                        <div class="row">
                            @foreach ($daftar_mahasiswa as $mahasiswa)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100" style="border-radius: 15px;">
                                        <div class="card-body d-flex align-items-center text-left">
                                            <div class="mr-4">
                                                <img src="{{ asset($mahasiswa->foto) }}" class="rounded-circle me-lg-2"
                                                    style="width: 70px; height: 70px;" alt="Avatar" />
                                            </div>
                                            <div>
                                                <h5 class="mb-2" style="font-size: 0.95rem;">
                                                    {{ $mahasiswa->nama_lengkap }}</h5>
                                                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                                    {{ $mahasiswa->npm }}</p>
                                                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                                    {{ $mahasiswa->fakultas }}</p>
                                                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                                    {{ $mahasiswa->prodi }}</p>
                                                <p class="text-muted mb-1" style="font-size: 0.85rem;">Email: <a
                                                        href="mailto:{{ $mahasiswa->email }}">{{ $mahasiswa->email }}</a>
                                                </p>
                                                <p class="text-muted mb-1" style="font-size: 0.85rem;">WhatsApp: <a
                                                        href="https://wa.me/{{ $mahasiswa->nomer_whatsapp }}">{{ $mahasiswa->nomer_whatsapp }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
