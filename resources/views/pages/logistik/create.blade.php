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
        <li class="breadcrumb-item"><a href="">Manajemen Logistik</a></li>
        <li class="breadcrumb-item"><a href="/logistik">Data Logistik</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH DATA</span> LOGISTIK</h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/logistik':'/logistik/'.$logistik->id}}">
            @csrf
            @if (request()->routeIs('logistik.create'))
            @method('post')
            @else
            @method('put')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">KODE</label>
                            <div class="input-group">
                                <input type="text" name="kode" class="form-control" style="display: block;" value="{{($action!='add')?$logistik->kode:$kode}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Nama Logistik</label>
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control" autofocus style="display: block;" value="{{ old('nama',$logistik->nama??'') }}" placeholder="Nama Logistik..." required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">ADA KELENGKAPAN?</label>
                            <select class="select2 show-tick form-control required" name="kelengkapan" data-style="btn-inverse" onchange="changeKelengkapan(this.value)" required {{($action!='add')?'disabled':''}}>
                                <option value="0" {{ old('kelengkapan',$logistik->is_kelengkapan??'')==0?'selected':''}}>TIDAK ADA</option>
                                <option value="1" {{ old('kelengkapan',$logistik->is_kelengkapan??'')==1?'selected':''}}>ADA</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if($action!='add')
                <input type="hidden" name="kelengkapan_edit" value="{{ old('kelengkapan',$logistik->is_kelengkapan??'0') }}">
                @endif
                <div class="row width-full">
                    <div class="col-md-2" id="satuan_form">
                        <label class="control-label">SATUAN</label>
                        <select class="select2 show-tick form-control required" id="satuan_id" name="satuan" data-style="btn-inverse" required>
                            <option value="">Pilih Satuan</option>
                            @foreach($satuan as $dt)
                            <option value="{{$dt->id}}" {{ old('satuan',$logistik->kelengkapan->satuan->id??'')==$dt->id?'selected':''}}>{{$dt->satuan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2" id="stok_form">
                        <label class="control-label">Stok</label>
                        <div class="input-group">
                            <input type="number" name="stok" class="form-control" id="stok_id" style="display: block;" value="{{ old('stok',$logistik->kelengkapan->stok??'0') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-2" id="spek_form">
                        <div class="form-group">
                            <label class="control-label">Spesifikasi</label>
                            <div class="input-group">
                                <input type="text" name="spesifikasi" class="form-control" id="spek_id" autofocus style="display: block;" value="{{ old('spesifikasi',$logistik->kelengkapan->spesifikasi??'') }}" placeholder="Spesifikasi Logistik..." required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2" id="merk_form">
                        <div class="form-group">
                            <label class="control-label">Merk</label>
                            <div class="input-group">
                                <input type="text" name="merk" class="form-control" id="merk_id" autofocus style="display: block;" value="{{ old('merk',$logistik->kelengkapan->merk??'') }}" placeholder="Merk Logistik..." required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1" id="rusak_form">
                        <label class="control-label">Rusak</label>
                        <div class="input-group">
                            <input type="number" name="rusak" class="form-control" id="rusak_id" style="display: block;" value="{{ old('stok',$logistik->kelengkapan->rusak??'0') }}" required>
                        </div>
                    </div>
                    <div class="col-md-3" id="lokasi_form">
                        <label class="control-label">LOKASI</label>
                        <select class="select2 show-tick form-control required" id="lokasi_id" name="lokasi" data-style="btn-inverse" required>
                            <option value="">Pilih Lokasi</option>
                            @foreach($lokasi as $dt)
                            <option value="{{$dt->id}}" {{ old('lokasi',$logistik->kelengkapan->lokasi->id??'')==$dt->id?'selected':''}}>{{$dt->lokasi}}</option>
                            @endforeach
                        </select>
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

    function changeKelengkapan(value) {
        if (value == 0) {
            document.getElementById('satuan_form').style.display = 'block';
            document.getElementById('satuan_id').style.display = 'block';
            document.getElementById('stok_form').style.display = 'block';
            document.getElementById('spek_form').style.display = 'block';
            document.getElementById('merk_form').style.display = 'block';
            document.getElementById('rusak_form').style.display = 'block';
            document.getElementById('lokasi_form').style.display = 'block';
            document.getElementById('satuan_id').required = true;
            document.getElementById('stok_id').required = true;
            document.getElementById('spek_id').required = true;
            document.getElementById('merk_id').required = true;
            document.getElementById('rusak_id').required = true;
            document.getElementById('lokasi_id').required = true;
        } else {
            document.getElementById('satuan_form').style.display = 'none';
            document.getElementById('satuan_id').style.display = 'none';
            document.getElementById('stok_form').style.display = 'none';
            document.getElementById('spek_form').style.display = 'none';
            document.getElementById('merk_form').style.display = 'none';
            document.getElementById('rusak_form').style.display = 'none';
            document.getElementById('lokasi_form').style.display = 'none';
            document.getElementById('satuan_id').required = false;
            document.getElementById('stok_id').required = false;
            document.getElementById('spek_id').required = false;
            document.getElementById('merk_id').required = false;
            document.getElementById('rusak_id').required = false;
            document.getElementById('lokasi_id').required = false;
        }

    }

    if ("{{$action}}" == 'edit') {
        changeKelengkapan("{!! $logistik->is_kelengkapan??'0' !!}");
    }
</script>
@endsection