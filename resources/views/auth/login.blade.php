<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NetKeşif - Giriş</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/img/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ url('assets/img/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/img/favicon-16x16.png') }}">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ url('assets/vendors/css/base/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/vendors/css/base/elisyam-1.5.min.css') }}">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body class="bg-white">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="{{ url('assets/img/logo.png') }}" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid no-padding h-100">
            <div class="row flex-row h-100 bg-white">
                <!-- Begin Left Content -->
                <div class="col-xl-8 col-lg-6 col-md-5 no-padding">
                    <div class="elisyam-bg background-01">
                        <div class="elisyam-overlay overlay-01"></div>
                        <div class="authentication-col-content mx-auto">
                            <h1 class="gradient-text-01">
                                Welcome To Elisyam!
                            </h1>
                            <span class="description">
                                Etiam consequat urna at magna bibendum, in tempor arcu fermentum vitae mi massa egestas. 
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End Left Content -->
                <!-- Begin Right Content -->
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto no-padding">
                    <!-- Begin Form -->
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="db-default.html">
                                <img src="{{ url('assets/img/logo.png') }}" alt="logo">
                            </a>
                        </div>
                        <h3>Sign In To Elisyam</h3>
                        <form>
                            <div class="group material-input">
							    <input type="text" required>
							    <span class="highlight"></span>
							    <span class="bar"></span>
							    <label>Email</label>
                            </div>
                            <div class="group material-input">
							    <input type="password" required>
							    <span class="highlight"></span>
							    <span class="bar"></span>
							    <label>Password</label>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col text-left">
                                <div class="styled-checkbox">
                                    <input type="checkbox" name="checkbox" id="remeber">
                                    <label for="remeber">Remember me</label>
                                </div>
                            </div>
                            <div class="col text-right">
                                <a href="pages-forgot-password.html">Forgot Password ?</a>
                            </div>
                        </div>
                        <div class="sign-btn text-center">
                            <a href="db-default.html" class="btn btn-lg btn-gradient-01">
                                Sign in
                            </a>
                        </div>
                        <div class="register">
                            Don't have an account? 
                            <br>
                            <a href="pages-register.html">Create an account</a>
                        </div>
                    </div>
                    <!-- End Form -->                        
                </div>
                <!-- End Right Content -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container -->    
        <!-- Begin Vendor Js -->
        <script src="{{ url('assets/vendors/js/base/jquery.min.js') }}"></script>
        <script src="{{ url('assets/vendors/js/base/core.min.js') }}"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="{{ url('assets/vendors/js/app/app.min.js') }}"></script>
        <!-- End Page Vendor Js -->
    </body>
</html>