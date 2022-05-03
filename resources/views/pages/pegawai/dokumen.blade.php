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
            <h4 class="panel-title">Informasi Biodata Pegawai</h4>

        </div>
        <div class="panel-body">
            <div class="row width-full">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">JABATAN</label>
                        <select class="select2 show-tick form-control disabled" name="jabatan_id" data-style="btn-inverse" disabled>
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
                            <input type="text" name="nama" class="form-control" style="display: block;" value="{{($action!='add')?$pegawai->nama:(old('nama', ''))}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                        <div class="input-group">
                            <input type="text" name="alamat" class="form-control" style="display: block;" placeholder="Alamat" value="{{($action!='add')?$pegawai->alamat:(old('alamat', ''))}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">No Identitas</label>
                        <div class="input-group">
                            <input type="text" name="no_identitas" class="form-control" style="display: block;" placeholder="No Identitas" value="{{($action!='add')?$pegawai->no_identitas:(old('no_identitas', ''))}}" disabled>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">No Hp</label>
                        <div class="input-group">
                            <input type="number" name="no_hp" class="form-control" style="display: block;" placeholder="No Hp" value="{{($action!='add')?$pegawai->no_hp:(old('no_hp', ''))}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">No PIN</label>
                        <div class="input-group">
                            <input type="number" name="pin" class="form-control" style="display: block;" placeholder="No PIN" value="{{($action!='add')?$pegawai->pin:(old('pin', ''))}}" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-primary" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">FORM DOKUMEN PEGAWAI</h4>

                </div>
                <div class="panel-body">
                    <form method="POST" action="/pegawai/tambah_dokumen">
                        @csrf
                        <div class="row width-full">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">JENIS DOKUMEN</label>
                                    <select class="select2 show-tick form-control disabled" name="jenis" data-style="btn-inverse" required>
                                        <option value="SKT">SKT</option>
                                        <option value="SKA">SKA</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="pegawai_id" value="{{$pegawai->id}}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Nama Dokumen</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" class="form-control" style="display: block;" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Berakhir</label>
                                    <div class="input-group">
                                        <input type="date" name="tanggal" class="form-control" style="display: block;" placeholder="tanggal" required>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="panel-footer">
                            <center>
                                <input type="submit" value="Simpan" class="btn btn-success m-r-3">
                            </center>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-success" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">DAFTAR DOKUMEN PEGAWAI</h4>

                </div>
                <div class="panel-body">
                    <div class="row width-full">
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="width-60">No.</th>
                                        <th>Jenis</th>
                                        <th>Nama Dokumen</th>
                                        <th>Tanggal Berakhir</th>
                                        <th class="width-90"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pegawai->dokumen as $dt)
                                    <td class="width-60">{{$loop->iteration}}</td>
                                    <td>{{$dt->jenis}}</td>
                                    <td>{{$dt->nama}}</td>
                                    <td>{{$dt->tanggal}}</td>
                                    <td class="width-90">
                                        <a onclick="btnDelete('{{$dt->id}}')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
                                    </td>
                                    @endforeach

                                </tbody>
                            </table>
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
                    url: "/pegawai/hapus_dokumen/" + kode,
                    type: "POST",
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