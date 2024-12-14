<meta charset="utf-8" />
    <title>MP3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/background/modisLogo.png')}}">
    <!-- Bootstrap Css -->
    <link href="{{asset('/mp3')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('backend/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('/mp3')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{asset('/mp3')}}/libs/datatables.net-dt/css/jquery.dataTables.min.css" id="app-style"
        rel="stylesheet" type="text/css" />
    <link href="{{asset('/mp3/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Jquery Confirm -->
    <link href="{{ asset('plugins/jquery-confirm/css/jquery-confirm.css') }}" rel="stylesheet">
    <!-- alertifyjs Css -->
    <link href="{{asset('/mp3')}}/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" />
    <!-- alertifyjs default themes  Css -->
    <link href="{{asset('/mp3')}}/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('/mp3')}}/libs/flatpickr/flatpickr.min.css" rel="stylesheet">

    <link href="{{asset('/mp3')}}/libs/flatpickr/flatpickr.min.css" rel="stylesheet">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{asset('/mp3')}}/libs/%40simonwep/pickr/themes/classic.min.css" />
    <!-- 'classic' theme -->
    <link rel="stylesheet" href="{{asset('/mp3')}}/libs/%40simonwep/pickr/themes/monolith.min.css" />
    <!-- 'monolith' theme -->
    <link rel="stylesheet" href="{{asset('/mp3')}}/libs/%40simonwep/pickr/themes/nano.min.css" />
    <!-- 'nano' theme -->

    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('mp3/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('mp3/css/animate.min.css')}}" rel='stylesheet' />
    {{-- <link rel="stylesheet" href="{{asset('mp3/libs/select2/select2.min.css')}}" /> --}}
    {{-- Here Maps --}}
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- MDB -->
<link
{{-- href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" --}}
rel="stylesheet"
/>
    @stack('styles')
    <style>
        .text-default{
            color: #153338 !important;
        }
        .ui-datepicker-calendar {
        display: none;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: .5rem;
            color: #74788d;
            content: '/' !important;
        }

        .head-title{
            font-family: sans-serif;
            font-size: 40px;
            color: #0f2e33;
            margin-bottom: 0;
        }
        .btn-perintah {
            width: 200;
            height: 56px;
        }
        element.style {}
/*
        .form-control {
            border-color: #a5a5a5 !important;
        }

        .form-select {
            border-color: #a5a5a5 !important;
        } */

        .table-striped tr:nth-child(even) {
            background-color: #b5d3e754;
        }


        #sidebar-menu ul li a {
            color: white;
        }

        #sidebar-menu ul li a:hover {
            background-color: rgb(255 255 255 / 0.5)
             !important;
            color: #ffffff !important;
            border-radius: 14px !important;
            --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                var(--tw-ring-shadow, 0 0 #0000),
                var(--tw-shadow);
        }

        #sidebar-menu ul li a .nav-icon {
            color: white;
        }

        #sidebar-menu ul li a:hover .nav-icon {
            color: #bdbdbd;
        }

        .menu-title {
            color: white;
        }

        body {
            font-family: 'Poppins', sans-serif !important;
        }


        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #495057;
            font-weight: 500;
            font-family: 'Poppins', sans-serif !important;
        }

        .card-body {

            padding: 1rem 1rem;
        }
        .card-footer{
            padding: 0.6rem 0.25rem !important;
        }

        .alertify .ajs-dialog {
            border-radius: 16px !important;
            background:#001A88 !important ;
        }


        .alertify .ajs-header {
            color: #000;
            font-weight: 700;
            background: transparent !important;
            border-bottom: none !important;
            border-radius: 2px 2px 0 0;
            text-align: center;
        }

        .alertify .ajs-body .ajs-content {
            text-align: center !important;
            color: white !important;
            font-size: 20px !important;
            padding: 0px !important;
        }

        .alertify .ajs-dialog .ajs-footer,
        .alertify .ajs-dialog .ajs-header {
            background: transparent !important;
            border-top: none !important;
        }

        .alertify .ajs-footer {
            padding: 18px;
        }

        .alertify .ajs-footer .ajs-buttons {
            text-align: center !important;
            display: flex;

        }


        .alertify .ajs-footer .ajs-buttons .ajs-button.ajs-ok {
            background: #DC2626 !important;
            width: 50%;
            color: white !important;
            padding: 14px;
            border-radius: 14px;
        }

        .alertify .ajs-footer .ajs-buttons .ajs-button.ajs-cancel {
            background: #9CA3AF !important;
            width: 50%;
            color: white !important;
            padding: 14px;
            border-radius: 14px;
        }

        .alertify-notifier .ajs-message.ajs-error {
            border-radius: 14px;
        }

        /* DATATABLE */
        table.dataTable.no-footer{
            border-bottom:1px solid #eff0f2;
        }
        .datatables{
            font-size:16px !important;
        }
        .tr-head {
            background: #001A88 !important;
            color: white;
        }

        .tr-head th {
            border-bottom: 0px !important;
        }

        .dataTables_length select {
            border: 1px solid #8b8b8b;
            border-radius: 8px;
            padding: 6px 15px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #8b8b8b;
            border-radius: 8px;
            padding: 6px 15px;
        }

        .datatables thead {
            border-radius: 0.5rem;
        }

        .card-title {
            font-size: 20px;
            font-weight: bolder;
            margin-bottom: 0;
        }

        .card {
            border-radius: 20px !important;
        }

        .card-header {
            background-color: #fff0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: white !important;
            background:#001A88 !important;
            border-radius: 28px;
            animation: none;
            font-size: 14px;
            font-weight: bold;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            background:#001A88 !important;
            border-radius: 28px;
            animation: none;
            font-size: 14px;
            font-weight: bold;
        }

        .select2-container .select2-selection--single{
            height: 35px !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #e2e5e8;
        }

        #sidebar-menu ul li ul.sub-menu {
            margin: 2px 12px !important;
            /* background: rgb(255 255 255 / 0.5); */
            border-radius: 20px !important;
        }

        #sidebar-menu ul li ul.sub-menu li a{
             /* color: white !important; */
        }
        #sidebar-menu ul li ul.sub-menu li a:before{
            color: white !important;
        }

        /* DATATABLE CUSTOM BY PATERN */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #001A88 !important;
            border-radius: 8px;
            padding: 6px 15px;
        }
        .dataTables_length select {
            border: 1px solid #001A88 !important;
            border-radius: 8px;
            padding: 6px 15px;
        }

        .datatables thead {
           border-radius: 10px !important;
        }

        .datatables thead tr {
           background:#001A88 !important;
        }


        .datatables thead tr th:first-child {
            border-top-left-radius:  10px !important;
            border-bottom-left-radius:  10px !important;
        }
        .datatables thead tr th:first-child {
            border-top-left-radius:  10px !important;
            border-bottom-left-radius:  10px !important;
        }
        .datatables thead tr th:last-child {
            border-top-right-radius:  10px !important;
            border-bottom-right-radius:  10px !important;
        }

        .noti-dotnya {
            text-align: center;
            position: absolute;
            height: 20px;
            margin: auto;
            color: white;
            line-height: 20px;
            width: 20px;
            border-radius: 10px;
        }

        .clickable-row{
            cursor: pointer;
        }
        .clickable-row:hover{
            background: #0f2e33 !important;
        }

         /* LOADER */
        #preloader {
            z-index: 9999;
            position: fixed;
            top: 0;
            left: 0;
            background: #001A88;
            width: 100%;
            height: 100%;
            /*  */
        }

        #loader {
            display: block;
            position: relative;
            left: 51%;
            top: 50%;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 7px solid transparent;
            /* border-top-color: #00597A; */
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

         #loader:before {
            content: "LOADING...";
            position: absolute;
            top: 50%;
            left: 7%;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            color: white;
            border: 5px solid transparent;
            /* -webkit-animation: spin 3s linear infinite;
            animation: spin 3s linear infinite;  */
        }

        /*#loader:after {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #00B6FE;
            -webkit-animation: spin 1.5s linear infinite;
            animation: spin 2s linear infinite;
        } */

        @-webkit-keyframes spin {
            0% {
               opacity: 0;
            }
            
            50% {
               opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes spin {
            0% {
               opacity: 0;
            }

            50% {
               opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
