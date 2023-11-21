<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('vendor/assets/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('customer/assets/img/fevicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('vendor/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('vendor/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <style>
      .btn-primary,.btn-primary:hover {
          color: #000000;
          background-color: #FFC244;
          border-color: #FFC244;
          box-shadow: 0 0.125rem 0.25rem 0 rgba(255, 194, 68, 0.4);
      }
      .btn-primary:focus, .btn-primary.focus {
          color: #000000;
          background-color: #FFC244;
          border-color: #FFC244;
          transform: translateY(0);
          box-shadow: none;
      }
      a,a:hover,a:focus {
          color: #cf2c2a;
      }
      .form-control:hover,.form-control:focus{
        border: 1px solid #FFC244;
      }
      span.input-group-text:hover {
          border: 1px solid #FFC244;
      }
      
    </style>
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('vendor/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('vendor/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
     
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @yield('account')
            <!-- / Content -->
            <!-- Footer -->
            @include('vendor.layouts.footer')
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('vendor/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('vendor/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('vendor/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      upload.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = upload.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
  </body>
</html>
