<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>
    <script>
        $(document).ready(function() {

        });

        function uploadSumberDaya() {
            $('#uploadFileModal').modal('show');
        }

        function uploadFileSumberDaya() {
            let judul = $('#judul').val();
            let fileInput = $('#sumberDaya')[0];
            let file = fileInput.files[0];

            if (judul === "") {
                $("#helpJudul")
                    .text("Silahkan masukan judul untuk file!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#judul").focus();
                return;
            }

            if (judul !== "") {
                $("#helpJudul")
                    .text("")
                    .removeClass("is-danger");
            }

            if (!file) {
                $("#helpSumberDaya")
                    .text("Silahkan pilih file terlebih dahulu!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                return;
            }

            if (file) {
                $("#helpSumberDaya")
                    .text("")
                    .removeClass("is-danger");
            }

            let formSumberDaya = new FormData();
            formSumberDaya.append('_token', "{{ csrf_token() }}");
            formSumberDaya.append('judul', judul);
            formSumberDaya.append('file', file);

            $.ajax({
                type: "POST",
                url: "{{ route('upload.sumber.daya') }}",
                data: formSumberDaya,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Upload sumber daya berhasil!",
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

        function hapusSumberDaya(id) {
            $.ajax({
                type: "GET",
                url: `/delete-sumber-daya/${id}`,
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
                        <h1 class="app-page-title mb-0">Sumber Daya</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                
                                @if (Auth::user()->role == 'admin')
                                    <div class="col-auto">
                                        <button class="btn app-btn-primary" type="button"
                                            onclick="uploadSumberDaya()"><svg width="1em" height="1em"
                                                viewBox="0 0 16 16" class="bi bi-upload me-2" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                            </svg>Upload File</button>
                                    </div>
                                @endif
                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                </div><!--//row-->

                <div class="row g-4">
                    @foreach ($sumber_daya as $item)
                        <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                            <div class="app-card app-card-doc shadow-sm h-100">
                                <div class="app-card-thumb-holder p-3">
                                    <span class="icon-holder">
                                        @if ($item->tipe_file === 'application/pdf')
                                            <i class="fas fa-file-pdf pdf-file"></i>
                                        @elseif ($item->tipe_file === 'docx')
                                            <i class="fas fa-file-word word-file"></i>
                                        @elseif ($item->tipe_file === 'xlsx')
                                            <i class="fas fa-file-excel excel-file"></i>
                                        @else
                                            <i class="fas fa-file-alt default-file"></i>
                                        @endif
                                    </span>
                                    <a class="app-card-link-mask" href="{{ route('download.sumber.daya', $item->id) }}"></a>
                                </div>
                                <div class="app-card-body p-3 has-card-actions">
                                    <h4 class="app-doc-title">
                                        <a href="{{ route('download.sumber.daya', $item->id) }}">{{ $item->judul }}</a>
                                    </h4>
                                    <div class="app-doc-meta">
                                        <ul class="list-unstyled mb-0">
                                            <li><span class="text-muted">Type:</span> {{ strtoupper($item->tipe_file) }}
                                            </li>
                                            <li><span class="text-muted">Size:</span> {{ $item->size }} KB</li>
                                        </ul>
                                    </div>
                                    @if (Auth::user()->role == 'admin')
                                        <div class="button-group mt-4">
                                            <button class="btn app-btn-outline-primary" type="button"
                                            onclick="hapusSumberDaya({{ $item->id }})"><i class="fas fa-trash me-2"></i>Hapus File</button>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role != 'admin')
                                        <div class="button-group mt-4">
                                            <a class="btn app-btn-outline-primary" 
                                            href="{{ route('download.sumber.daya', $item->id) }}"><i class="fas fa-download me-2"></i>Download File</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div><!--//row-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->

    <div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="uploadFileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadFileModalLabel">Pengajuan KKN Reguler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="judul" class="col-form-label"><strong>Judul File</strong></label>
                            <input type="text" class="form-control" id="judul"
                                placeholder="Silahkan masukan judul file" />
                            <p id="helpJudul" class="help is-hidden"></p>
                        </div>

                        <div class="mb-3">
                            <label for="sumberDaya" class="col-form-label"><strong>
                                    Upload File Sumber Daya</strong></label>
                            <input type="file" class="form-control" id="sumberDaya"
                                placeholder="Upload File Sumber Daya" />
                            <p id="helpSumberDaya" class="help is-hidden"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn app-btn-primary" onclick="uploadFileSumberDaya()">Upload
                        Sumber Daya</button>
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
