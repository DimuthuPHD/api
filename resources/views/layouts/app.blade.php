<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">



    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset('assets/images/favicon/favicon.png" type="image/x-icon')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon.png" type="image/x-icon')}}">
    <title>{{config('app.name')}}</title>
    <!-- Google font-->

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/prism.css')}}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/alpine/alpine.min.js')}}">
</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('includes.header')
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                @include('includes.sidebar')
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    @include('includes.breadcrumbs')
                    @include('includes.alert')
                </div>
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-10 p-0 footer-left">
                            <p class="mb-0">Copyright 2022 © Koho theme by pixelstrap</p>
                        </div>
                        <div class="col-2 p-0 footer-right"> <i class="fa fa-heart font-danger"> </i></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>




    <script src="{{asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/js/config.js') }}"></script>
    <script src="{{asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/stock-prices.js') }}"> </script>
    <script src="{{asset(' assets/js/prism/prism.min.js') }}"></script>
    <script src="{{asset('assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{asset('assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{asset('assets/js/notify/index.js') }}"></script>
    <script src="{{asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js') }}"></script>

    @stack('scripts')
</body>

</html>