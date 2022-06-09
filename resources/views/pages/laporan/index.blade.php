@extends('layouts.master')

@section('title', 'Satuan')

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
        <li class="breadcrumb-item"><a href="#">Manajemen Barang</a></li>
        <li class="breadcrumb-item"><a href="">Laporan</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Laporan <small>barang...</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-primary" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <?php $namaBulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); ?>
        <div class="panel-heading">
            <div class="row width-full">
                <form method="POST" action="/laporan">
                    @csrf
                    <div class="col-lg-12">
                        <div class=" form-inline">
                            <div class="form-group row">
                                <div class="form-inline">
                                    <select class="select2  form-control " name="jenis" data-style="btn-inverse" id="jenis" required>
                                        <option value="">Pilih Jenis Barang</option>
                                        <option value="semua" {{('semua'==Session::get('jenis_barang'))?'selected':''}}>Semua</option>
                                        @foreach($jenis as $dt)
                                        <option value="{{$dt->id}}" {{($dt->id==Session::get('jenis_barang'))?'selected':''}}>{{$dt->jenis}}</option>
                                        @endforeach
                                    </select>&emsp;
                                    <select class="select2  form-control " name="bulan" id="bulan" data-style="btn-inverse" required>
                                        <option value="">Pilih Bulan</option>
                                        <option value="semua" {{('semua'==Session::get('bulan'))?'selected':''}}>Semua</option>
                                        @for($i=1; $i<=12; $i++) <option value="{{$i}}" {{($i==Session::get('bulan'))?'selected':''}}>{{$namaBulan[$i]}}</option>
                                            @endfor
                                    </select>&emsp;
                                    <select class="select2  form-control" name="tahun" id="tahun" data-style="btn-inverse" required>

                                        @for($i=date('Y'); $i>=2021; $i--) <option value="{{$i}}" {{($i==Session::get('tahun'))?'selected':''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>&emsp;
                                <!-- <input class="form-control" type="date" name="dtgl">&emsp;
                                <input class="form-control" type="date" name="stgl">&emsp; -->
                                <button class="btn btn-warning"><i class="fa fa-plus"></i> Filter</button>
                            </div>
                        </div>

                    </div>
                </form>
                <form method="POST" action="/laporan/1" target="_blank">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-12">
                        <div class=" form-inline">
                            <div class="form-group row">
                                <input type="hidden" name="jenis" value="{{Session::get('jenis_barang')}}">
                                <input type="hidden" name="bulan" value="{{Session::get('bulan')}}">
                                <input type="hidden" name="tahun" value="{{Session::get('tahun')}}">
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
                        <th rowspan="2">JENIS BARANG</th>
                        <th rowspan="2">SATUAN</th>
                        <th colspan="4">JUMLAH</th>
                    </tr>
                    <tr>
                        <th>SALDO AWAL</th>
                        <th>MASUK</th>
                        <th>KELUAR</th>
                        <th>SALDO AKHIR</th>
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

                    <tr align="center">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$brg->detail->nama}}</td>
                        <td>{{$brg->detail->satuan_detail->satuan}}</td>
                        <td>{{$brg->saldo_awal}}</td>
                        <td>{{$brg->log_masuk}}</td>
                        <td>{{$brg->log_keluar}}</td>
                        <td>{{$brg->saldo_awal+$brg->log_masuk-$brg->log_keluar}}</td>
                    </tr>
                    @php
                    $total +=($brg->saldo_awal+$brg->log_masuk-$brg->log_keluar);
                    @endphp
                    @endforeach
                    <tr align="center" style="background-color:black">
                        <th colspan="6">TOTAL</th>
                        <th>
                            {{$total}}
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