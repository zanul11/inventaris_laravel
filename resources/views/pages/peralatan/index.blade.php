@extends('layouts.master')

@section('title', 'Barang')

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
        <li class="breadcrumb-item"><a href="">Manajemen Peralatan</a></li>
        <li class="breadcrumb-item"><a href="">Data Peralatan</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">DATA</span> PERALATAN</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="row width-full">
                <div class="col-xl-3 col-sm-3">
                    <div class="form-inline">
                        <a href="{{url('/peralatan/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <!-- <div class="col-xl-9 col-sm-9">
                    <div class=" pull-right form-inline">
                        <button type="button" class="btn btn-green ">{{Session::get('barang')}}</button>
                        <button type="button" class="btn btn-green  dropdown-toggle" data-toggle="dropdown">
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/peralatan')}}">Exist</a></li>
                            <li><a href="{{url('/peralatan/deleted')}}">Deleted</a></li>
                            <li><a href="{{url('/peralatan/all')}}">All</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th class="width-60">No.</th>
                        <th>Kode</th>
                        <th>Jenis</th>
                        <th>Nama/Merk</th>
                        <th>Spesifikasi</th>
                        <th>Stok</th>
                        <th>Lokasi</th>
                        <th class="width-90"></th>
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
    <!-- end row -->
    <!-- begin row -->
    <!-- end row -->
    <!-- begin row -->
    <!-- end row -->

    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Peralatan Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-info" novalidate enctype="multipart/form-data" method="post" action="/peralatan/tambah" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row ">
                            <div class="modal-body alert alert-success m-b-0">
                                <div class="form-group ">
                                    <label class="control-label">JUMLAH STOK MASUK</label><br>
                                    <input type="number" name="stok" id="stok" class="form-control" style="display: block;" placeholder="Stok peralatan..." required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Tanggal</label><br>
                                        <input type="date" name="tgl" id="tgl" class="form-control" style="display: block;" value="{{date('Y-m-d')}}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">PENANGGUNG JAWAB</label><br>
                                        <input type="text" name="pegawai" id="pegawai" class="form-control" style="display: block;" placeholder="Penanggung jawab..." required>
                                    </div>
                                </div>
                                <input type="hidden" name="id_edit" id="id_edit">

                                <div class=" form-group ">
                                    <label class=" control-label">KETERANGAN</label><br>
                                    <textarea name="ket" id="ket" class="form-control" rows="3" style="display: block;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" id="myBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-rusak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Peralata Rusak</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-info" novalidate enctype="multipart/form-data" method="post" action="/peralatan/rusak" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row ">
                            <div class="modal-body alert alert-danger m-b-0">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">JUMLAH PERALATAN RUSAK</label><br>
                                        <input type="number" name="stok" id="stok" class="form-control" style="display: block;" placeholder="Peralatan Rusak..." required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Tanggal</label><br>
                                        <input type="date" name="tgl" id="tgl" class="form-control" style="display: block;" value="{{date('Y-m-d')}}" required>
                                    </div>

                                </div>
                                <input type="hidden" name="id_edit" id="id_edit2">

                                <div class=" form-group ">
                                    <label class=" control-label">KETERANGAN</label><br>
                                    <textarea name="ket" id="ket" class="form-control" rows="3" style="display: block;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" id="myBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('plugins_scripts')
<script src="{{asset('assets/vendors/dataTables/datatables.min.js')}}"></script>
@endsection

@section('page_scripts')
<script>
    function btnTambahPeralatan(id) {
        document.getElementById("id_edit").value = id;
        $('#modal-add').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function btnRusakPeralatan(id) {
        document.getElementById("id_edit2").value = id;
        $('#modal-rusak').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

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
                    url: "/peralatan/" + kode,
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
    $(function() {
        $(document).ready(function() {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 7,
                lengthChange: false,
                responsive: true,
                ajax: "{{ route('ss.peralatan') }}",
                columns: [{
                        "data": "DT_RowIndex"
                    }, {
                        "data": "kode"
                    },
                    {
                        "data": "jenis_detail.jenis"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "spesifikasi"
                    },

                    {
                        "data": "stok"
                    },
                    {
                        "data": "lokasi.lokasi"
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