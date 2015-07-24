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
         <div id="page-wrapper">
            
             @if(Auth::check())
                <div id="page-content-admin">
                  
              @else
                <div id="page-content">
            @endif
                <div growl></div>
                
               <ng-view></ng-view>
            </div>
         </div>
         <!-- /#page-wrapper -->
         <!--<footer class="footer">
            @include('includes.footer')
         </footer>-->
      </div>
   </body>
</html>
