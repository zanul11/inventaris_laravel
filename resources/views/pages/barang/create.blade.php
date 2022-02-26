@extends('layouts.master')

@section('title', 'Barang')

@section('plugins_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Data Master</a></li>
        <li class="breadcrumb-item"><a href="{{url('/barang')}}">Barang</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Barang <small>Tambah Data</small></h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/barang':'/barang/'.$barang->kode}}">
            @csrf
            @if($action=='/barang/'.$barang->id)
            @method('PUT')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">KODE</label>
                            <div class="input-group">
                                <input type="text" name="kode" class="form-control" style="display: block;" value="{{($action!='add')?$barang->kode:$kode}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">SATUAN</label>
                            <select class="select2 show-tick form-control required" name="satuan" data-style="btn-inverse" required>
                                <option value="">Pilih Satuan</option>
                                @foreach($satuan as $dt)
                                <option value="{{$dt->id}}" {{($action=='/barang/'.$barang->id)?(($barang->satuan==$dt->id)?'selected':''):((old('satuan')==$dt->id)?'selected':'')}}>{{$dt->satuan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Jenis Barang</label>
                            <select class="select2 show-tick form-control required" name="jenis" data-style="btn-inverse" required>
                                <option value="">Pilih Jenis Barang</option>
                                @foreach($jenis as $dt)
                                <option value="{{$dt->id}}" {{($action=='/barang/'.$barang->id)?(($barang->jenis==$dt->id)?'selected':''):((old('jenis')==$dt->id)?'selected':'')}}> {{$dt->jenis}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Harga</label>
                            <div class="input-group">
                                <input type="text" id="rupiah" name="harga" class="form-control" style="display: block;" placeholder="Harga beli..." value="{{($action!='add')?$barang->harga:(old('harga', ''))}}" required>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Nama Barang</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" class="form-control" autofocus style="display: block;" value="{{($action!='add')?$barang->nama:''}}" placeholder="Nama barang..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Merk Barang</label>
                                    <div class="input-group">
                                        <input type="text" name="merk" class="form-control" autofocus style="display: block;" value="{{($action!='add')?$barang->merk:(old('merk', ''))}}" placeholder="Merk barang..." required>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row input-group">
                            <div class="col-md-3">
                                <label class="control-label">Stok Awal</label>
                                <div class="input-group">
                                    <input type="number" name="stok" class="form-control" style="display: block;" value="{{($action!='add')?$saldo_awal:(old('stok', 0))}}" placeholder="Nama barang..." required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Minimum Stok</label>
                                <div class="input-group">
                                    <input type="number" name="minimum" class="form-control" style="display: block;" value="{{($action!='add')?$barang->minimum:(old('minimum', 0))}}" placeholder="Nama barang..." required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Spesifikasi/Type</label>
                                <div class="input-group">
                                    <input type="text" name="ukuran" class="form-control" style="display: block;" value="{{($action!='add')?$barang->ukuran:(old('ukuran', ''))}}" placeholder="Spesifikasi/Type barang...">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    <div class="panel-footer">
        <input type="submit" value="Simpan" class="btn btn-success m-r-3">
        <a wire:click="batal" class="btn btn-danger">Batal</a>
    </div>
    </form>
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

    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>
@endsection