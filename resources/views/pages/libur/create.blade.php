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
        <li class="breadcrumb-item"><a href="{{url('/libur')}}">Tanggal Libur</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH DATA</span> TANGGAL LIBUR</h1>


    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/libur':'/libur/'.$libur->id}}">
            @csrf
            @if($action!='add')
            @method('PUT')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tanggal</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <input type="text" name="tgl_libur" autocomplete="off" id="tgl_libur" class="form-control" value="" placeholder="Pilih Tanggal" required />
                                    <span class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Keterangan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" style="display: block;" value="{{ old('ket',$libur->ket??'') }}" name="ket" placeholder="Keterangan..." required>
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

        $('#tgl_libur').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#tgl_libur').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' s/d ' + picker.endDate.format('DD-MM-YYYY'));
        });

        $('#tgl_libur').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    });
</script>
@endsection