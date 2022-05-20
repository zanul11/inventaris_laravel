@extends('layouts.master')

@section('title', 'User')

@section('plugins_styles')
@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="">User</a></li>
        <li class="breadcrumb-item"><a href="/jam-kerja">Jam Kerja</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">JAM</span> KERJA</h1>
    <!-- end page-header -->
    <!-- begin row -->

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <form action="/jam-kerja" method="post">
            @csrf
            <div class="panel panel-inverse">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Hari Kerja</th>
                                    <th>Masuk</th>
                                    <th>Pulang</th>
                                    <th>Toleransi Masuk (Menit)</th>
                                    <th>Toleransi Pulang (Menit)</th>
                                </tr>
                            </thead>
                            @php
                            $hari = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            @endphp
                            <tbody>
                                @for($i=0; $i<7; $i++) <tr>
                                    <td><input type="hidden" name="hari[]" value="{{$i}}">{{$hari[$i]}}</td>
                                    <td>
                                        <select class="selectpicker show-tick form-control required" name="status[]" data-style="{{(count($data)>0)?(($data[$i]['status']=='Ya')?'btn-primary':'btn-danger'):'btn-primary'}}" required>
                                            <option value="Ya" {{(count($data)>0)?(($data[$i]['status']=='Ya')?'selected':''):''}}>Ya</option>
                                            <option value="Tidak" {{(count($data)>0)?(($data[$i]['status']=='Tidak')?'selected':''):''}}>Tidak</option>
                                        </select>

                                    </td>
                                    <td>
                                        <div class="input-group date">
                                            <input type="text" class="form-control datetimepicker2" name="masuk[]" value="{{(count($data)>0)?$data[$i]['masuk']:''}}" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group date">
                                            <input type="text" class="form-control datetimepicker2" name="pulang[]" value="{{(count($data)>0)?$data[$i]['pulang']:''}}" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group date">
                                            <input type="number" class="form-control " name="toleransi_masuk[]" value="{{(count($data)>0)?$data[$i]['toleransi_masuk']:'0'}}" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group date">
                                            <input type="number" class="form-control " name="toleransi_pulang[]" value="{{(count($data)>0)?$data[$i]['toleransi_pulang']:'0'}}" required>
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock"></i>
                                            </span>
                                        </div>
                                    </td>
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer form-inline">
                    <input type="submit" value="Simpan" class="btn btn-success">
                </div>
            </div>
        </form>


    </div>

    <!-- end row -->
    <!-- begin row -->
    <!-- end row -->
    <!-- begin row -->
    <!-- end row -->
</div>
@endsection

@section('plugins_scripts')
@endsection

@section('page_scripts')
<script>
    $(function() {
        $(".datetimepicker2").datetimepicker({
            format: "HH:mm"
        })
    });
</script>
@endsection