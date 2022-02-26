@extends('layouts.master')

@section('title', 'Satuan')

@section('plugins_styles')
<link href="{{asset('assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Setup</a></li>
        <li class="breadcrumb-item"><a href="">Satuan</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Satuan & Jenis <small>barang...</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row width-full">
        <div class="col-md-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="width: 100%;">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="row width-full">

                        <div class="col-xl-6 col-sm-6">
                            <div class="form-inline">
                                <a onclick="showModalsAdd()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Satuan Barang</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover data-table">
                        <thead>
                            <tr>
                                <th class="width-60">No.</th>
                                <th>SATUAN</th>
                                <th class="width-90">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer form-inline">
                    <div class="col-md-6 col-lg-10 col-xl-10 col-xs-12">
                        <div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary" style="width: 100%;">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="row width-full">

                        <div class="col-xl-6 col-sm-6">
                            <div class="form-inline">
                                <a onclick="showModalsAddJenis()" class="btn btn-default" style="color: black;"><i class="fa fa-plus"></i> Tambah Jenis Barang</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover data-jenis">
                        <thead>
                            <tr>
                                <th class="width-60">No.</th>
                                <th>JENIS BARANG</th>
                                <th class="width-90">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer form-inline">
                    <div class="col-md-6 col-lg-10 col-xl-10 col-xs-12">
                        <div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Satuan Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-info" novalidate enctype="multipart/form-data" method="post" action="/satuan" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="modal-body">
                                <div class="alert alert-success m-b-0">
                                    <div class="col-lg-12">
                                        <label> Nama Satuan </label>
                                        <input type="text" name="satuan" class="form-control" autofocus></input>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Satuan Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-info" novalidate enctype="multipart/form-data" method="post" action="/satuan/edit" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="modal-body">
                                <div class="alert alert-success m-b-0">
                                    <div class="col-lg-12">
                                        <label> Nama Satuan </label>
                                        <input type="text" name="satuan" id="satuan_edit" class="form-control"></input>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_satuan" id="id_satuan"></input>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-jenis">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jeniss Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-info" novalidate enctype="multipart/form-data" method="post" action="/jenis" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="modal-body">
                                <div class="alert alert-warning m-b-0">
                                    <div class="col-lg-12">
                                        <label> Nama Jenis </label>
                                        <input type="text" name="jenis" class="form-control" autofocus></input>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-jenis">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Jenis Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-info" novalidate enctype="multipart/form-data" method="post" action="/jenis/edit" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="modal-body">
                                <div class="alert alert-warning m-b-0">
                                    <div class="col-lg-12">
                                        <label> Nama Jenis </label>
                                        <input type="text" name="jenis" id="jenis_edit" class="form-control"></input>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_jenis" id="id_jenis"></input>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('plugins_scripts')
<script src="{{asset('assets/vendors/dataTables/datatables.min.js')}}"></script>
<script>
    function showModalsAdd() {
        // document.getElementById("id_laporan").value = kode;
        // // document.getElementById("btn-submit").value = '';
        $('#modal-add').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalsEdit(kode, satuan) {
        document.getElementById("id_satuan").value = kode;
        document.getElementById("satuan_edit").value = satuan;
        $('#modal-edit').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalsAddJenis() {
        // document.getElementById("id_laporan").value = kode;
        // // document.getElementById("btn-submit").value = '';
        $('#modal-add-jenis').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalsEditJenis(kode, jenis) {
        document.getElementById("id_jenis").value = kode;
        document.getElementById("jenis_edit").value = jenis;
        $('#modal-edit-jenis').modal({
            backdrop: 'static',
            keyboard: false
        });
    }
</script>
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
                    url: "/user/delete/" + kode,
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
    $(function() {
        $(document).ready(function() {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthChange: false,
                responsive: true,
                ajax: "{{ route('ss.satuan') }}",
                columns: [{
                        "data": "DT_RowIndex"
                    }, {
                        "data": "satuan"
                    },
                    {
                        "data": "action"
                    },

                ],
            });

            $('.data-jenis').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthChange: false,
                responsive: true,
                ajax: "{{ route('ss.jenis') }}",
                columns: [{
                        "data": "DT_RowIndex"
                    }, {
                        "data": "jenis"
                    },
                    {
                        "data": "action"
                    },

                ],
            });
        });
    });
</script>
@endsection