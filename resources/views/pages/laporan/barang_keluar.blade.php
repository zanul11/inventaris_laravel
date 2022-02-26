@extends('layouts.master')

@section('title', 'Barag Masuk')

@section('plugins_styles')
<link href="{{asset('assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection



@section('page_styles')
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
        <li class="breadcrumb-item"><a href="">Laporan Barang Keluar</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Laporan <small>barang keluar...</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-primary" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="row width-full">
                <form method="POST" action="/laporan-keluar">
                    @csrf
                    <div class="col-lg-12">
                        <div class=" form-inline">
                            <div class="form-group row">
                                <div class="form-inline">
                                    <select class="select2 show-tick form-control " name="jenis" data-style="btn-inverse" required>
                                        <option value="">Pilih Jenis Barang</option>
                                        <option value="semua" {{("semua"==Session::get('jenis_barang'))?'selected':''}}>Semua</option>
                                        @foreach($jenis as $dt)
                                        <option value="{{$dt->id}}" {{($dt->id==Session::get('jenis_barang'))?'selected':''}}>{{$dt->jenis}}</option>
                                        @endforeach
                                    </select>
                                </div>&emsp;

                                <input class="form-control" type="date" name="dtgl" value="{{Session::get('dTgl')}}" required>&emsp;
                                <input class="form-control" type="date" name="stgl" value="{{Session::get('sTgl')}}" required>&emsp;
                                <button class="btn btn-warning"><i class="fa fa-plss"></i> Filter</button>
                            </div>
                        </div>

                    </div>
                </form>
                <form method="POST" action="/laporan-keluar/1" target="_blank">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-12">
                        <div class=" form-inline">
                            <div class="form-group row">
                                <input type="hidden" name="jenis" value="{{Session::get('jenis_barang')}}">
                                <input type="hidden" name="dtgl" value="{{Session::get('dTgl')}}">
                                <input type="hidden" name="stgl" value="{{Session::get('sTgl')}}">
                                <button class="btn btn-green"><i class="fa fa-print"></i> Cetak</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-border">
                <thead>
                    <tr align="center">
                        <th class="width-10" rowspan="2">No.</th>
                        <th rowspan="2">NAMA BARANG</th>
                        <th rowspan="2">SATUAN</th>
                        <th rowspan="2">JUMLAH KELUAR</th>
                        <th rowspan="2">LOKASI</th>
                        <th rowspan="2">TGL KELUAR</th>

                    </tr>

                </thead>
                <tbody>
                    @foreach($array_barang as $dt)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <th colspan="7">
                            {{$dt->jenis}}
                        </th>
                    </tr>
                    @php
                    $total = 0;
                    @endphp
                    @foreach($dt->barang as $brg)
                    @foreach($brg->log_keluar as $log)
                    <tr align="center">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$brg->detail->nama}}</td>
                        <td>{{$brg->detail->satuan_detail->satuan}}</td>
                        <td>{{$log->jumlah}}</td>
                        <td>{{$log->ket??'-'}}</td>
                        <td>{{date('d-m-Y', strtotime($log->tgl))}}</td>
                    </tr>
                    @php
                    $total +=$log->jumlah ;
                    @endphp
                    @endforeach
                    @endforeach
                    <tr align="center" style="background-color:black">
                        <th colspan="3">TOTAL</th>
                        <th>
                            {{$total}}
                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
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
@endsection

@section('plugins_scripts')
<script src="{{asset('assets/vendors/dataTables/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection