@extends('layouts.master')

@section('title', 'Barang Keluar')

@section('plugins_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content" ng-app="app" ng-controller="BarangKeluarController" ng-init="init('{{$barangKeluar->kode}}','{{$barangKeluar->pj}}','{{$barangKeluar->diterima}}', '{{ csrf_token() }}', '{{date('Y-m-d',strtotime($barangKeluar->tgl))}}')">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Manajemen Barang</a></li>
        <li class="breadcrumb-item"><a href="{{url('/barang_keluar')}}">Barang Keluar</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Barang Keluar <small>Tambah Data</small></h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data Barang Keluar</h4>

        </div>
        <!-- <form method="POST" action=""> -->
        <div class="panel-body">
            <div class="row width-full">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">NOMOR</label>
                        <div class="input-group">
                            <input type="nomor" class="form-control" style="display: block;" ng-model="kode" name="password" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">END USER</label>

                        <input type="text" class="form-control" style="display: block;" ng-model="pj" placeholder="Penanggung jawab">


                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal</label>
                        <div class="input-group">
                            <input class="form-control" ng-model="tgl" type="date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Lokasi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" style="display: block;" ng-model="ket" placeholder="Lokasi...">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="note note-green">
                        <div class="note-content">
                            <h4><b>Input Barang keluar</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">
                                <div class="col-lg-12">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="control-label">Barang</label>


                                            <select data-width="100%" class="select2 form-control form-control-solid" ng-model="selectedBarang" ng-options="barang.nama + ' - '  + barang.merk  for barang in barangs">
                                                <option value="">Pilih Barang</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Jumlah Barang Keluar</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" style="display: block;" ng-model="jum" onClick="this.select();">
                                            </div>
                                        </div>

                                        <center>

                                            <a ng-click="insertTabel()" class="btn btn-warning"><i class="fa fa-plus"></i> Tambah</a>

                                        </center>

                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="note note-primary">
                        <div class="note-content">
                            <h4><b>Daftar Barang Keluar</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">
                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <th class="width-60">No</th>
                                                    <th>Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="dt in detail_barangs ">
                                                    <td align="center">
                                                        @{{$index+1}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.nama}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.jumlah}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.satuan}}
                                                    </td>
                                                    <td align="center">
                                                        <a ng-click="removeItem($index)" class="btn btn-danger btn-icon-only  btn-sm btn-air"><i style="color: white;" class="fa fa-trash"></i></a>
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
    <div class="panel-footer">
        <button ng-click="submitData()" class="btn btn-success m-r-3">Update</button>
    </div>
    <!-- </form> -->
</div>
</div>
@endsection

@section('plugins_scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/js/barang_keluar_edit.js')}}"></script>
@endsection

@section('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection