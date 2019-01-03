<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NetKeşif - Önmuhasebe</title>
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
        @yield('pagecss')
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body id="page-top">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="{{ url('assets/img/netkesif-logo.jpg') }}" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <div class="page db-modern">
            <!-- Begin Header -->
            {{-- @include('partials.header') --}}
            <!-- End Header -->
            <!-- Begin Page Content -->
            <div class="page-content">
                <!-- Begin Navigation -->
                @include('partials.horizontalmenu')
                <!-- End Navigation -->
                <div class="content-inner boxed mt-4 w-100">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- End Container -->
                    <!-- Begin Page Footer-->
                    @include('partials.footer')
                    <!-- End Offcanvas Sidebar -->
                </div>
                <!-- End Content -->
            </div>
            <!-- End Page Content -->
        </div>
        <!-- Begin Vendor Js -->
        <script src="{{ url('assets/vendors/js/base/jquery.min.js') }}"></script>
        <script src="{{ url('assets/vendors/js/base/core.min.js') }}"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="{{ url('assets/vendors/js/nicescroll/nicescroll.min.js') }}"></script>
        @yield('pagejs')
        {{-- <script src="{{ url('assets/vendors/js/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ url('assets/vendors/js/chart/chart.min.js') }}"></script>""
        <script src="{{ url('assets/vendors/js/progress/circle-progress.min.js') }}"></script> --}}
        <script src="{{ url('assets/vendors/js/app/app.min.js') }}"></script>
        <!-- End Page Vendor Js -->
        <!-- Begin Page Snippets -->
        @yield('pagecustomjs')
        {{-- <script src="{{ url('assets/js/dashboard/db-modern.min.js') }}"></script> --}}
        <!-- End Page Snippets -->
    </body>
</html>