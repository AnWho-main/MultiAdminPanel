@php
    $page_name = 'Dashboard';
@endphp
@extends('layouts.main')

@section('title',  config('global.COMPANY').' Admin Dashboard | Manage your complete requirements')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $page_name }}</li>
            </ol>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-body" style="background:#c0c1c7">
          <div class="row">
            @if(auth()->user()->hasPermission('dashboard_total_admin_user'))
              <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Admin User</span>
                    <span class="info-box-number">{{ $adminCount }}</span>
                  </div>
                </div>
              </div>
            @endif

            @if(auth()->user()->hasPermission('dashboard_total_user'))
              <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total User</span>
                    <span class="info-box-number">{{ $userCount }}</span>
                  </div>
                </div>
              </div>
            @endif
            <!-- /.col -->
            <!-- <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Uploads</span>
                  <span class="info-box-number">13,648</span>
                </div>
              </div>
            </div> -->
            <!-- /.col -->
            <!-- <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">93,139</span>
                </div>
              </div>
            </div> -->
            <!-- /.col -->
          </div>
        </div>
        <!-- /.card-body -->
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection