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
<link href="{{asset('assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
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

        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-cubes fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">JUMLAH PERALATAN</div>
                    <div class="stats-number">{{ $log_count }}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('logistik.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">JUMLAH BARANG</div>
                    <div class="stats-number">{{ $brg_count }}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('barang.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-purple">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">PEMASUKAN BULAN INI</div>
                    <div class="stats-number">{{number_format($pemasukan)}}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('laporan-akunting.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-black">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">PENGELUARAN BULAN INI</div>
                    <div class="stats-number">{{number_format($pengeluaran)}}</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-link">
                        <a href="{{ route('laporan-akunting.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 ">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">INFORMASI STOK BARANG YANG AKAN HABIS</h4>
                </div>
                <div class="panel-body table-responsive ">
                    <table class="table table-hover table-striped data-table">
                        <thead>
                            <tr>
                                <th class="width-60">NO.</th>
                                <th>NAMA </th>
                                <th>MINIMAL STOK</th>
                                <th>STOK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barang as $dt)
                            <tr>
                                <td class="width-60">{{$loop->iteration}}</td>
                                <td>{{$dt->nama}}/{{$dt->merk}} </td>
                                <td>{{$dt->minimum}}</td>
                                <td>{{$dt->stok}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer form-inline">
                    <div class="col-md-6 col-lg-10 col-xl-10 col-xs-12">
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="panel panel-primary" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">INFORMASI PERALATAN YANG HABIS PINJAM</h4>
                </div>
                <div class="panel-body table-responsive ">
                    <table class="table table-hover table-striped data-table">
                        <thead>
                            <tr>
                                <th class="width-60">NO.</th>
                                <th>NAMA </th>
                                <th>MINIMAL STOK</th>
                                <th>STOK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peralatan as $dt)
                            <tr>
                                <td class="width-60">{{$loop->iteration}}</td>
                                <td>{{$dt->nama}}/{{$dt->merk}} </td>
                                <td>{{$dt->minimum}}</td>
                                <td>{{$dt->stok}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer form-inline">
                    <div class="col-md-6 col-lg-10 col-xl-10 col-xs-12">
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="panel panel-danger" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">INFORMASI DOKUMEN PEGAWAI (HABIS MASA BERLAKU)</h4>
                </div>
                <div class="panel-body table-responsive ">
                    <table class="table table-hover data-table table-striped">
                        <thead>
                            <tr>
                                <th class="width-60">NO.</th>
                                <th>NAMA </th>
                                <th>JENIS DOK</th>
                                <th>BATAS WAKTU</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dok as $dt)
                            <tr>
                                <td class="width-60">{{$loop->iteration}}</td>
                                <td>{{$dt->pegawai->nama}}</td>
                                <td>{{$dt->jenis}}</td>
                                <td>{{$dt->tanggal}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer form-inline">
                    <div class="col-md-6 col-lg-10 col-xl-10 col-xs-12">
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    @if(Auth::user()->type==1 || Auth::user()->type==3)
    <a href="{{asset('assets/inventaris_mobile.apk')}}" target="_blank" class="btn btn-primary btn-rounded">DOWNLOAD APLIKASI ANDROID</a>
    @endif
    <!-- end row -->
    <!-- begin row -->
    <!-- end row -->
    <!-- begin row -->
    <!-- end row -->
</div>
@endsection

@section('plugins_scripts')
<script src="{{asset('assets/vendors/dataTables/datatables.min.js')}}"></script>
@endsection

@section('page_scripts')
<script>
    $(function() {
        $(document).ready(function() {
            $('.data-table').DataTable({
                searching: false,
                pageLength: 7,
                lengthChange: false,
                responsive: true,
            });
        });
    });
    var nama = JSON.parse('{{json_encode(Auth::user()->nama)}}'.replace(/&quot;/g, '"'));
    // handleDashboardGritterNotification = function() {
    //     setTimeout(function() {
    //         $.gritter.add({
    //             title: "SELAMAT DATANG " + nama,
    //             text: "Selamat bekerja dan semoga sukses",
    //             image: "../assets/img/users/user.png",
    //             sticky: !0,
    //             time: "",
    //             class_name: "my-sticky-class"
    //         });
    //     }, 1e3)
    // }
</script>
@endsection