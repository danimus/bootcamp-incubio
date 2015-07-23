<!doctype html>
<html lang="es" ng-app="mediatweet">
<head>
    @include('includes.head')
</head>
<body>
    <div class="container-fluid">

        <header class="row">
            @if(Auth::check())
                @include('includes.header_admin')

            @else
                @include('includes.header2')
            @endif

        </header>

        <!-- #page-wrapper -->
        <div id="page-wrapper" style="height:1500px">
            <div id="page-content">


                    <ng-view></ng-view>
                    

            </div>
        </div>
        <!-- /#page-wrapper -->

        <footer class="row">
            @include('includes.footer')
        </footer>
    </div>
</body>
</html>
