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
        <li class="breadcrumb-item"><a>Keuangan</a></li>
        <li class="breadcrumb-item"><a href="{{url('/pemasukan')}}">Pemasukan</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH DATA</span> PEMASUKAN</h1>


    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/pemasukan':'/pemasukan/'.$pemasukan->id}}">
            @csrf
            @if($action!='add')
            @method('PUT')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Jenis Pemasukan</label>
                            <select class="select2 show-tick form-control required" name="jenis_akunting_id" data-style="btn-primary" required>
                                <option value="">Pilih Jenis Pemasukan</option>
                                @foreach($jenis as $dt)
                                <option value="{{$dt->id}}" {{(old('jenis_akunting_id',$pemasukan->jenis_akunting_id??'')==$dt->id)?'selected':''}}>{{$dt->jenis}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Nama Pemasukan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" style="display: block;" value="{{ old('nama',$pemasukan->nama??'') }}" name="nama" placeholder="Nama Pemasukan..." required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Jumlah</label>
                            <div class="input-group">
                                <input type="number" class="form-control" style="display: block;" value="{{ old('jumlah',$pemasukan->jumlah??'') }}" name="jumlah" placeholder="Jumlah/Nilai Pemasukan..." required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Keterangan</label>
                            <div class="input-group">
                                <textarea class="form-control" style="display: block;" value="" name="ket">{{ old('ket',$pemasukan->ket??'') }}</textarea>
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
    $(function() {
        $('.select2').select2();

    });
</script>
@endsection