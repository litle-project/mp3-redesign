<!doctype html>
<html lang="en">


<head>

    <!-- CSS -->
    @include('layouts.partials.head')
    <!-- End CSS -->
     <!-- Leaflet -->

</head>


<body style="background: #F3F4F6;" data-sidebar-size="lg" class="sidebar-enable">
    <div id="preloader">
        <div id="loader">
            <img src="{{ asset('images/background/modisLogo.png') }}" width="100" alt="">
        </div>
    </div>
    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.partials.navbar')
        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.partials.sidebar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('content')
            <!-- End Page-content -->
            <footer class="footer" style="background: white">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 text-center " style="font-weight: bold;">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; MP3
                        </div>
                        {{-- <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Copyright by Solvus
                            </div>
                        </div> --}}
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    @stack('modals')

    <!-- Right Sidebar -->
    @include('layouts.partials.right-bar')
    <!-- /Right-bar -->

    <!-- Scripts -->
    @include('layouts.partials.foot')
    <!--end Scripts-->
</body>


</html>
