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
                                                placeholder="Nama Kelompok" value="{{ $kelompokKKN->nama_kelompok }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-14">
                                            <label for="namaDosen" class="form-label"><strong>Nama
                                                    Dosen</strong></label>
                                            <select class="form-control" id="namaDosen" name="namaDosen">
                                                <option value="{{ $kelompokKKN->dpl->id }}" selected>
                                                    {{ $kelompokKKN->dpl->nama_lengkap }},
                                                    {{ $kelompokKKN->dpl->gelar }}</option>
                                                @foreach ($dpls as $dpl)
                                                    <option value={{ $dpl->id }}>
                                                        {{ $dpl->nama_lengkap }}, {{ $dpl->gelar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-md-14">
                                            <label for="lokasi" class="form-label"><strong>Lokasi KKN</strong></label>
                                            <input type="text" class="form-control" id="lokasi"
                                                placeholder="Lokasi KKN" value="{{ $kelompokKKN->lokasi }}" />
                                        </div>
                                    </div>
                                </div>

                            </div><!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <button class="btn app-btn-primary" type="button" onclick="tambahMahasiswa()">Tambah
                                    Mahasiswa</button>
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
                                                                <th class="cell">Aksi</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            @foreach ($kelompokMahasiswa as $dataMahasiswa)
                                                                <tr>
                                                                    <td class="cell">
                                                                        {{ $dataMahasiswa->mahasiswa->nama_lengkap }}
                                                                    </td>
                                                                    <td class="cell">
                                                                        {{ $dataMahasiswa->mahasiswa->npm }}</td>
                                                                    <td class="cell">
                                                                        {{ $dataMahasiswa->mahasiswa->fakultas }}</td>
                                                                    <td class="cell">
                                                                        {{ $dataMahasiswa->mahasiswa->prodi }}</td>
                                                                    <td class="cell">
                                                                        <div class="button-group">
                                                                            <a class="btn-sm"
                                                                                href="/view-detail-data-kelompok/{{ $dataMahasiswa->id }}"
                                                                                style="text-decoration: none; color: inherit;">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="16" height="16"
                                                                                    fill="currentColor"
                                                                                    class="bi bi-eye"
                                                                                    viewBox="0 0 16 16">
                                                                                    <path
                                                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                                                </svg>
                                                                                Edit
                                                                            </a>
                                                                            <button class="btn-sm" onclick=""
                                                                                style="border: none; background: none; color: inherit; cursor: pointer;">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="16" height="16"
                                                                                    fill="currentColor"
                                                                                    class="bi bi-trash3-fill"
                                                                                    viewBox="0 0 16 16">
                                                                                    <path
                                                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                                                </svg>
                                                                                Hapus
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div><!--//table-responsive-->

                                            </div><!--//app-card-body-->

                                        </div><!--//app-card-->
                                    </div><!--//tab-pane-->
                                </div>

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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahMahasiswaModalLabel">Tambah Mahasiswa KKN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <div class="col-auto">
                            <form class="docs-search-form row gx-1 align-items-center">
                                <div class="col-auto mb-3">
                                    <input type="text" id="search" name="searchdocs"
                                        class="form-control bg-gray" placeholder="Search">
                                </div>
                            </form>
                        </div>
                        
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Nama Lengkap</th>
                                        <th class="cell">NPM</th>
                                        <th class="cell">Fakultas</th>
                                        <th class="cell">Prodi</th>
                                        <th class="cell">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @foreach ($mahasiswa as $data)
                                    <tr>
                                        <td class="cell">{{ $data->nama_lengkap }}</td>
                                        <td class="cell">{{ $data->npm }}</td>
                                        <td class="cell">{{ $data->fakultas }}</td>
                                        <td class="cell">{{ $data->prodi }}</td>
                                        <td class="cell">
                                            <div class="button-group">
                                                <button class="btn-sm text-primary" onclick=""
                                                    style="border: none; background: none; color: inherit; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-trash3-fill text-primary" viewBox="0 0 16 16">
                                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                                        <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                                                    </svg>
                                                    Tambah
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <x-footer></x-footer>

    </div><!--//app-wrapper-->

</body>

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script>

</html>
