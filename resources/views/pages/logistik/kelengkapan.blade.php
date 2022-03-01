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
        <li class="breadcrumb-item"><a href="">Manajemen Logistik</a></li>
        <li class="breadcrumb-item"><a href="/logistik">Data Logistik</a></li>
        <li class="breadcrumb-item"><a>Kelengkapan Logistik</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">KELENGKAPAN</span> LOGISTIK</h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Kelengkapan</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/logistik':'/logistik/'.$logistik->id}}">
            @csrf
            @if (request()->routeIs('logistik.create'))
            @method('post')
            @else
            @method('put')
            @endif
            <div class="panel-body">
                <div class="row width-full">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">KODE</label>
                            <div class="input-group">
                                <input type="text" name="kode" class="form-control" style="display: block;" value="{{($action!='add')?$logistik->kode:$kode}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Nama Logistik</label>
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control" autofocus style="display: block;" value="{{ old('nama',$logistik->nama??'') }}" placeholder="Nama Logistik..." required {{($action!='add')?'disabled':''}}>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">ADA KELENGKAPAN?</label>
                            <select class="select2 show-tick form-control required" name="kelengkapan" data-style="btn-inverse" onchange="changeKelengkapan(this.value)" required {{($action!='add')?'disabled':''}}>
                                <option value="0" {{ old('kelengkapan',$logistik->is_kelengkapan??'')==0?'selected':''}}>TIDAK ADA</option>
                                <option value="1" {{ old('kelengkapan',$logistik->is_kelengkapan??'')==1?'selected':''}}>ADA</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <!-- start panel -->
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4 class="panel-title">Data Kelengkapan</h4>
                </div>
                <form action="/kelengkapan" method="post" data-parsley-validate="true">
                    @csrf
                    @method('post')
                    <div class="panel-body">
                        <input type="hidden" name="id_logistik" value="{{ $logistik->id }}">
                        <div class="row width-full">
                            <div class="col-lg-12" id="spek_form">
                                <div class="form-group">
                                    <label class="control-label">Spesifikasi</label>
                                    <div class="input-group">
                                        <input type="text" name="spesifikasi" class="form-control" id="spek_id" autofocus style="display: block;" placeholder="Spesifikasi Kelengkapan..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="merk_form">
                                <div class="form-group">
                                    <label class="control-label">Merk</label>
                                    <div class="input-group">
                                        <input type="text" name="merk" class="form-control" id="merk_id" autofocus style="display: block;" placeholder="Merk Kelengkapan..." required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="lokasi_form">
                                <label class="control-label">LOKASI</label>
                                <select class="select2 show-tick form-control required" id="lokasi_id" name="lokasi" data-style="btn-inverse" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach($lokasi as $dt)
                                    <option value="{{$dt->id}}">{{$dt->lokasi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6" id="satuan_form">
                                <label class="control-label">SATUAN</label>
                                <select class="select2 show-tick form-control required" id="satuan_id" name="satuan" data-style="btn-inverse" required>
                                    <option value="">Pilih Satuan</option>
                                    @foreach($satuan as $dt)
                                    <option value="{{$dt->id}}">{{$dt->satuan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3" id="stok_form">
                                <label class="control-label">Stok</label>
                                <div class="input-group">
                                    <input type="number" name="stok" class="form-control" value="0" id="stok_id" style="display: block;" required>
                                </div>
                            </div>

                            <div class="col-md-3" id="rusak_form">
                                <label class="control-label">Rusak</label>
                                <div class="input-group">
                                    <input type="number" name="rusak" class="form-control" id="rusak_id" style="display: block;" value="0" required>
                                </div>
                            </div>



                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Tambah Kelengkapan</button>
                    </div>
                </form>
            </div>
            <!-- end panel -->
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <!-- start panel -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">Kelengkapan</h4>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-bordered">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="width: 5%; text-align: center;" rowspan="2">#</th>
                                    <th rowspan="2">Spek/Merk</th>
                                    <th rowspan="2">Stok</th>
                                    <th colspan="2">Kondisi</th>
                                    <th rowspan="2">Lokasi</th>
                                    <th style="width: 5%" rowspan="2">Delete</th>
                                </tr>
                                <tr>
                                    <th>Baik</th>
                                    <th>Rusak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kelengkapan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->spesifikasi }}/{{ $item->merk }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->stok-$item->rusak }}</td>
                                    <td>{{ $item->rusak }}</td>
                                    <td>{{ $item->lokasi->lokasi }}</td>
                                    <td class="text-center"><a class="f-s-16 text-danger" onclick="btnDelete('{{$item->id}}')">
                                            <i class="fa fa-minus-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Data Avaliable</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- end panel -->
        </div>
    </div>
</div>
</div>
@endsection

@section('plugins_scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('page_scripts')
<script>
    function btnDelete(kode) {
        Swal.fire({
            title: "Yakin?",
            text: "Anda akan menghapus data ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yas, Hapus!"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: "/kelengkapan/" + kode,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire(
                            "Deleted!",
                            "Data berhasil dihapus",
                            "success"
                        ).then(result => {
                            location.reload();
                        });
                        // You will get response from your PHP page (what you echo or print)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });
    }
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection