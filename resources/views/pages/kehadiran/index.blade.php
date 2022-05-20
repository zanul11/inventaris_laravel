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
        <li class="breadcrumb-item"><a href="">Absen</a></li>
        <li class="breadcrumb-item"><a href="">KEHADIRAN</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">DATA</span> KEHADIRAN</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="row width-full">
                <div class="col-lg-3">
                    <a href="{{url('/kehadiran/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="col-lg-3">
                    <form action="/kehadiran/1" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <input type="text" name="tgl" class="form-control" id="tgl_libur" placeholder="Pilih Tanggal">
                            <span class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="Filter" class="btn btn-green m-r-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th class="width-60">No.</th>
                        <th>No. Identitas</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Kode</th>
                        <th class="width-90"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kehadiran as $dt)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$dt->pegawai->no_identitas}}</td>
                        <td>{{$dt->pegawai->nama}}</td>
                        <td>{{date('d-m-Y H:i:s', strtotime($dt->tgl))}}</td>
                        <td>{{($dt->jenis==1)?'Masuk':'Pulang'}}</td>
                        <td><a onclick="btnDelete('{{$dt->id}}')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a></td>
                    </tr>
                    @endforeach
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
                    url: "/kehadiran/" + kode,
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
        var date = new Date();
        var endDate = new Date("{{$endDate}}");
        var firstDate = new Date("{{$firstDate}}");
        $('#tgl_libur').val(("{{$tgl}}"));
        $('#tgl_libur').daterangepicker({
            startDate: firstDate, // after open picker you'll see this dates as picked
            endDate: endDate,
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#tgl_libur').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' s/d ' + picker.endDate.format('DD-MM-YYYY'));
            console.log(picker);
        });

        $('#tgl_libur').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        $(document).ready(function() {
            $('.data-table').DataTable({
                pageLength: 10,
                lengthChange: false,
                responsive: true,
            });
        });
    });
</script>
@endsection