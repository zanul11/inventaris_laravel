@extends('layouts.master')

@section('title', 'Kwitansi')

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
        <li class="breadcrumb-item"><a href="">Kas Kecil</a></li>
        <li class="breadcrumb-item"><a href="">Kwitansi Pembayaran</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Rp. {{number_format($total)}} <small>Jumlah Total Pembayaran Kwitansi</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-primary" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="row width-full">
                <div class="col-xl-3 col-sm-3">
                    <div class="form-inline">
                        <a href="{{url('/kwitansi/create')}}" class="btn btn-default"><i class="fa fa-plus"></i> Tambah</a> &nbsp;&nbsp;
                        <a href="{{url('/laporan-kwitansi')}}" class="btn btn-green" target="_blank"><i class="fa fa-print"></i> Cetak</a>
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
                        <th>Tgl Input</th>
                        <th>Tgl Kwitansi</th>
                        <th>PJ</th>
                        <th>Jenis</th>
                        <th>Ket</th>
                        <th>Total</th>
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
                    url: "/kwitansi/delete/" + kode,
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
            ajax: "{{ route('ss.kwitansi') }}",
            columns: [{
                    "data": "DT_RowIndex"
                },
                {
                    "data": "tgl_input"
                },
                {
                    "data": "tgl"
                },
                {
                    "data": "pegawai.nm_pegawai"
                },
                {
                    "data": "jenis_det.jenis"
                },
                {
                    "data": "daftar_barang"
                },
                {
                    "data": "harga"
                },
                {
                    "data": "action"
                },
            ],

        });
        var table = $('.data-table').DataTable();
        var bulan = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $('#filter-tgl').on('change', function() {
            var mydate = new Date($(this).val());
            var tgl = mydate.getDate() + '/' + bulan[mydate.getMonth()] + '/' + mydate.getFullYear();
            // alert(tgl);
            table.column(1).search(tgl).draw();
        });

    });
</script>
@endsection