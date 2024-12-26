<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>
    <script>
        function tambahLogbook() {
            $('#tambahLogbookModal').modal('show');
        }

        function detailLogbook(id) {
            $.ajax({
                url: `/detail-logbook/${id}`,
                type: "GET",
                success: function(response) {
                    $('#logbook_id').val(response.data.id);
                    $('#editJudul').val(response.data.judul);
                    $('#editTanggal').val(response.data.tanggal);
                    let waktu = response.data.jam.split(" - ");
                    $('#editWaktuMulai').val(waktu[0]);
                    $('#editWaktuSelesai').val(waktu[1]);
                    $('#editTempat').val(response.data.tempat);
                    $('#editKegiatan').val(response.data.kegiatan);
                    const filePath = response.data.file_foto;
                    const fileName = filePath.split('/').pop()
                    $('#fileName').val(fileName);
                    $('#editLogbookModal').modal('show');
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Data kegiatan tidak ditemukan.",
                        confirmButtonText: "Tutup",
                    });
                }
            });
            
        }

        function ubahLogbook() {
            let logbook_id = $('#logbook_id').val();
            let editTanggal = $('#editTanggal').val();
            let editWaktuMulai = $('#editWaktuMulai').val();
            let editWaktuSelesai = $('#editWaktuSelesai').val();
            let editTempat = $('#editTempat').val();
            let editKegiatan = $('#editKegiatan').val();
            let editFile = $('#editFoto')[0];
            let editFoto = editFile.files[0];

            if (editTanggal === "") {
                $("#helpEditTanggal")
                    .text("Silahkan masukan tanggal kegiatan!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#editTanggal").focus();
                return;
            }

            if (editTanggal != "") {
                $("#helpEditTanggal")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (editWaktuMulai === "") {
                $("#helpEditWaktuMulai")
                    .text("Silahkan masukan waktu mulai!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#editWaktuMulai").focus();
                return;
            }

            if (editWaktuMulai != "") {
                $("#helpEditWaktuMulai")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (editWaktuSelesai === "") {
                $("#helpEditWaktuSelesai")
                    .text("Silahkan masukan waktu selesai!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#editWaktuSelesai").focus();
                return;
            }

            if (editWaktuSelesai != "") {
                $("#helpEditWaktuSelesai")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (editKegiatan === "") {
                $("#helpEditKegiatan")
                    .text("Silahkan masukan kegiatan!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#editKegiatan").focus();
                return;
            }

            if (editKegiatan != "") {
                $("#helpEditKegiatan")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (editTempat === "") {
                $("#helpEditTempat")
                    .text("Silahkan masukan tempat kegiatan!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#editTempat").focus();
                return;
            }

            if (editTempat != "") {
                $("#helpEditTempat")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            let editWaktu = `${editWaktuMulai} - ${editWaktuSelesai}`;

            let formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', $('#logbook_id').val());
            formData.append('tanggal', editTanggal);
            formData.append('waktu', editWaktu);
            formData.append('tempat', editTempat);
            formData.append('kegiatan', editKegiatan);
            formData.append('foto', editFoto);
            

            $.ajax({
                type: "POST",
                url: "{{ route('edit.logbook') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Logbook berhasil diubah!",
                        icon: "success",
                        confirmButtonText: "Oke",
                        customClass: {
                            confirmButton: 'btn app-btn-primary',
                            cancelButton: 'btn app-btn-secondary',
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Gagal",
                        text: "Terjadi kesalahan saat mengunggah file.",
                        icon: "error",
                        confirmButtonText: "Coba Lagi",
                    });
                }
            });
        }

        function buatLogbook() {
            let tanggal = $('#tanggal').val();
            let waktuMulai = $('#waktuMulai').val();
            let waktuSelesai = $('#waktuSelesai').val();
            let tempat = $('#tempat').val();
            let kegiatan = $('#kegiatan').val();
            let file = $('#foto')[0];
            let foto = file.files[0];

            if (tanggal === "") {
                $("#helpTanggal")
                    .text("Silahkan masukan tanggal kegiatan!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#tanggal").focus();
                return;
            }

            if (tanggal != "") {
                $("#helpTanggal")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (waktuMulai === "") {
                $("#helpWaktuMulai")
                    .text("Silahkan masukan waktu mulai!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#waktuMulai").focus();
                return;
            }

            if (waktuMulai != "") {
                $("#helpWaktuMulai")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (waktuSelesai === "") {
                $("#helpWaktuSelesai")
                    .text("Silahkan masukan waktu selesai!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#waktuSelesai").focus();
                return;
            }

            if (waktuSelesai != "") {
                $("#helpWaktuSelesai")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (kegiatan === "") {
                $("#helpKegiatan")
                    .text("Silahkan masukan kegiatan!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#kegiatan").focus();
                return;
            }

            if (kegiatan != "") {
                $("#helpKegiatan")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (tempat === "") {
                $("#helpTempat")
                    .text("Silahkan masukan tempat kegiatan!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#tempat").focus();
                return;
            }

            if (tempat != "") {
                $("#helpTempat")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (!foto) {
                $("#helpFoto")
                    .text("Silahkan pilih foto dokumentasi terlebih dahulu!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                return;
            }

            if (foto) {
                $("#helpFoto")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            let waktu = `${waktuMulai} - ${waktuSelesai}`;
            let formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('tanggal', tanggal);
            formData.append('waktu', waktu);
            formData.append('tempat', tempat);
            formData.append('kegiatan', kegiatan);
            formData.append('foto', foto);
            $.ajax({
                type: "POST",
                url: "{{ route('create.logbook.mahasiswa') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Logbook berhasil dibuat.",
                        confirmButtonText: "Tutup",
                    }).then(() => {
                        window.location.reload();
                    });
                },
            })
        }

        function hapusLogbook(id) {
            $.ajax({
                type: "GET",
                url: `/delete-logbook/${id}`,
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil",
                        text: response.success,
                        icon: "success",
                        confirmButtonText: "Oke",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.error);
                },
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
                        <h1 class="app-page-title mb-0">Logbook Kegiatan {{ $mahasiswa->nama_lengkap }}</h1>
                    </div>
                    @if (Auth::user()->role == 'mahasiswa')
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <button class="btn app-btn-primary" type="button" onclick="tambahLogbook()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-calendar2-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                            <path
                                                d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8" />
                                        </svg>
                                        Tambah Logbook
                                    </button>
                                </div>

                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                    @endif
                </div>
            </div><!--//row-->

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="cell">Tanggal</th>
                                            <th class="cell">Waktu</th>
                                            <th class="cell">Kegiatan</th>
                                            <th class="cell">Tempat</th>
                                            <th class="cell">Dokumentasi</th>
                                            @if (Auth::user()->role == 'mahasiswa')
                                            <th class="cell">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody id="tabelLogbook">
                                        @foreach ($logbook as $data)
                                        <tr>
                                            <td class="cell"><span>{{ $data->tanggal }}</span></td>
                                            <td class="cell">{{ $data->jam }}</td>
                                            <td class="cell">{{ $data->kegiatan }}</td>
                                            <td class="cell">{{ $data->tempat }}</td>
                                            <td class="cell">
                                                <img src="{{ asset($data->file_foto) }}" alt="Foto"
                                                    style="width: 100px; height: auto;" />
                                            </td>
                                            @if (Auth::user()->role == 'mahasiswa')
                                            <td class="cell">
                                                <div class="button-group">
                                                    <button type="button" class="btn-sm" onclick="detailLogbook({{ $data->id }})"
                                                        style="border: none; background: none; color: inherit; cursor: pointer;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn-sm" onclick="hapusLogbook({{ $data->id }})"
                                                        style="border: none; background: none; color: inherit; cursor: pointer;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash3-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->


                </div><!--//tab-pane-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->


        <!-- Modal Tambah Logbook -->
        <div class="modal fade" id="tambahLogbookModal" tabindex="-1" aria-labelledby="tambahLogbookModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahLogbookModalLabel">Tambah Logbook Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambahKegiatan">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                                    <p id="helpTanggal" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-3">
                                    <label for="waktuMulai" class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control" id="waktuMulai" name="waktuMulai">
                                    <p id="helpWaktuMulai" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-3">
                                    <label for="waktuSelesai" class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control" id="waktuSelesai"
                                        name="waktuSelesai">
                                    <p id="helpWaktuSelesai" class="help is-hidden"></p>
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-6">
                                    <label for="kegiatan" class="form-label">Kegiatan</label>
                                    <input type="text" class="form-control" id="kegiatan" name="kegiatan"
                                        placeholder="Masukkan kegiatan kegiatan">
                                    <p id="helpKegiatan" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="tempat" class="form-label">Tempat</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat"
                                        placeholder="Masukkan tempat kegiatan">
                                    <p id="helpTempat" class="help is-hidden"></p>
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="col-md-12">
                                    <label for="foto" class="col-form-label"><strong>
                                            Upload Dokumentasi</strong></label>
                                    <input type="file" class="form-control" id="foto"
                                        placeholder="Upload File Dokumentasi" />
                                    <p id="helpFoto" class="help is-hidden"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" onclick="buatLogbook()" form="formTambahKegiatan"
                            class="btn btn-primary text-white">Buat Logbook</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Logbook -->
        <div class="modal fade" id="editLogbookModal" tabindex="-1" aria-labelledby="editLogbookModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLogbookModalLabel">Tambah Logbook Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="logbook_id" class="help is-hidden"></p>
                        <form id="formTambahKegiatan">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="editTanggal" name="tanggal">
                                    <p id="helpEditTanggal" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-3">
                                    <label for="waktuMulai" class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control" id="editWaktuMulai" name="waktuMulai">
                                    <p id="helpEditWaktuMulai" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-3">
                                    <label for="waktuSelesai" class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control" id="editWaktuSelesai"
                                        name="waktuSelesai">
                                    <p id="helpEditWaktuSelesai" class="help is-hidden"></p>
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-6">
                                    <label for="kegiatan" class="form-label">Kegiatan</label>
                                    <input type="text" class="form-control" id="editKegiatan" name="kegiatan"
                                        placeholder="Masukkan kegiatan kegiatan">
                                    <p id="helpEditKegiatan" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="tempat" class="form-label">Tempat</label>
                                    <input type="text" class="form-control" id="editTempat" name="tempat"
                                        placeholder="Masukkan tempat kegiatan">
                                    <p id="helpEditTempat" class="help is-hidden"></p>
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="col-md-12">
                                    <label for="foto" class="col-form-label"><strong>
                                            Upload Dokumentasi</strong></label>
                                    <input type="file" class="form-control" id="editFoto"
                                        placeholder="Upload File Dokumentasi" />
                                    <p id="helpEditFoto" class="help is-hidden"></p>
                                    <input type="text" id="fileName" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" onclick="ubahLogbook()" form="formTambahKegiatan"
                            class="btn btn-primary text-white">Ubah Logbook</button>
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
