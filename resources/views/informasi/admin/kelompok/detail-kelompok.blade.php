<!DOCTYPE html>
<html lang="en">

<head>

    <x-header></x-header>
    <script>
        $(document).ready(function() {

        });

        function tambahMahasiswa() {
            $('#tambahMahasiswaModal').modal('show');
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
                <h1 class="app-page-title">Buat Akun Kelompok KKN</h1>
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
                                            <label for="namaLengkap" class="form-label"><strong>Nama
                                                    Kelompok</strong></label>
                                            <input type="text" class="form-control" id="namaLengkap"
                                                placeholder="Nama Kelompok" />
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-14">
                                            <label for="namaLengkap" class="form-label"><strong>Nama
                                                    Dosen</strong></label>
                                            <input type="text" class="form-control" id="namaLengkap"
                                                placeholder="Nama Dosen" />
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-14">
                                            <label for="lokasi" class="form-label"><strong>Lokasi KKN</strong></label>
                                            <input type="text" class="form-control" id="lokasi"
                                                placeholder="Lokasi KKN" />
                                        </div>
                                    </div>
                                </div>

                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <button class="btn app-btn-primary" type="button" onclick="">Buat Kelompok</button>
                                <a href="javascript:history.back()" class="btn app-btn-secondary">Kembali</a>
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->


                    <div class="col-8 col-lg-8">
                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="app-card-header p-3 border-bottom-0 mb-2">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Daftar Mahasiswa</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">

                                <!--Content Buat Akun Kelompok KKN-->
                                <div class="tab-content" id="orders-table-tab-content">
                                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                        aria-labelledby="orders-all-tab">
                                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                                            <div class="app-card-body">
                                                <div class="table-responsive">
                                                    <table class="table app-table-hover mb-0 text-left">
                                                        <thead>
                                                            <tr>
                                                                <th class="cell">Nama Lengkap</th>
                                                                <th class="cell">NPM</th>
                                                                <th class="cell">Fakultas</th>
                                                                <th class="cell">Prodi</th>
                                                                <th class="cell">Status</th>
                                                                <th class="cell">Aksi</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="">

                                                        </tbody>
                                                    </table>
                                                </div><!--//table-responsive-->

                                            </div><!--//app-card-body-->

                                        </div><!--//app-card-->
                                    </div><!--//tab-pane-->
                                </div>

                                <div class="app-card-footer p-4 mt-auto">
                                    <button class="btn app-btn-primary" type="button"
                                        onclick="tambahMahasiswa()">Tambah Mahasiswa</button>
                                </div><!--//app-card-footer-->
                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                            </div><!--//app-card-footer-->
                        </div><!--//app-card-->
                    </div><!--//col-->

                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->


        <!-- Modal Tambah Mahasiswa -->
        <div class="modal fade" id="tambahMahasiswaModal" tabindex="-1" aria-labelledby="tambahMahasiswaModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Tambahkan modal-lg untuk ukuran besar -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahMahasiswaModalLabel">Tambah Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="page-utilities mb-2">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="docs-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search" name="searchdocs"
                                                class="form-control search-docs" placeholder="Search Mahasiswa">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Tambahkan table-responsive -->
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Nama Lengkap</th>
                                        <th class="cell">NPM</th>
                                        <th class="cell">Fakultas</th>
                                        <th class="cell">Prodi</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Tambah</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelDaftarMahasiswa">
                                    @foreach ($dataMahasiswa as $mahasiswa)
                                        <tr>
                                            <td class="cell">{{ $mahasiswa->nama_lengkap }}</td>
                                            <td class="cell">{{ $mahasiswa->npm }}</td>
                                            <td class="cell">{{ $mahasiswa->fakultas }}</td>
                                            <td class="cell">{{ $mahasiswa->prodi }}</td>
                                            <td class="cell">
                                                <span
                                                    class="badge 
                                                @if ($mahasiswa->status === 'terdaftar') bg-success
                                                @elseif ($mahasiswa->status === 'diproses') bg-warning
                                                @else bg-danger @endif">
                                                    {{ $mahasiswa->status }}
                                                </span>
                                            </td>
                                            <td class="cell">
                                                <div class="button-group">
                                                    <button class="btn-sm"
                                                        onclick="deleteDataMahasiswa('{{ $mahasiswa->id }}')"
                                                        style="border: none; background: none; color: inherit; cursor: pointer;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                                            <path
                                                                d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- Tutup div table-responsive -->
                    </div>
                    <div class="modal-footer">
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
