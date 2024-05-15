<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>Admin | Dashboard</title> -->
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->

    <!-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">

      <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="icon" type="image/png" href="{{ URL::asset('dist/img/logo_head-f.png') }}">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">{{ Auth::guard('admin')->user()->name }}
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                        <!-- <div class="dropdown-divider"></div> -->
                        <a href="{{ route('admin.logout') }}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->