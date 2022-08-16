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
        <li class="breadcrumb-item"><a href="{{url('/pegawai')}}">Pegawai</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH</span> DATA PEGAWAI</h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/pegawai':'/pegawai/'.$pegawai->id}}">
            @csrf
            @if($action!='add')
            @method('PUT')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">JABATAN</label>
                            <select class="select2 show-tick form-control required" name="jabatan_id" data-style="btn-inverse" required>
                                <option value="">Pilih Jabatan</option>
                                @foreach($jabatan as $dt)
                                <option value="{{$dt->id}}" {{($action!='add')?(($pegawai->jabatan_id==$dt->id)?'selected':''):((old('jabatan_id')==$dt->id)?'selected':'')}}>{{$dt->jabatan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Nama</label>
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control" style="display: block;" placeholder="Nama" value="{{($action!='add')?$pegawai->nama:(old('nama', ''))}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="control-label">Alamat</label>
                            <div class="input-group">
                                <input type="text" name="alamat" class="form-control" style="display: block;" placeholder="Alamat" value="{{($action!='add')?$pegawai->alamat:(old('alamat', ''))}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">No Identitas</label>
                            <div class="input-group">
                                <input type="text" name="no_identitas" class="form-control" style="display: block;" placeholder="No Identitas" value="{{($action!='add')?$pegawai->no_identitas:(old('no_identitas', ''))}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">No Hp</label>
                            <div class="input-group">
                                <input type="number" name="no_hp" class="form-control" style="display: block;" placeholder="No Hp" value="{{($action!='add')?$pegawai->no_hp:(old('no_hp', ''))}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">No PIN</label>
                            <div class="input-group">
                                <input type="number" name="pin" class="form-control" style="display: block;" placeholder="No PIN" value="{{($action!='add')?$pegawai->pin:(old('pin', ''))}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Absen atau Tidak?</label>
                            <div class="input-group">
                                <select class="selectpicker show-tick form-control required" name="is_absen" data-style="btn-warning" required>
                                    <option value="1" {{ old('is_absen',$pegawai->is_absen??'')=='Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ old('is_absen',$pegawai->is_absen??'')=='Tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
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