@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
<h1>Dashboard</h1>
@stop
@section('content')
<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$data1}}</h3>
                

                <h5>SISWA</h5>
              </div>
              <div class="icon">
                <i class="fa fa-id-badge"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$data2}}</sup></h3>

                <h5>GURU</h5>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$data3}}</h3>

                <h5>RUANGAN</h5>
              </div>
              <div class="icon">
                <i class="fa fa-university"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$data4}}</h3>

                <h5>PENGGUNA SISTEM</h5>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
         
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
</div>
@endsection