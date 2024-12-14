<!doctype html>
<html lang="en">



<head>

    <meta charset="utf-8" />
    <title>MP3 | LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('mp3/images/modisLogo.png')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('/mp3')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/mp3')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
<link href="{{asset('/mp3')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        body{
             font-family: "Poppins" !important;
        }
        .overlay-body {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .pos-absolute {
            position: absolute;
        }

        .wd-100p {
            width: 100% !important;
        }


        .overlay-right {
            position: fixed; /* Sit on top of the page content */
            /* display: none;  */
            width: 50%; /* Full width (cover the whole page) */
            height: 100%; /* Full height (cover the whole page) */
            top: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.158); /*Black background with opacity */
            z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer; /* Add a pointer on hover */
        }
    </style>
</head>


<body class="" style="overflow: hidden">
        <div class="" style="font-family: 'Poppins'; background-image:url({{ asset('images/background/background-login.jpg') }});background-size: 130%;background-repeat: no-repeat">
            <div class="row">
                 <div class="col-lg-6 bg-mp3">
                    <div class="">
                        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                            <div class="row justify-content-center my-auto">
                                <div class="col-md-8 col-lg-6 col-xl-8">
                                    <div class="text-center  pd-1 py-5" style="padding: 22px;">
                                        <div class="mb-2 mb-md-3">
                                            <a href="#" class="d-block auth-logo" style="padding: 10px 41px">
                                                <img src="{{asset('mp3/images/modisLogo.png')}}" height="60px" alt="" class="auth-logo-dark">
                                            </a>
                                        </div>
                                        <div class="mb-5">
                                             <h5 class="text-white h2">MP3</h5>
                                        </div>
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
    
                                            @if(session('errors'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
    
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            @if (Session::has('success'))
                                            <div class="alert alert-success">
                                                {{ Session::get('success') }}
                                            </div>
                                            @endif
                                            @if (Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('error') }}
                                            </div>
                                            @endif
    
                                            <div class="form-floating form-floating-custom mb-3">
                                                <input type="text" class="form-control shadow-lg text-dark" style="border-radius: 10px" id="input-username"
                                                    name="username" placeholder="Enter User Name">
                                                <label for="input-username text-dark">Email/Username</label>
                                                <div class="form-floating-icon p-3" >
                                                    <img src="{{asset('images/icon/username.png')}}" alt="" width="100%">
                                                </div>
                                            </div>
                                            <div class="form-floating form-floating-custom mb-3">
                                                <input type="password" class="form-control shadow-lg text-dark" style="border-radius: 10px" id="input-password"
                                                    placeholder="Enter Password" name="password">
                                                <label for="input-password text-dark">Password</label>
                                                <div class="form-floating-icon p-3" >
                                                        <img src="{{asset('images/icon/password.png')}}" alt="" width="100%">
                                                </div>
                                            </div>
    
                                            <div class="form-check form-check-info font-size-16">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label font-size-14 text-white" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div>
    
                                            <div class="mt-3">
                                                <button class="btn  w-50 btn-mp3 shadow-xl fs-5 fw-bold" style="border-radius:10px;padding:10px" type="submit">Masuk</button>
                                            </div>
                                           
                                        </form><!-- end form -->
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div><!-- end container -->
                </div>
                <div class="col-lg-6 p-0 d-none d-sm-block overlay-right" >
                    <div class="justify-content-end row">
                        <div class="col-lg-8">
                            <div style="padding: 20px;">
                                <img src="{{ asset('images/background/dispriok.png') }}" width="100%" alt="">
                            </div>
                        </div>
                    </div>
                    <div class=" d-sm-none d-md-block  d-none d-sm-block d-none .d-sm-block"></div>
                </div>
            </div>
            <div class=" "></div>
        </div>
    </div>
    <!-- end authentication section -->

    <!-- JAVASCRIPT -->
    <script src="{{asset('/mp3')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/mp3')}}/libs/metismenujs/metismenujs.min.js"></script>
    <script src="{{asset('/mp3')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('/mp3')}}/libs/feather-icons/feather.min.js"></script>

</body>

<!-- Mirrored from preview.pichforest.com/dashonic/layouts/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Sep 2021 15:57:37 GMT -->

</html>
