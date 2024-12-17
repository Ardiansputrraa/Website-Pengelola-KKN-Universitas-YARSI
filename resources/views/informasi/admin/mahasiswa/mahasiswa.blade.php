<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>

    <script>
        $(document).ready(function() {
            getDataMahasiswa();
            $('#search').on('keyup', function() {
                let query = $(this).val();
                searchDataMahasiswa(query);
            });
        });

        function getDataMahasiswa() {
            let mahasiswaData = @json($mahasiswa);
            let tabelMahasiswa = $('#tabelMahasiswa');
            if (mahasiswaData.length > 0) {
                console.log(mahasiswaData);
                mahasiswaData.forEach(data => {
                    let statusClass =
                        data.status === "terdaftar" ? "bg-success" :
                        data.status === "diproses" ? "bg-warning" : "bg-danger";

                    let tabelTemp = `
                        <tr>
                            <td class="cell">${data.nama_lengkap}</td>
                            <td class="cell">${data.npm}</td>
                            <td class="cell">${data.fakultas}</td>
                            <td class="cell">${data.prodi}</td>
                            <td class="cell">
                                <span class="badge ${statusClass}">${data.status}</span>
                            </td>
                            <td class="cell">
                                <div class="button-group">
                                    <a class="btn-sm" href="/view-detail-data-mahasiswa/${data.user_id}" style="text-decoration: none; color: inherit;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <button class="btn-sm" onclick="deleteDataMahasiswa('${data.user_id}')" style="border: none; background: none; color: inherit; cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>`;
                    tabelMahasiswa.append(tabelTemp);
                });
            } else {
                tabelMahasiswa.append('<tr><td colspan="8" class="text-center">Data mahasiswa belum dibuat.</td></tr>');
            }
        }

        function deleteDataMahasiswa(user_id) {
            $.ajax({
                type: "GET",
                url: `/delete-data-mahasiswa/${user_id}`,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Data Mahasiswa Berasil Dihapus!",
                        icon: "success",
                        confirmButtonText: "Oke",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Delete Failed",
                        text: xhr.responseText,
                        icon: "error",
                        confirmButtonText: "Oke",
                    });
                }
            });
        }

        function searchDataMahasiswa(query) {
            $.ajax({
                url: "{{ route('search.data.mahasiswa') }}",
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                    keyword: query,
                },
                success: function(data) {
                    console.log(data);
                    let tabelMahasiswa = $("#tabelMahasiswa");
                    tabelMahasiswa.empty();

                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            let tabelTemp = `<tr>
                                                <td class="cell">${data[i]["nama_lengkap"]}</td>
                                                <td class="cell">${data[i]["npm"]}</td>
                                                <td class="cell">${data[i]["fakultas"]}</td>
                                                <td class="cell">${data[i]["prodi"]}</td>
                                               <td class="cell">
                                                    <span class="badge 
                                                        ${data[i]["status"] === "terdaftar" ? 'bg-success' : 
                                                        data[i]["status"] === "diproses" ? 'bg-warning' : 'bg-danger'}">
                                                        ${data[i]["status"]}
                                                    </span>
                                                </td>
                                                <td class="cell">
                                                    <div class="button-group">
                                                        <a class="btn-sm" href="/view-detail-data-mahasiswa/${data[i]["user_id"]}" style="text-decoration: none; color: inherit;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                                class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                        <button class="btn-sm" onclick="deleteDataMahasiswa('${data[i]["user_id"]}')" style="border: none; background: none; color: inherit; cursor: pointer;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                                class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>`
                            $("#tabelMahasiswa").append(tabelTemp);
                        }

                    } else {
                        tabelMahasiswa.append(
                            '<tr><td colspan="9" class="text-center">Tidak ada data ditemukan</td></tr>'
                        );
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat data.');
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

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Informasi Mahasiswa</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="docs-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search" name="searchdocs"
                                                class="form-control search-docs" placeholder="Search">
                                        </div>
                                    </form>

                                </div><!--//col-->

                                <div class="col-auto">
                                    <a class="btn app-btn-primary" href="{{ route('download.data.mahasiswa') }}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                            class="bi bi-download me-1" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                            <path fill-rule="evenodd"
                                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                        </svg>
                                        Download Excel
                                    </a>
                                </div>
                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->

                </div><!--//row-->

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
                                        <tbody id="tabelMahasiswa">


                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->

                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div>

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
