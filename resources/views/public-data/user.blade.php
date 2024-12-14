<!doctype html>
<html lang="en">


<head>

    <!-- CSS -->
    @include('layouts.partials.head')
    <!-- End CSS -->
    <!-- Leaflet -->
    <style>
        .main-content{
            margin-left: 0px;
            /* padding:  0px 100px; */
        }
    </style>

</head>


<body style="background: #F3F4F6;" data-sidebar-size="lg" class="sidebar-disable">

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">




        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <!-- end page title -->
                <div class="row animate__animated  animate__fadeIn">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">{{Request::get('title')}}</h4>
                            </div>
                            <div class="card-body">
                               <div class="row">
                                    <div class="col-lg-3">
                                        <span class="d-block fw-bolder text-muted">NIK</span>
                                        <span class="d-block fs-5">{{$data->nik ?? 'N/A'}}</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="d-block fw-bolder text-muted">NAMA</span>
                                        <span class="d-block fs-5">{{$data->name ?? 'N/A'}}</span>

                                    </div>
                                    <div class="col-lg-3">
                                        <span class="d-block fw-bolder text-muted">TELEPON</span>
                                        <span class="d-block fs-5">{{$data->nomor_telepon ?? 'N/A'}}</span>

                                    </div>
                                    <div class="col-lg-3">
                                        <span class="d-block fw-bolder text-muted">EMAIL</span>
                                        <span class="d-block fs-5">{{$data->email ?? 'N/A'}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>

    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


</body>


</html>
