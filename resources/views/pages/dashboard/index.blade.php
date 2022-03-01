@extends('layouts.master')

@section('title', 'Dashboard')

@section('plugins_styles')
<link href="{{asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
<link href="{{asset('assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet" />
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Selamat Datang <small>di Aplikasi Inventaris</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->

        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-window-restore"></i></div>
                <div class="stats-info">
                    <h4>BARANG</h4>
                    <p>{{ $brg_count }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('barang.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-cubes"></i></div>
                <div class="stats-info">
                    <h4>LOGISTIK</h4>
                    <p>{{ $log_count }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('logistik.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <!-- <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-purple">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">NEW ORDERS</div>
                    <div class="stats-number">38,900</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-desc">Better than last week (76.3%)</div>
                </div>
            </div>
        </div> -->
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <!-- <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-black">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">NEW COMMENTS</div>
                    <div class="stats-number">3,988</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 54.9%;"></div>
                    </div>
                    <div class="stats-desc">Better than last week (54.9%)</div>
                </div>
            </div>
        </div> -->
        <!-- end col-3 -->
    </div>
    <!-- end row -->
    <!-- begin row -->
    <!-- end row -->
    <!-- begin row -->
    <!-- end row -->
</div>
@endsection

@section('plugins_scripts')

@endsection

@section('page_scripts')
<script>
    var nama = JSON.parse('{{json_encode(Auth::user()->nama)}}'.replace(/&quot;/g, '"'));
    handleDashboardGritterNotification = function() {
        setTimeout(function() {
            $.gritter.add({
                title: "SELAMAT DATANG " + nama,
                text: "Selamat bekerja dan semoga sukses",
                image: "../assets/img/users/user.png",
                sticky: !0,
                time: "",
                class_name: "my-sticky-class"
            });
        }, 1e3)
    }
</script>
@endsection