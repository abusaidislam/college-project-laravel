<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>SAADAT COLLEGE</title>
@include('layouts.link')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"> <span>SAADAT COLLEGE</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="text-center">

                <h2> Welcome {{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
              @include('layouts.bussidebar')

        <!-- top navigation -->
        @include('layouts.navbar')
        <!-- /top navigation -->

        <!-- page content -->

@yield('content')

</div>
    </div>
 </div>
    </div>

        <!-- /page content -->

        <!-- footer content -->
        <footer class="bg-light-subtle">
@include('layouts.footer')
        </footer>
        <!-- /footer content -->
      
    <!-- jQuery -->
  @include('layouts.script')

  </body>
</html>
