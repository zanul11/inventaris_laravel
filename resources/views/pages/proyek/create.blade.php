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
        <li class="breadcrumb-item"><a>Setup</a></li>
        <li class="breadcrumb-item"><a href="{{url('/proyek')}}">PROYEK</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH</span> DATA PROYEK</h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/proyek':'/proyek/'.$proyek->id}}">
            @csrf
            @if($action!='add')
            @method('PUT')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="control-label">Nama</label>
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control" style="display: block;" placeholder="Nama Proyek" value="{{($action!='add')?$proyek->nama:(old('nama', ''))}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Penanggung Jawab</label>
                            <div class="input-group">
                                <input type="text" name="pj" class="form-control" style="display: block;" placeholder="Penanggung Jawab" value="{{($action!='add')?$proyek->pj:(old('pj', ''))}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Lokasi Proyek</label>
                            <div class="input-group">
                                <input type="text" name="lokasi" class="form-control" style="display: block;" placeholder="Lokasi Proyek" value="{{($action!='add')?$proyek->lokasi:(old('lokasi', ''))}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Keterangan</label>
                            <div class="input-group">
                                <textarea type="number" name="ket" class="form-control" style="display: block;" required>{{($action!='add')?$proyek->ket:(old('ket', ''))}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" value="Simpan" class="btn btn-success m-r-3">
            </div>
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
</script>
@endsection