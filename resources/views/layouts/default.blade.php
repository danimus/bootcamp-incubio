<!doctype html>
<html lang="es" ng-app="mediatweet">
<head>
    @include('includes.head')
</head>
<body>
    <div class="container-fluid">

        <header class="row">
<!--
            @ if (Auth::check())
                @ include('includes.header2')
            @ else
                @ include('includes.header_admin')
            @ endif
-->
            @include('includes.header_admin')
        </header>

        <!-- #page-wrapper -->
        <div id="page-wrapper">
            <div id="page-content">


                    <ng-view></ng-view>
                    @yield('content')

            </div>
        </div>
        <!-- /#page-wrapper -->

        <footer class="row">
            @include('includes.footer')
        </footer>
    </div>
</body>
</html>
