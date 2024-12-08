
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('public/upload/collegelogo.jpeg') }}" type="logo" />
    <title>@yield('title') Saaddat College</title>
    @include('layouts.link')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.department-menu')

        <!-- top navigation -->
        @include('layouts.navbar-depart')
        <div class="content-wrapper">
            <div class="p-1">
            </div>
            @yield('content')
        </div>

        <!-- /.content-wrapper -->
        @include('layouts.footer')

        @include('layouts.script')
    </div>

</body>

</html>