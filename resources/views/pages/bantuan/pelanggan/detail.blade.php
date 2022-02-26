@extends('layouts.master')

@section('title', 'Detail Pelanggan')

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
        <li class="breadcrumb-item"><a>Detail Pelanggan</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <div class="panel-body note note-success">
        <div class="row width-full">
            <div class="col-md-12">
                <div class="form-group">
                    <select name="pelanggan_id" id="pelanggan_id" class="form-control select2 @error('pelanggan_id') parsley-error @enderror" data-parsley-required="true" required>
                        <option value="">-- Lihat Data Pelanggan Penerima Bantuan --</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">{{$pelanggan->pelanggan_ID}} - {{$pelanggan->pelanggan_nama}}</h4>

        </div>
        <!-- <form method="POST" action=""> -->
        <div class="panel-body">
            <div class="row width-full">

                <div class="col-md-5">
                    <!-- <div class="form-group">
                        <label class="control-label">PELANGGAN </label>
                        <div class="input-group">
                            <input type="nomor" class="form-control" style="display: block;" value="{{$pelanggan->pelanggan_ID}} - {{$pelanggan->pelanggan_nama}}" disabled>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="control-label">ALAMAT</label>
                        <div class="input-group">
                            <textarea class="form-control" style="display: block;" rows="3" disabled>{{$pelanggan->detail->pelanggan_alamat}}</textarea>
                        </div>

                    </div>

                    @php
                    $tmp = 0;
                    @endphp


                    @foreach($pelanggan->pembayaran as $dt)
                    @php
                    $tmp+=($dt->total);
                    @endphp

                    @endforeach
                    <label class="control-label">Saldo</label>
                    <div class="note note-green">
                        <div class="note-content">
                            <div class="height-10">
                                <div class="col-sm-12" style="font-size: 20px;">
                                    {{number_format($pelanggan->saldo-$tmp)}}
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>


                    <div class="note note-danger">
                        <div class="note-content">
                            <h4><b>Rekening Pelanggan</b></h4>
                            <hr>
                            <div class="height-200" style="display: block; position: relative; overflow: auto;">

                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>M3</th>
                                                    <th>Stand</th>
                                                    <th>Total</th>
                                                    <th>Harga Air</th>
                                                    <!-- <th>Administrasi</th> -->
                                                    <!-- <th>Retrib</th> -->
                                                    <!-- <th>Materai</th> -->
                                                    <th>Denda</th>

                                                    <!-- <th>Status WM</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $total = 0;
                                                @endphp

                                                @if(count($tagihan)>0)
                                                @foreach($tagihan as $dt)

                                                <tr>
                                                    <th>{{$dt->bulan}}</th>
                                                    <th>{{$dt->m3}}</th>
                                                    <th>{{$dt->stand}}</th>
                                                    <th>{{number_format($dt->denda+$dt->admin+$dt->retrib+$dt->materai+$dt->harga_air)}}</th>
                                                    <th>{{number_format($dt->harga_air)}}</th>
                                                    <!-- <th>{{number_format($dt->admin)}}</th> -->
                                                    <!-- <th>{{number_format($dt->retrib)}}</th> -->
                                                    <!-- <th>{{number_format($dt->materai)}}</th> -->
                                                    <th>{{number_format($dt->denda)}}</th>

                                                    <!-- <th>{{$dt->ket}}</th> -->
                                                </tr>
                                                @php
                                                $total+=($dt->denda+$dt->admin+$dt->retrib+$dt->materai+$dt->harga_air);
                                                @endphp

                                                @endforeach
                                                @else
                                                <tr>
                                                    <th colspan="10" align="center">Tidak Ada Tunggakan Rekening</th>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </center>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="note note-danger">
                        <div class="note-content">
                            <div>
                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th colspan="5">Rekening Tunggakan</th>
                                                    <th>:</th>
                                                    <th>{{count($tagihan)}}</th>
                                                    <th colspan="2">Lembar/Rp.</th>
                                                    <th>:</th>
                                                    <th><strong>{{number_format($total)}}</strong></th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </center>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="note note-primary">
                        <div class="note-content">
                            <h4><b>Rekening Pelanggan Terbayarakan</b></h4>
                            <hr>
                            <div class="height-300" style="display: block; position: relative; overflow: auto;">

                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover" style="background-color: white;">
                                            <thead>
                                                <tr>
                                                    <th>Bulan</th>
                                                    <th>M3</th>
                                                    <th>Stand</th>
                                                    <th>Total</th>
                                                    <th>Harga Air</th>
                                                    <th>Administrasi</th>
                                                    <th>Retrib</th>
                                                    <th>Materai</th>
                                                    <th>Denda</th>
                                                    <!-- <th>Status WM</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $totalPembayaran = 0;
                                                @endphp

                                                @if(count($pelanggan->pembayaran)>0)
                                                @foreach($pelanggan->pembayaran as $dt)

                                                <tr>
                                                    <th>{{$dt->cBlth}}</th>
                                                    <th>{{$dt->m3}}</th>
                                                    <th>{{$dt->stand}}</th>
                                                    <th>{{number_format($dt->total)}}</th>
                                                    <th>{{number_format($dt->tagihan)}}</th>
                                                    <th>{{number_format($dt->admin)}}</th>
                                                    <th>{{number_format($dt->retrib)}}</th>
                                                    <th>{{number_format($dt->materai)}}</th>
                                                    <th>{{number_format($dt->denda)}}</th>

                                                    <!-- <th>{{$dt->ket}}</th> -->
                                                </tr>
                                                @php
                                                $totalPembayaran+=($dt->total);
                                                @endphp

                                                @endforeach
                                                @else
                                                <tr>
                                                    <th colspan="10" align="center">Tidak Ada Pembayaran Rekening</th>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </center>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="note note-default">
                        <div class="note-content">
                            <div>
                                <div class="col-sm-12">
                                    <center>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th colspan="5">Total Pembayaran</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th colspan="2"></th>
                                                    <th>:</th>
                                                    <th><strong>{{number_format($totalPembayaran)}}</strong></th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </center>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('plugins_scripts')

<script src=" https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
</script>

@endsection


@section('page_scripts')
<script>
    $("#pelanggan_id").select2({
        ajax: {
            url: "{!! route('select2.bantuan') !!}",
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
                            text: "[ " + item.pelanggan_ID + " ] " + item.pelanggan_nama + " - " + item.detail.pelanggan_alamat,
                            id: item.id,
                            nama: item.pelanggan_nama
                        }
                    })
                    // results:data
                };
            },
            cache: true,
        }
    });


    $("#pelanggan_id").on('change', function(e) {
        window.location.href = '/pelanggan/' + $('select[name=pelanggan_id]').val() + '/edit';
        // alert($('select[name=pelanggan_id]').val());
    });
</script>
@endsection