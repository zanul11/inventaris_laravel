@extends('layouts.master')

@section('title', 'Barang Keluar')

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
        <li class="breadcrumb-item"><a href="">Manajemen Barang</a></li>
        <li class="breadcrumb-item"><a href="">Barang Keluar</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Data Barang Keluar <small>Aplikasi Rumah Tangga PT Air Minum Giri Menang (Perseroda)</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-danger" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="row width-full">
                <div class="col-xl-3 col-sm-3">
                    <div class="form-inline">
                        <a href="{{url('/barang_keluar/create')}}" class="btn btn-default"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="col-xl-9 col-sm-9">
                    <div class=" pull-right form-inline">
                        <div class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label" style="color: white;">Filter</label>
                            <div class="col-10">
                                <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="filter-tgl">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th class="width-10">No.</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>PJ</th>
                        <th>Barang</th>
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

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Barang Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-info" novalidate enctype="multipart/form-data" method="post" action="/barang_masuk/edit" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row ">
                            <div class="modal-body alert alert-warning m-b-0">
                                <div class="form-group ">
                                    <label class="control-label">BARANG</label><br>
                                    <select class="select3 form-control" id="barang_edits" name="barang_edits" data-width="100%" data-parsley-required="true" disabled>

                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">JUMLAH STOK MASUK</label><br>
                                    <input type="number" name="stok_edit" id="stok_edit" class="form-control" style="display: block;" placeholder="Stok barang..." required>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">PENANGGUNG JAWAB</label><br>
                                    <select class="select3  form-control required" name="pegawai_edit" id="pegawai_edit" data-width="100%" data-style="btn-inverse" required>

                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">KETERANGAN</label><br>
                                    <textarea name="ket_edit" id="ket_edit" class="form-control" rows="3" style="display: block;"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id_barang_masuk" id="id_barang_masuk"></input>
                            <input type="hidden" name="barang_edit" id="barang_edit"></input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" id="myBtn_edit">Update</button>
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
                    url: "/barang_keluar/delete/" + kode,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
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
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 7,
            lengthChange: false,
            responsive: true,
            ajax: "{{ route('ss.barang.keluar') }}",
            columns: [{
                    "data": "DT_RowIndex"
                }, {
                    "data": "kode"
                },
                {
                    "data": "tgls"
                },
                {
                    "data": "penerima"
                },
                {
                    "data": "daftar_barang"
                },
                {
                    "data": "action"
                },
            ],
            // "columnDefs": [{
            //     "targets": 7,
            //     "data": "harga",
            //     "render": function(data, type, row, meta) {
            //         var type = '';
            //         var reverse = data.toString().split('').reverse().join(''),
            //             ribuan = reverse.match(/\d{1,3}/g);
            //         ribuan = ribuan.join('.').split('').reverse().join('');
            //         type = ribuan;
            //         return type;
            //     }
            // }]
        });
        var table = $('.data-table').DataTable();
        var bulan = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $('#filter-tgl').on('change', function() {
            var mydate = new Date($(this).val());
            var tgl = mydate.getDate() + '/' + bulan[mydate.getMonth()] + '/' + mydate.getFullYear();
            // alert(tgl);
            table.column(2).search(tgl).draw();
        });

    });
</script>
@endsection