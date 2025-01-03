<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="shortcut icon" type="image/png" href="{{asset('/public/assets')}}/images/logos/favicon.png" />
        <link rel="stylesheet" href="{{asset('/public/assets')}}/css/styles.min.css" />
        <link rel="stylesheet" href="{{asset('/public/assets')}}/css/app.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        {{--ck editor--}}
        <script src="{{asset('/public/ckeditor')}}/build/ckeditor.js"></script>
        <script src="{{asset('/public/ckeditor')}}/build/translations/en.js"></script>
        <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
        <script src="{{asset('/public/ckeditor')}}/ckfinder/ckfinder.js"></script>

        {{--css important--}}
        <style>
        .multiselect-dropdown{
            width: 100% !important;
        }
        .myImageClass {
            maxwidth: 100px;  // Adjust as needed
            height: auto;  // This will maintain the aspect ratio
        }
         .ck-content img {
             width: 100px;
             height: auto;
         }

        </style>
        </head>

        <body>
          <!--  Body Wrapper -->
            <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            {{-- sidebar start --}}
                @include('admin.layouts.menu')

                <!--  Main wrapper -->
                <div class="body-wrapper">

                    <!--  Header Start -->
                    @include('admin.layouts.header')

                    {{-- main content start --}}
                    @yield('main-content')

                    <div class="container-fluid py-6 px-6 text-center">
                        <p class="mb-0 fs-4">Thiết kế và lập trình bởi <a href="https://www.facebook.com/fitatest" target="_blank" class="pe-1 text-primary text-decoration-underline">FITA-VNUA</a> Phân phối bởi <a href="https://www.facebook.com/fitatest">FITA-VNUA</a></p>
                    </div>
                </div>
            </div>

        <script src="{{asset('/public/assets')}}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('/public/assets')}}/js/sidebarmenu.js"></script>
        <script src="{{asset('/public/assets')}}/js/app.min.js"></script>
        <script src="{{asset('/public/assets')}}/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="{{asset('/public/assets')}}/libs/simplebar/dist/simplebar.js"></script>
        <script src="{{asset('/public/assets')}}/js/dashboard.js"></script>
        <script src="{{asset('/public/assets')}}/js/multiselect-dropdown.js"></script>
    </body>
</html>
