@extends('layouts.master')

@section('title', 'Uji Akurasi Meter')

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
        <li class="breadcrumb-item"><a href="">Akunting</a></li>
        <li class="breadcrumb-item"><a href="">Laporan</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">LAPORAN</span> AKUNTING</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <div class="panel-heading">
            Laporan

        </div>
        <div class="panel-body table-responsive">
            <form method="POST" action="/laporan-akunting">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <label> Dari tanggal </label>
                        <input type="date" class="form-control" name="dTgl" value="{{date('Y-m-d', strtotime(Session::get('dTgl')))}}">
                    </div>
                    <div class="col-lg-2">
                        <label> Sampai </label>
                        <input type="date" class="form-control" name="sTgl" value="{{date('Y-m-d', strtotime(Session::get('sTgl')))}}">
                    </div>
                    <div class="col-lg-1">
                        <label> Jenis </label>
                        <select name="jenis" class="selectpicker form-control" data-style="btn-warning">
                            <option value="Semua" {{Session::get('jenis')=='Semua'?'selected':''}}>Semua</option>
                            <option value="Pemasukan" {{Session::get('jenis')=='Pemasukan'?'selected':''}}>Pemasukan</option>
                            <option value="Pengeluaran" {{Session::get('jenis')=='Pengeluaran'?'selected':''}}>Pengeluaran</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <label> Cari </label>
                        <input type="text" class="form-control" name="cari" placeholder="Pencarian" value="{{Session::get('cari')}}">
                    </div>
                    <div class="col-lg-1">
                        <label> # </label>
                        <button type="submit" class="form-control btn btn-purple " id="Button"> Lihat</button>
                    </div>
            </form>
            <div class="col-lg-1">
                <label> # </label>
                <a href="/laporan-akunting/1" target="_blank" class="form-control btn btn-primary " id="Button"> Cetak</a>
            </div>
            <!-- <div class="col-lg-1">
                <label> # </label>
                <a href="/excel-uji" target="_blank" class="form-control btn btn-green " id="Button"> Excel</a>
            </div> -->
        </div><br>

        <table class="table table-hover data-table table-striped" style=" margin-top: 30px;">
            <thead>
                <tr>
                    <th class="width-10">No.</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table><br>
        <div style="float: right">

        </div>
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
    $(function() {
        $(document).ready(function() {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                lengthChange: false,
                searching: false,
                responsive: true,
                ajax: "{{ route('ss.laporan-akunting') }}",
                columns: [{
                        "data": "DT_RowIndex"
                    }, {
                        "data": "tgl"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "jenis_akunting.jenis"
                    },

                    {
                        "data": "uang_masuk"
                    },
                    {
                        "data": "uang_keluar"
                    },
                ],

                "order": [
                    [1, "asc"]
                ]
            });
        });
    });
</script>
@endsection