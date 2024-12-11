<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>

    <script>
        $(document).ready(function() {
            getDataDpl();
            $('#search').on('keyup', function() {
                let query = $(this).val();
                searchDataDpl(query);
            });
        });

        function getDataDpl() {
            let dplData = @json($dpl);
            let tabelDpl = $('#tabelDpl');
            if (dplData.length > 0) {
                console.log(dplData);
                dplData.forEach(data => {
                    let statusClass =
                        data.status === "Terdaftar" ? "bg-success" :
                        data.status === "Diproses" ? "bg-warning" : "bg-danger";

                    let tabelTemp = `
                        <tr>
                            <td class="cell">${data.nama_lengkap}</td>
                            <td class="cell">${data.nip}</td>
                            <td class="cell">${data.fakultas}</td>
                            <td class="cell">${data.prodi}</td>
                            <td class="cell">
                                <span class="badge ${statusClass}">${data.status}</span>
                            </td>
                            <td class="cell">
                                <div class="button-group">
                                    <a class="btn-sm" href="/view-detail-data-dpl/${data.user_id}" style="text-decoration: none; color: inherit;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 13c-3.5 0-6-3.5-6-3.5S4.5 4 8 4s6 3.5 6 3.5S11.5 13 8 13zm0-1.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z" />
                                        </svg>
                                        Lihat
                                    </a>
                                    <button class="btn-sm" onclick="deleteDataDpl('${data.user_id}')" style="border: none; background: none; color: inherit; cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>`;
                    tabelDpl.append(tabelTemp);
                });
            } else {
                tabelDpl.append('<tr><td colspan="8" class="text-center">Data dpl belum dibuat.</td></tr>');
            }
        }

        function deleteDataDpl(user_id) {
            $.ajax({
                type: "GET",
                url: `/delete-data-dpl/${user_id}`,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Data dPL Berasil Dihapus!",
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

        function searchDataDpl(query) {
            $.ajax({
                url: "{{ route('search.data.dpl') }}",
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                    keyword: query,
                },
                success: function(data) {
                    console.log(data);
                    let tabelDpl = $("#tabelDpl");
                    tabelDpl.empty();

                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            let tabelTemp = `<tr>
                                                <td class="cell">${data[i]["nama_lengkap"]}</td>
                                                <td class="cell">${data[i]["nip"]}</td>
                                                <td class="cell">${data[i]["fakultas"]}</td>
                                                <td class="cell">${data[i]["prodi"]}</td>
                                               <td class="cell">
                                                    <span class="badge 
                                                        ${data[i]["status"] === "Terdaftar" ? 'bg-success' : 
                                                        data[i]["status"] === "Diproses" ? 'bg-warning' : 'bg-danger'}">
                                                        ${data[i]["status"]}
                                                    </span>
                                                </td>
                                                <td class="cell">
                                                    <div class="button-group">
                                                        <a class="btn-sm" href="/view-detail-data-dpl/${data[i]["user_id"]}" style="text-decoration: none; color: inherit;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                                class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 13c-3.5 0-6-3.5-6-3.5S4.5 4 8 4s6 3.5 6 3.5S11.5 13 8 13zm0-1.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z" />
                                                            </svg>
                                                            Lihat
                                                        </a>
                                                        <button class="btn-sm" onclick="deleteDataDpl('${data[i]["user_id"]}')" style="border: none; background: none; color: inherit; cursor: pointer;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                                class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>`
                            $("#tabelDpl").append(tabelTemp);
                        }

                    } else {
                        tabelDpl.append(
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
                        <h1 class="app-page-title mb-0">Informasi DPL</h1>
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
                                    <a class="btn app-btn-primary" href="{{ route('download.data.dpl') }}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                                            class="bi bi-download me-1" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                            <path fill-rule="evenodd"
                                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                        </svg>
                                        Download CSV
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
                                                <th class="cell">NIP</th>
                                                <th class="cell">Fakultas</th>
                                                <th class="cell">Prodi</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tabelDpl">


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
