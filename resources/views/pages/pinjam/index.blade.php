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
        <li class="breadcrumb-item"><a href="">Manajemen Peralatan</a></li>
        <li class="breadcrumb-item"><a href="">PEMINJAMAN PERALATAN</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">DATA</span> PEMINJAMAN PERALATAN</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="row width-full">
                <div class="col-xl-3 col-sm-3">
                    <div class="form-inline">
                        <a href="{{url('/pinjam/create')}}" class="btn btn-default"><i class="fa fa-plus"></i> Tambah</a>
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
                        <th>Tanggal Batas</th>
                        <th>PJ</th>
                        <th>Lokasi</th>
                        <th>Proyek</th>
                        <th>Peralatan</th>
                        <th>Status</th>
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
                    url: "/pinjam/" + kode,
                    type: "DELETE",
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
            ajax: "{{ route('ss.pinjam') }}",
            columns: [{
                    "data": "DT_RowIndex"
                }, {
                    "data": "kode"
                }, {
                    "data": "batas"
                },
                {
                    "data": "pj"
                },
                {
                    "data": "lokasi"
                },
                {
                    "data": "proyek_detail"
                },
                {
                    "data": "daftar_barang"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                },
            ],
            "columnDefs": [{
                "targets": 7,
                "data": "status",
                "render": function(data, type, row, meta) {
                    var type = '';
                    if (data == 0) {
                        type = '<span class="label label-primary">Sedang Dipinjam</span>';
                    } else {
                        type = '<span class="label label-success">Selesai</span>';
                    }
                    return type;
                }
            }]
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