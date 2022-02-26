@extends('layouts.master')

@section('title', 'Add Bantuan Pelanggan')

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
        <li class="breadcrumb-item"><a>Bantuan</a></li>
        <li class="breadcrumb-item"><a href="{{url('/pelanggan')}}">Pelanggan</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Pelanggan <small>Tambah Data</small></h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/pelanggan':'/pelanggan/'.$pelanggan->kode}}">
            @csrf
            @if($action=='/pelanggan/'.$pelanggan->id)
            @method('PUT')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">PILIH PELANGGAN</label>
                            <select name="pelanggan_id" id="pelanggan_id" class="form-control select2 @error('pelanggan_id') parsley-error @enderror" data-parsley-required="true" required>
                                <option value="">-- Pilih Calon Pelanggan --</option>
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
    </form>
</div>
</div>
@endsection

@section('plugins_scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('page_scripts')
<script>
    $("#pelanggan_id").select2({
        ajax: {
            url: "{!! route('select2.pelanggan') !!}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                var query = {
                    key: params.term
                }
                return query;
            },
            processResults: function(data) {

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: "[ " + item.pelanggan_ID + " ] " + item.pelanggan_nama + " - " + item.pelanggan_alamat,
                            id: item.pelanggan_ID,
                            nama: item.pelanggan_nama
                        }
                    })
                    // results:data
                };
            },
            cache: true,
        }
    });
</script>
@endsection