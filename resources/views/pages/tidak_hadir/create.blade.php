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
        <li class="breadcrumb-item"><a>Absen</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH DATA</span> KEHADIRAN</h1>


    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Form</h4>
        </div>
        <form action="/tidak_hadir" method="post" data-parsley-validate="true" data-parsley-errors-messages-disabled="">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Pegawai</label>
                    <select class="select2 show-tick form-control required" name="pegawai_id" data-style="btn-primary" required>
                        <option value="">Pilih Pegawai</option>
                        @foreach($pegawai as $dt)
                        <option value="{{$dt->id}}">{{$dt->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group ">
                    <label class="control-label">Waktu</label>
                    <div class="input-group date">
                        <input type="text" class="form-control" name="waktu" id="tgl_libur" required>
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Jenis Izin</label>
                    <select class="select2 show-tick form-control required" name="jenis" data-style="btn-primary" required>
                        @foreach($jenis as $dt)
                        <option value="{{$dt->id}}">{{$dt->jenis}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Keterangan</label>
                    <input class="form-control" type="text" name="ket" required="" data-parsley-maxlength="250" autocomplete="off">
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" value="Simpan" class="btn btn-sm btn-success">
                <a href="/kehadiran" class="btn btn-sm btn-danger">Batal</a>
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
        var endDate = new Date();
        var firstDate = new Date();
        $('#tgl_libur').val(("0" + firstDate.getDate()).slice(-2) + "-" + ("0" + (firstDate.getMonth() + 1)).slice(-2) + "-" +
            firstDate.getFullYear() + ' s/d ' + ("0" + endDate.getDate()).slice(-2) + "-" + ("0" + (endDate.getMonth() + 1)).slice(-2) + "-" +
            endDate.getFullYear());
        $('#tgl_libur').daterangepicker({
            startDate: firstDate, // after open picker you'll see this dates as picked
            endDate: endDate,
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#tgl_libur').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' s/d ' + picker.endDate.format('DD-MM-YYYY'));
            console.log(picker);
        });

        $('#tgl_libur').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        $(document).ready(function() {
            $('.data-table').DataTable({
                pageLength: 10,
                lengthChange: false,
                responsive: true,
            });
        });
    });
</script>
@endsection