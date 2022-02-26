@extends('layouts.master')

@section('title', 'Kwitansi Pembayaran')

@section('plugins_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content" ng-app="app" ng-controller="BarangKeluarController">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Kas Kecil</a></li>
        <li class="breadcrumb-item"><a href="{{url('/kwitansi')}}">Kwitansi Pembayaran</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Kwitansi Pembayaran <small>Tambah Data</small></h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data Kwitansi Pembayaran</h4>

        </div>
        <!-- <form method="POST" action=""> -->
        <div class="panel-body">
            <div class="row width-full">
                <div class="col-md-3">
                    <!-- <div class="form-group">
                        <label class="control-label">NOMOR</label>
                        <div class="input-group">
                            <input type="nomor" class="form-control" style="display: block;" value="{{$kode}}" name="password" disabled>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="control-label">PJ</label>
                        <select data-width="100%" class="select2 form-control form-control-solid" ng-change="pilihPegawai()" ng-model="selectedPegawai" ng-options="pegawai.nip + ' - '  + pegawai.nm_pegawai  for pegawai in pegawais">
                            <option value="">Pilih Penanggung Jawab</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jenis</label>
                        <select data-width="100%" class="select2 form-control form-control-solid" ng-change="pilihJenis()" ng-model="selectedJenis" ng-options="jenis.jenis  for jenis in jenis_kwitansi">
                            <option value="">Pilih Jenis Kwitansi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal</label>
                        <div class="input-group">
                            <input class="form-control" ng-model="tgl" type="date">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label">BIDANG</label>
                        <select data-width="100%" class="select2 form-control form-control-solid" ng-model="selectedBidang" ng-options="bidang.nm_bagian  for bidang in bidangs">
                            <option value="">Pilih Bidang</option>
                        </select>

                    </div> -->
                    <label class="control-label">TOTAL JENIS KWITANSI</label>
                    <div class="note note-green">
                        <div class="note-content">
                            <div class="height-10">
                                <div class="col-sm-12" style="font-size: 20px;">
                                    @{{jumlahJenisKwitansi | currency:'Rp ':0}}
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="note note-default">
                        <div class="note-content">
                            <h4><b>Input Kwitansi</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">
                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!-- <label class="control-label">Untuk pembelian?</label> -->
                                            <div class="input-group">
                                                <textarea type="text" class="form-control" placeholder="Untuk pembelian?" style="display: block;" ng-model="ket" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Harga</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" style="display: block;" ng-model="harga" onClick="this.select();">
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
                            <h4><b>Daftar Kwitansi</b></h4>
                            <h4><b>Jumlah Harga : @{{jumlahHarga | currency:'Rp. ':0}}</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">

                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <th class="width-60">No</th>
                                                    <th>Ket</th>
                                                    <th>Harga</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="dt in detail_kwitansi ">
                                                    <td align="center">
                                                        @{{$index+1}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.ket}}
                                                    </td>
                                                    <td align="center">
                                                        @{{dt.harga | currency:'':0}}
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
        <button ng-click="submitData()" class="btn btn-success m-r-3">Simpan</button>
    </div>
    <!-- </form> -->
</div>
</div>
@endsection

@section('plugins_scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/js/kwitansi.js')}}"></script>
@endsection

@section('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection