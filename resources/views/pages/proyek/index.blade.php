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
        <li class="breadcrumb-item"><a href="">Setup</a></li>
        <li class="breadcrumb-item"><a href="">PROYEK</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">DATA</span> PROYEK</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="row width-full">
                <div class="col-xl-3 col-sm-3">
                    <div class="form-inline">
                        <a href="{{url('/proyek/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th class="width-60">No.</th>
                        <th>Nama</th>
                        <th>Penanggung Jawab</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>File</th>
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
                    url: "/proyek/" + kode,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire(
                                "Gagal Menghapus Proyek!",
                                "Terdapat Data Barang Keluar pada proyek yang akan dihapus!",
                                "warning"
                            );
                        } else if (response == 2) {
                            Swal.fire(
                                "Gagal Menghapus Proyek!",
                                "Terdapat Data Peralatan Pinjaman pada proyek yang akan dihapus!",
                                "warning"
                            );
                        } else {
                            Swal.fire(
                                "Deleted!",
                                "Data berhasil dihapus",
                                "success"
                            ).then(result => {
                                location.reload();
                            });
                        }
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
                ajax: "{{ route('ss.proyek') }}",
                columns: [{
                        "data": "DT_RowIndex"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "pj"
                    },
                    {
                        "data": "lokasi"
                    },

                    {
                        "data": "ket"
                    },
                    {
                        "data": "file"
                    },
                    {
                        "data": "action"
                    },
                ],
                "columnDefs": [{
                        "targets": 5,
                        "data": "file",
                        "render": function(data, type, row, meta) {
                            var type = '';
                            if (data != null) {
                                type = '<a href="{{asset("inventaris/public/uploads")}}/' + data + '" target="_blank">Lihat File</a>';
                            } else {
                                type = '-';
                            }
                            return type;

                        }
                    },

                ]
            });
        });
    });
</script>
@endsection