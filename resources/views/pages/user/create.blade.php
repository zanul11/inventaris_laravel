@extends('layouts.master')

@section('title', 'Dashboard')

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
        <li class="breadcrumb-item"><a href="{{url('/user')}}">User</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">User <small>Tambah Data</small></h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/user':'/user/'.$user->id}}">
            @csrf
            @if($action=='/user/'.$user->id)
            @method('PUT')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Nama</label>
                            <input type="text" class="form-control" style="display: block;" value="{{($action!='add')?$user->nama:''}}" name="nama" placeholder="Nama..." required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Username (tanpa spasi)</label>
                            <input type="text" class="form-control" style="display: block;" value="{{($action!='add')?$user->user:''}}" name="user" placeholder="Username..." required {{($action!='add')?'readonly':''}}>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Kata Sandi</label>
                            <div class="input-group">
                                <input type="password" class="form-control" style="display: block;" name="password" placeholder="Password user..." {{($action!='add')?'':'required'}}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="note note-primary">
                            <div class="note-content">
                                <h4><b>Hak Akses</b></h4>
                                <hr>
                                <div class="height-200" style="display: block; position: relative; overflow: auto;">

                                    <div class="col-sm-10">
                                        <div class="row">
                                            @if($action=='add')
                                            @foreach($menus as $parent)
                                            @if($parent->status==1 && $parent->kd_menu!='mn1')
                                            <div class="col-4">
                                                <label for="{{$parent->nm_menu}}"><b style="font-size: 14px;">{{$parent->nm_menu}}</b>
                                                    @foreach($childs as $child)
                                                    @if ($child->status==0 AND $child->kd_parent==$parent->kd_menu)
                                                    <div class="hakakses checkbox checkbox-css">
                                                        <input type="checkbox" class="administrator" name="akses[]" id="{{$child->nm_menu}}" value="{{$child->kd_menu}}">
                                                        <label for="{{$child->nm_menu}}">{{$child->nm_menu}}
                                                        </label>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </label>

                                            </div>
                                            @endif
                                            @endforeach
                                            @elseif($action=='/user/' . $user->id)
                                            @foreach($menus as $parent)
                                            @if($parent->status==1)
                                            <div class="col-4">
                                                <label for="{{$parent->nm_menu}}"><b style="font-size: 14px;">{{$parent->nm_menu}}</b>
                                                    @foreach($childs as $child)
                                                    @if ($child->status==0 AND $child->kd_parent==$parent->kd_menu)
                                                    @php
                                                    $cek = '';
                                                    @endphp
                                                    <div class="hakakses checkbox checkbox-css">
                                                        @if(count($menuaktifs)>0)
                                                        @foreach($menuaktifs as $aktif)
                                                        @if ( $child->kd_menu==$aktif->kd_menu)
                                                        @php
                                                        $cek = 'checked';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        <input type="checkbox" class="administrator" name="akses[]" id="{{$child->nm_menu}}" value="{{$child->kd_menu}}" {{$cek}}>
                                                        <label for="{{$child->nm_menu}}">{{$child->nm_menu}}
                                                        </label>
                                                        @else
                                                        <input type="checkbox" class="administrator" name="akses[]" id="{{$child->nm_menu}}" value="{{$child->kd_menu}}">
                                                        <label for="{{$child->nm_menu}}">{{$child->nm_menu}}
                                                        </label>
                                                        @endif

                                                        <!-- <label class="checkbox checkbox-primary">
                                                <span class="input-span"></span>{{$child->nm_menu}}</label> -->
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </label>


                                            </div>
                                            @endif
                                            @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <br>
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
</script>
@endsection