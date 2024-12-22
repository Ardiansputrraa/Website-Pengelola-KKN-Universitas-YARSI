<!DOCTYPE html>
<html lang="en">

<head>
    <x-header></x-header>
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
                        <h1 class="app-page-title mb-0">Kalender Kegiatan</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="docs-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-docs" name="searchdocs"
                                                class="form-control search-docs" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

                                </div><!--//col-->
                                <div class="col-auto">
                                    <a class="btn app-btn-primary" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-plus" viewBox="0 0 16 16">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                                            <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8"/>
                                          </svg>
                                        Tambah Kegiatan
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="#">
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
                                                <th class="cell">Tanggal</th>
                                                <th class="cell">Waktu</th>
                                                <th class="cell">Tempat</th>
                                                <th class="cell">Materi</th>
                                                <th class="cell">Narasumber</th>
                                                <th class="cell">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell"><span>17 Oct 2024</span><span class="note">Rabu</span></td>
                                                <td class="cell">08.00 - 17.00</td>
                                                <td class="cell">Zoom</td>
                                                <td class="cell">Pengantar KKN</td>
                                                <td class="cell"><span>Dr. Drs. Restu Syamsul Hadi, M.Kes.</span></td>
                                                <td class="cell"><a class="btn-sm app-btn-primary"
                                                        href="#">Ubah</a></td>
                                            </tr>
                                            <tr>
                                                <td class="cell"><span>17 Oct 2024</span><span class="note">Rabu</span></td>
                                                <td class="cell">08.00 - 17.00</td>
                                                <td class="cell">Zoom</td>
                                                <td class="cell">Adab Bermasyarakat Sesuai Nilai Islam</td>
                                                <td class="cell"><span>Dr. Drs. Restu Syamsul Hadi, M.Kes.</span></td>
                                                <td class="cell"><a class="btn-sm app-btn-primary"
                                                        href="#">Ubah</a></td>
                                            </tr>
                                            <tr>
                                                <td class="cell"><span>17 Oct 2024</span><span class="note">Rabu</span></td>
                                                <td class="cell">08.00 - 17.00</td>
                                                <td class="cell">Zoom</td>
                                                <td class="cell">Pembuatan Media Publikasi</td>
                                                <td class="cell"><span>Dr. Drs. Restu Syamsul Hadi, M.Kes.</span></td>
                                                <td class="cell"><a class="btn-sm app-btn-primary"
                                                        href="#">Ubah</a></td>
                                            </tr>
                                            <tr>
                                                <td class="cell"><span>17 Oct 2024</span><span class="note">Rabu</span></td>
                                                <td class="cell">08.00 - 17.00</td>
                                                <td class="cell">Zoom</td>
                                                <td class="cell">Komunikasi Interpersonal</td>
                                                <td class="cell"><span>Dr. Drs. Restu Syamsul Hadi, M.Kes.</span></td>
                                                <td class="cell"><a class="btn-sm app-btn-primary"
                                                        href="#">Ubah</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->

                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                        

                    </div><!--//tab-pane-->

                    <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">

                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">#15346</td>
                                                <td class="cell"><span class="truncate">Lorem ipsum dolor sit amet
                                                        eget volutpat erat</span></td>
                                                <td class="cell">John Sanders</td>
                                                <td class="cell"><span>17 Oct</span><span class="note">2:16
                                                        PM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$259.35</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary"
                                                        href="#">View</a></td>
                                            </tr>

                                            <tr>
                                                <td class="cell">#15344</td>
                                                <td class="cell"><span class="truncate">Pellentesque diam
                                                        imperdiet</span></td>
                                                <td class="cell">Teresa Holland</td>
                                                <td class="cell"><span class="cell-data">16 Oct</span><span
                                                        class="note">01:16 AM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$123.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary"
                                                        href="#">View</a></td>
                                            </tr>

                                            <tr>
                                                <td class="cell">#15343</td>
                                                <td class="cell"><span class="truncate">Vestibulum a accumsan lectus
                                                        sed mollis ipsum</span></td>
                                                <td class="cell">Jayden Massey</td>
                                                <td class="cell"><span class="cell-data">15 Oct</span><span
                                                        class="note">8:07 PM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$199.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary"
                                                        href="#">View</a></td>
                                            </tr>


                                            <tr>
                                                <td class="cell">#15341</td>
                                                <td class="cell"><span class="truncate">Morbi vulputate lacinia
                                                        neque et sollicitudin</span></td>
                                                <td class="cell">Raymond Atkins</td>
                                                <td class="cell"><span class="cell-data">11 Oct</span><span
                                                        class="note">11:18 AM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$678.26</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary"
                                                        href="#">View</a></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->

                    <div class="tab-pane fade" id="orders-pending" role="tabpanel"
                        aria-labelledby="orders-pending-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">#15345</td>
                                                <td class="cell"><span class="truncate">Consectetur adipiscing
                                                        elit</span></td>
                                                <td class="cell">Dylan Ambrose</td>
                                                <td class="cell"><span class="cell-data">16 Oct</span><span
                                                        class="note">03:16 AM</span></td>
                                                <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                <td class="cell">$96.20</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary"
                                                        href="#">View</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                    <div class="tab-pane fade" id="orders-cancelled" role="tabpanel"
                        aria-labelledby="orders-cancelled-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="cell">#15342</td>
                                                <td class="cell"><span class="truncate">Justo feugiat neque</span>
                                                </td>
                                                <td class="cell">Reina Brooks</td>
                                                <td class="cell"><span class="cell-data">12 Oct</span><span
                                                        class="note">04:23 PM</span></td>
                                                <td class="cell"><span class="badge bg-danger">Cancelled</span></td>
                                                <td class="cell">$59.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary"
                                                        href="#">View</a></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->



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
