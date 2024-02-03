<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.header')
    <title>Rental Book | @yield('title')</title>

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.left-sidebar')
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- TopBar -->
                @include('layouts.navbar')
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">

                    @yield('content')

                </div>
                <!---Container Fluid-->
            </div>

            <!-- Footer -->
            @include('layouts.footer')
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Script -->
    @include('layouts.script')

</body>

</html>
