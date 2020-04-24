@include('layouts.header')
<style>
    /* body {
        font-family: Poppins, sans-serif !important;
    } */
</style>
<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script>
        window.addEventListener('load', function load() {
            const loader = document.getElementById('loader');
            setTimeout(function() {
                loader.classList.add('fadeOut');
            }, 300);
        });
    </script>
    <div>
        <!-- Left sidebar start -->
        @include('layouts.sidebar')
        <!-- Left sidebar End -->

        <!-- page container / content starts here -->
        <div class="page-container">

            <!-- topbar starts here -->
            @include('layouts.topbar')
            <!-- end topbard -->

            <!-- main content start here -->
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <!-- yielding page content starts here -->
                    @yield('content')
                    <!-- end yielding page content -->
                </div>
            </main>
            <!-- end main content -->

            <!-- footer starts here -->
            @include('layouts.footer')
            <!-- end footer here -->
        </div>
        <!-- end page container / content -->
    </div>

    <!--scripts start here -->
    @include('layouts.scripts')
    <!-- scripts end here -->

</body>

</html>

