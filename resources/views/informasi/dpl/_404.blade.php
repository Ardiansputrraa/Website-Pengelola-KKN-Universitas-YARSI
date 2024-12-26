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
                    <div class="row">
                        <div class="col-12 col-md-11 col-lg-7 col-xl-6 mx-auto">
                            <div class="app-branding text-center mb-1">

                            </div><!--//app-branding-->
                            <div class="app-card p-5 text-center shadow-sm">
                                <h1 class="page-title mb-4"><br><span class="font-weight-light">Kelompok KKN</span>
                                </h1>
                                @if (Auth::user()->dpl->status == 'belum terdaftar')
                                    <div class="mb-4">
                                        Kelompok KKN anda sedang diproses silahkan tunggu
                                        beberapa hari.
                                    </div>
                                @endif
                            </div>
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
