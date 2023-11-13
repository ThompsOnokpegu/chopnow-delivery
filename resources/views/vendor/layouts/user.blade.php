<!DOCTYPE html>
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('vendor/') }}assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard - Analytics | Sneat</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('vendor/assets/img/favicon/favicon.ico') }}" />

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
    <link rel="stylesheet" href="{{ asset('vendor/assets/custom.css') }}" />

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <style>
      .timeline {
          position: relative;
          height: 100%;
          width: 100%;
          padding: 0;
          list-style: none;
      }
      .timeline .timeline-item {
          position: relative;
      }
      .timeline .timeline-item .timeline-point-wrapper {
          position: absolute;
          top: -0.5rem;
          left: -0.43rem;
          z-index: 2;
          display: block;
          height: 2.25rem;
          width: 2.25rem;
      }

      .timeline .timeline-item .timeline-point {
          position: absolute;
          left: 0;
          top: 0.75rem;
          z-index: 3;
          display: block;
          height: 0.75rem;
          width: 0.75rem;
          border-radius: 50%;
          background-color: #696cff;
      } 
      .timeline .timeline-point-success {
          background-color: #71dd37 !important;
          box-shadow: 0 0 0 0.1875rem rgba(113,221,55,.16);
      }
      
      html:not([dir=rtl]) .timeline-item {
          border-left: 1px solid #d9dee3;
      }
      .timeline .timeline-item {
          position: relative;
      }
      *, *::before, *::after {
          box-sizing: border-box;
      }
      li {
          display: list-item;
          text-align: -webkit-match-parent;
      }
      .timeline .timeline-item.timeline-item-transparent .timeline-event {
          top: -1.4rem;
          background-color: rgba(0,0,0,0);
      }
      .timeline .timeline-item .timeline-event {
          position: relative;
          top: -1rem;
          width: 100%;
          top: -0.85rem;
          min-height: 4rem;
          background-color: #fff;
          border-radius: 0.375rem;
          padding: 1.25rem 1.5rem 0.75rem;
      }
      @media (max-width: 575.98px){.timeline .timeline-header {
          flex-direction: column;
          align-items: flex-start;
      }}
      
      .timeline .timeline-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          flex-direction: row;
      }
      .timeline .timeline-item .timeline-indicator, .timeline .timeline-item .timeline-indicator-advanced {
        background-color: #f5f5f9;
        position: absolute;
        left: -0.75rem;
        top: 0;
        z-index: 2;
        height: 1.5rem;
        width: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 50%;
        padding: 1rem 0 1rem 0;
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
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        {{-- @include('vendor.layouts.sn-sidebar') --}}
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          {{-- @include('vendor.layouts.sn-topmenu') --}}
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              @yield('content')
            </div>
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

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
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
    <script src="{{ asset('vendor/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('vendor/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('vendor/assets/js/dashboards-analytics.js') }}"></script>
    
    <!-- Dropezone JS -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
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

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
