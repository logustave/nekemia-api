<!--
=========================================================
* Soft UI Dashboard - v1.0.5
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  @include('partials.includes.headerFiles')
</head>

<body class="g-sidenav-show  ">
    {{-- SideBar--}}
        @include('partials.sideBar')
    {{--End side Bar--}}
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
      @include('partials.navBar')

    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @yield('body')
        {{--  footer --}}
     @include('partials.footer')

        {{--  endfooter --}}
    </div>
  </main>
  <!--   Core JS Files   -->
    <footer class="footer pt-3  align-text-bottom">
        @include('partials.includes.footerFiles')
    </footer>
</body>

</html>
