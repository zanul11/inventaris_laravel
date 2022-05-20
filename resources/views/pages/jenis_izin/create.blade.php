@extends('layouts.master')

@section('title', 'Dashboard')

@section('plugins_styles')

@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Data Master</a></li>
        <li class="breadcrumb-item"><a href="{{url('/jenis-izin')}}">Pegawai</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH DATA</span> JENIS IZIN</h1>


    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/jenis-izin':'/jenis-izin/'.$jenisIzin->id}}">
            @csrf
            @if($action!='add')
            @method('PUT')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Jenis Izin</label>
                            <div class="input-group">
                                <input type="text" class="form-control" style="display: block;" value="{{ old('jenis',$pegawai->jenis??'') }}" name="jenis" placeholder="Jenis Izin..." required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Hitung Masuk</label>
                            <div class="input-group">
                                <select class="selectpicker show-tick form-control required" name="status" data-style="btn-warning" required>
                                    <option value="Tidak" {{ old('jenis',$jenisIzin->jenis??'')=='Tidak' ? 'selected' : '' }}>Tidak</option>
                                    <option value="Ya" {{ old('jenis',$jenisIzin->jenis??'')=='Ya' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" value="Simpan" class="btn btn-success m-r-3">
                <a wire:click="batal" class="btn btn-danger">Batal</a>
            </div>
    </div>

    </form>
</div>
</div>
@endsection

@section('plugins_scripts')

@endsection

@section('page_scripts')
<script>

</script>
@endsection