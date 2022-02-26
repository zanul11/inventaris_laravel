@extends('layouts.master')

@section('title', 'Kas Kecil')

@section('plugins_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content" ng-app="app" ng-controller="BarangKeluarController" ng-init="init('{{$kas->kode}}')">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Kas Kecil</a></li>
        <li class="breadcrumb-item"><a href="{{url('/kas')}}">Kas Kecil</a></li>
        <li class="breadcrumb-item"><a>Edit Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Kas Kecil <small>Edit Data</small></h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Edit Data Kas Kecil</h4>

        </div>
        <!-- <form method="POST" action=""> -->
        <div class="panel-body">
            <div class="row width-full">
                <div class="col-md-6">
                    <div class="note note-green">
                        <div class="note-content">
                            <h4><b>Daftar Kwitansi</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">
                                <center>
                                    <table class="table table-hover" style="background-color: white;">
                                        <thead>
                                            <tr>
                                                <!-- <th class="width-60">No</th> -->
                                                <th>Tgl</th>
                                                <th>Ket</th>
                                                <th>Jumlah</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="dt in kwitansi ">
                                                <!-- <td align="center">
                                                    @{{$index+1}}
                                                </td> -->
                                                <td align="center">
                                                    @{{dt.tgl | date : 'd MMM'}}
                                                </td>
                                                <td>
                                                    <div ng-repeat="data in dt.kwitansis">
                                                        - @{{data.ket}} (@{{data.harga | currency:'':0}})
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    @{{dt.jumlah | currency:'':0}}
                                                </td>
                                                <td align="center">
                                                    <a ng-click="pilihItem(dt, $index)" class="btn btn-primary btn-icon-only  btn-sm btn-air"><i style="color: white;" class="fa fa-check"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </center>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="note note-primary">
                        <div class="note-content">
                            <h5>Daftar Kwitansi Terpilih</h5>
                            <h4><b>KREDIT : @{{jumlahHarga | currency:'Rp. ':0}}</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">
                                <center>
                                    <table class="table table-hover" style="background-color: white;">
                                        <thead>
                                            <tr>
                                                <!-- <th class="width-60">No</th> -->
                                                <th>Tgl</th>
                                                <th>Ket</th>
                                                <th>Jumlah</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="dt in detail_kwitansi ">
                                                <!-- <td align="center">
                                                    @{{$index+1}}
                                                </td> -->
                                                <td align="center">
                                                    @{{dt.tgl | date : 'd MMM'}}
                                                </td>
                                                <td>
                                                    <div ng-repeat="data in dt.kwitansis">
                                                        - @{{data.ket}} (@{{data.harga | currency:'':0}})
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    @{{dt.jumlah | currency:'':0}}
                                                </td>
                                                <td align="center">
                                                    <a ng-click="removeItem(dt, $index)" class="btn btn-danger btn-icon-only  btn-sm btn-air"><i style="color: white;" class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </center>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button ng-click="submitData()" class="btn btn-success m-r-3">UPDATE LAPORAN KAS KECIL</button>
    </div>
    <!-- </form> -->
</div>
</div>
@endsection

@section('plugins_scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/js/kas_edit.js')}}"></script>
@endsection

@section('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection