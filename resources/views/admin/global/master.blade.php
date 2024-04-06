<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    @include('admin.global.css_support')
    @yield('backend_custom_style')
</head>


<body class="navbar-fixed sidebar-fixed" id="body">
    <script>
        NProgress.configure({showSpinner: false });
        NProgress.start();
    </script>
    {{-- <div id="toaster"></div> --}}
    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        @include('admin.layouts.sidebar')

        <!-- ====================================
        ——— PAGE WRAPPER
        ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            @include('admin.layouts.header')

            <!-- ====================================
            ——— CONTENT WRAPPER
            ===================================== -->
            <div class="content-wrapper">
                <div class="content">
                    @yield('backend_content')
                </div>
            </div>

            <!-- Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>
    @include('admin.global.js_support')
    @yield('backend_custom_js')
</body>

</html>