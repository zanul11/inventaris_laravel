@extends('layouts.master')

@section('title', 'Barang Keluar')

@section('plugins_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content" ng-app="app" ng-controller="BarangKeluarController" ng-init="init('{{$pinjam->kode}}','{{$pinjam->pj}}','{{$pinjam->lokasi}}','{{date('Y-m-d',strtotime($pinjam->tgl_batas))}}')">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Manajemen Barang</a></li>
        <li class="breadcrumb-item"><a href="{{url('/pinjam')}}">Peminjaman</a></li>
        <li class="breadcrumb-item"><a>PENGEMBALIAN DATA</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">PENGEMBALIAN DATA</span> PEMINJAMAN PERALATAN</h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">FORM PENGEMBALIAN DATA</h4>

        </div>
        <!-- <form method="POST" action=""> -->
        <div class="panel-body">
            <div class="row width-full">

                <div class="form-group col-md-3">
                    <label class="control-label">NOMOR</label>
                    <div class="input-group">
                        <input type="nomor" class="form-control" style="display: block;" value="{{$pinjam->kode}}" name="password" disabled>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">Penanggung Jwab</label>
                    <input type="text" class="form-control" style="display: block;" ng-model="pj" placeholder="Penanggung jawab" disabled>
                </div>
                <div class=" form-group col-md-3">
                    <label class="control-label">Tanggal Batas</label>
                    <div class="input-group">
                        <input class="form-control" ng-model="tgl" type="date" disabled>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="control-label">Lokasi</label>
                    <div class="input-group">
                        <input type="text" class="form-control" style="display: block;" ng-model="ket" placeholder="Lokasi..." disabled>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="note note-primary">
                        <div class="note-content">
                            <h4><b>Daftar Peminjaman </b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">

                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <td class="width-60" align="center"><b>No</b></td>
                                                    <td align="center"><b>Nama</b></td>
                                                    <td align="center"><b>Jum Rusak/Ket</b></td>
                                                    <td align="center"><b>#</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="dt in detail_peralatans ">
                                                    <td align="center" width="5%">
                                                        @{{$index+1}}
                                                    </td>
                                                    <td align="center" width="20%">
                                                        @{{dt.nama}} (@{{dt.jumlah}})
                                                    </td>
                                                    <td align="center" width="25%">
                                                        <input class="form-control" type="number" ng-model="jumlah[$index]" onClick="this.select();"><br>
                                                        <input class="form-control" type="text" ng-model="keterangan[$index]" placeholder="Keterangan">
                                                    </td>

                                                    <td align="center" width="15%">
                                                        <a ng-click="addPengembalian(dt, $index)" class="btn btn-success btn-icon-only  btn-sm btn-air"><i style="color: white;" class="fa fa-check"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </center>



                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="note note-green">
                        <div class="note-content">
                            <h4><b>Daftar Pengembalian</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">

                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <th class="width-60">No</th>
                                                    <th>Nama</th>
                                                    <th>Rusak</th>
                                                    <th>Ket</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="dt in kembalians ">
                                                    <td align="center">
                                                        @{{$index+1}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.nama}} (@{{dt.jumlah}})
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.rusak}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.ket}}
                                                    </td>
                                                    <td align="center">
                                                        <a ng-click="removeItem(dt,$index)" class="btn btn-danger btn-icon-only  btn-sm btn-air"><i style="color: white;" class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
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
<script src="{{asset('assets/js/pinjam_kembali.js')}}"></script>
@endsection

@section('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection