@extends('layouts.master')

@section('title', 'Pembayaran Rekening Bantuan')
@section('plugins_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content" ng-app="app" ng-controller="PembayaranController">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Bantuan</a></li>
        <li class="breadcrumb-item"><a>Pembayaran Rekening</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Pembayaran Rekening<small> Bantuan Pelanggan</small></h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Pembayaran</h4>

        </div>
        <!-- <form method="POST" action=""> -->
        <div class="panel-body">
            <div class="row width-full">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Pilih Pelanggan</label>
                        <div class="form-group">
                            <select data-width="100%" ng-change="changePelanggan()" class="select2 form-control form-control-solid" ng-model="selectedPelanggan" ng-options="pelanggan.pelanggan_ID + ' - '  + pelanggan.pelanggan_nama+ ' - '  + pelanggan.detail.pelanggan_alamat  for pelanggan in pelanggans">
                                <option value="">Pilih Pelanggan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Tanggal CheckList</label>
                        <div class="input-group">
                            <input type="text" class="form-control" style="display: block;" value="{{date('d-m-Y')}}" disabled>
                        </div>

                    </div>

                    <label class="control-label">Saldo</label>
                    <div class="note note-green">
                        <div class="note-content">
                            <div class="height-10">
                                <div class="col-sm-12" style="font-size: 20px;">
                                    @{{saldo | currency:''}}
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>


                    <label class="control-label">Total Semua Tagihan</label>
                    <div class="note note-danger">
                        <div class="note-content">
                            <div class="height-10">
                                <div class="col-sm-12" style="font-size: 20px;">
                                    @{{totalTagihan | currency:''}}
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                    <label class="control-label">Total Yang Akan Dibayarkan</label>
                    <div class="note note-primary">
                        <div class="note-content">
                            <div class="height-10">
                                <div class="col-sm-12" style="font-size: 20px;">
                                    @{{totalTagihanTerbayarkan | currency:''}}
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>


                </div>
                <div class="col-md-8">
                    <div class="note note-default">
                        <div class="note-content">
                            <h4><b>Rekening Pelanggan</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">

                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <th>OK</th>
                                                    <th>Bln/Thn</th>
                                                    <th>Total(Rp)</th>
                                                    <th>Tagihan(Rp)</th>
                                                    <th>By.Adm(Rp)</th>
                                                    <th>By.Retrib(Rp)</th>
                                                    <th>By.Materai(Rp)</th>
                                                    <th>By.JsLingk(Rp)</th>
                                                    <th>By.Denda(Rp)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="dt in tagihans ">
                                                    <td align="center">
                                                        <input type="checkbox" value="dt" ng-checked="selection.indexOf(dt) > -1" ng-click="toggleSelection(dt)">
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.bulan}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.total | currency:''}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.tagihan | currency:''}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.admin | currency:''}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.retrib | currency:''}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.materai | currency:''}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.lingkungan | currency:''}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.denda | currency:''}}
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

                    <div class="note note-success">
                        <div class="note-content">
                            <div class="height-10">
                                <div class="col-sm-12">
                                    Lembar Rekening : @{{lembarTagihan}}
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <input type="submit" ng-click="submit()" value="Simpan" class="btn btn-success m-r-3">
                    <a class="btn btn-danger">Batal</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('plugins_scripts')

<script src=" https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
</script>
<script src="{{asset('assets/js/pembayaran.js')}}"></script>
@endsection


@section('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection