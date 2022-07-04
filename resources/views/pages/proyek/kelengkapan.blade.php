@extends('layouts.master')

@section('title', 'Barang Keluar')

@section('plugins_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content" ng-app="app">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Proyek</a></li>
        <li class="breadcrumb-item"><a href="">Data Proyek</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">DATA </span>BARANG & <span class="text-custom">PERALATAN </span> PROYEK</h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <div class="panel-heading-btn">
                <a href="/proyek/cetak/{{$proyek->id}}" target="_blank" class="f-s-15 btn btn-xs text-white"><i class="fa fa-print"></i></a>
            </div>
            <h4 class="panel-title">DAFTAR BARANG & PERALATAN</h4>
        </div>
        <!-- <form method="POST" action=""> -->
        <div class="panel-body">
            <div class="row width-full">
                <div class="form-group col-md-3">
                    <label class="control-label">NAMA</label>
                    <div class="input-group">
                        <input type="nomor" class="form-control" style="display: block;" value="{{$proyek->nama}}" name="password" disabled>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">PENANGGUNG JAWAB</label>
                    <div class="input-group">
                        <input type="nomor" class="form-control" style="display: block;" value="{{$proyek->pj}}" name="password" disabled>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label">LOKASI</label>
                    <div class="input-group">
                        <input type="nomor" class="form-control" style="display: block;" value="{{$proyek->lokasi}}" name="password" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="note note-primary">
                        <div class="note-content">
                            <h4><b>Daftar Barang </b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">

                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <td class="width-60" align="center"><b>No</b></td>
                                                    <td align="center"><b>Nama</b></td>
                                                    <td align="center"><b>Jumlah</b></td>
                                                    <td align="center"><b>Satuan</b></td>
                                                    <td align="center"><b>Harga</b></td>
                                                    <td align="center"><b>Total</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($barang as $dt)
                                                <tr>
                                                    <td class="width-60" align="center">{{$loop->iteration}}</td>
                                                    <td align="center">{{$dt->barang->nama}} ({{$dt->barang->merk}})</td>
                                                    <td align="center">{{$dt->jumlah}}</td>
                                                    <td align="center">{{$dt->barang->satuan_detail->satuan}}</td>
                                                    <td align="center">{{number_format($dt->barang->harga)}}</td>
                                                    <td align="center">{{number_format($dt->barang->harga*$dt->jumlah)}}</td>
                                                </tr>

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </center>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="note note-green">
                        <div class="note-content">
                            <h4><b>Daftar Peralatan</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">
                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <td class="width-60" align="center"><b>No</b></td>
                                                    <td align="center"><b>Nama</b></td>
                                                    <td align="center"><b>Jumlah</b></td>
                                                    <td align="center"><b>Satuan</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($alat as $dt)
                                                <tr>
                                                    <td class="width-60" align="center">{{$loop->iteration}}</td>
                                                    <td align="center">{{$dt->alat->nama??''}} ({{$dt->alat->merk??''}})</td>
                                                    <td align="center">{{$dt->jumlah}}</td>
                                                    <td align="center">{{$dt->alat->satuan_detail->satuan}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </center>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </form> -->
</div>
</div>
@endsection

@section('plugins_scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection