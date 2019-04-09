<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.jpg') }}">

  <title> MMIT Consulting </title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

  
  @if(Request::segment(1) === 'login' || Request::segment(1) === 'register' )

    <body class="bg-gradient-primary">
    @yield('content')

  @else
    <body id="page-top">
    @include('part.nav')
  @endif


  <!-- Bootstrap core JavaScript-->
  <script src="{{  asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{  asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{  asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{  asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
