<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Kommit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/logo.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Start css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet">
    <!-- jQuery Confirm css -->
    <link href="{{ asset('backend/plugins/jquery-confirm/css/jquery-confirm.css') }}" rel="stylesheet" type="text/css">
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

    <style>
        #loading_overlay {
            /* background-color: #d7e5e6; */
            backdrop-filter: blur(5px);
            position: fixed;
            top: 0;
            right: 0;
            width: 100vw;
            height: 100vh;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 8px;
            width: 16px;
            background: #0080ff;
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }

        .lds-facebook div:nth-child(1) {
            left: 8px;
            animation-delay: -0.24s;
        }

        .lds-facebook div:nth-child(2) {
            left: 32px;
            animation-delay: -0.12s;
        }

        .lds-facebook div:nth-child(3) {
            left: 56px;
            animation-delay: 0;
        }

        @keyframes lds-facebook {
            0% {
                top: 8px;
                height: 64px;
            }

            50%,
            100% {
                top: 24px;
                height: 32px;
            }
        }
    </style>
    @toastr_css
    @stack('extra_css')
    <!-- css Components -->
    @stack('css_components')
    <!-- End Components -->

    <style>
        .form-control {
            border: 1px solid rgb(0 0 0 / 28%);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #0080ff;
            border: 1px solid rgb(0 0 0 / 3%);
        }

        .required:after {
            content: " *";
            color: red;
        }

        .bread_crumb {
            display: inline-block;
            padding-top: 6px;
            float: right;
        }

        /* fix for sidebar not scrolling */
        /* .navigationbar {
            height: calc(100vh - 100px);
            overflow: auto;
            -webkit-transition: 0.5s;
            transition: 0.5s;
        } */
        .slimScrollBar {
            z-index: 0 !important;
            width: 0 !important;
        }

        .vertical-menu {
            overflow: auto !important;
            height: calc(700px - 150px) !important;
        }

        /* Make font size and table padding less */
        body,
        h6 {
            font-size: 14px !important;
        }

        table.dataTable tbody th,
        table.dataTable tbody td {
            padding: 2px 6px !important;
        }

        td .rounded-circle {
            width: 40px !important;
            height: 40px !important;

        }

        .form-control {
            font-size: 14px !important;
        }

        .iffyTip {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            cursor: pointer;
            width: 10% !important;
        }
    </style>
    <!-- End css -->
</head>

<body class="vertical-layout">
    <!-- Image loader -->
    <div id="loading_overlay">
        <div class="lds-facebook">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Image loader -->
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->

        <div class="leftbar">
            <!-- Start Sidebar -->

            <div class="sidebar">
                <!-- Start Logobar -->
                <div class="logobar">
                    <a href="{{ url('/') }}" class="logo logo-large"><img
                            src="{{ asset('backend/images/logo.png') }}" class="img-fluid" alt="logo"></a>
                    <a href="{{ url('/') }}" class="logo logo-small"><img
                            src="{{ asset('backend/images/logo.png') }}" class="img-fluid" alt="logo"></a>
                </div>
                <!-- End Logobar -->

                @include('include.sidebar')

            </div>
            <!-- End Sidebar -->
        </div>
        <!-- End Leftbar -->

        <!-- Start Rightbar -->
        <div class="rightbar">
            @include('include.header')
            <div class="contentbar" style="margin-top:70px; ">
                <!-- Start row -->
                <div class="row">
                    @yield('content')
                </div>
            </div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            @include('include.footer')
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    {{-- <script src="{{ asset('backend/js/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('backend/js/detect.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/js/vertical-menu.js') }}"></script>
    <!-- Switchery js -->
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
    <!-- jQuery Confirm js -->
    <script src="{{ asset('backend/plugins/jquery-confirm/js/jquery-confirm.js') }}"></script>
    <!-- Apex js -->
    <script src="{{ asset('backend/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/apexcharts/irregular-data-series.js') }}"></script>

    <!-- Slick js -->
    <script src="{{ asset('backend/plugins/slick/slick.min.js') }}"></script>
    <!-- Dashboard js -->

    <!-- Core js -->
    <script src="{{ asset('backend/js/core.js') }}"></script>

    <script>
        const show_page_loader = () => {
            $("#loading_overlay").fadeIn();
        }
        const hide_page_loader = () => {
            $("#loading_overlay").fadeOut();
        }

        $(window).on('load', function() {
            hide_page_loader();
        });

        $(document).ajaxStart(function() {
            show_page_loader();
        });

        $(document).ajaxComplete(function() {
            hide_page_loader();
        });
    </script>
    {{-- AJAX setup --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        const button_spinner = (id, message, disabled) => {
            $(id).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${message ||
        'loading..'}`).prop("disabled", disabled);
        }

        const button_restore = (id, message, disabled) => {
            $(id).html(message ? message : ($(id).text())).prop("disabled", disabled);
        }

    </script>

    <!-- Extra Scripts -->

    @stack('extra_scripts')

    <!-- End js -->

    @toastr_js
    @toastr_render

    <!-- Extra Components -->
    @stack('extra_components')
    <!-- End Components -->

</body>

</html>
