@extends('layouts.master')

@section('title', 'Barang')

@section('plugins_styles')
<link href="{{asset('assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('page_styles')
<style>
    #fullpage {
        display: none;
        position: absolute;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-size: contain;
        background-repeat: no-repeat no-repeat;
        background-position: center center;
        background-color: white;
    }

    .zoom {

        transition: transform .08s;
        width: 214px;
        height: 115px;
    }

    .zoom:hover {
        -ms-transform: scale(1.5);
        /* IE 9 */
        -webkit-transform: scale(1.5);
        /* Safari 3-8 */
        transform: scale(1.5);
    }
</style>
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="">Setup</a></li>
        <li class="breadcrumb-item"><a href="">Pegawai</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">DATA</span> PEGAWAI</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <div class="row width-full">
                <div class="col-xl-3 col-sm-3">
                    <div class="form-inline">
                        <a href="{{url('/pegawai/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                        <th>Jabatan</th>
                        <th>No Identitas</th>
                        <th>Alamat</th>
                        <th>No. Hp</th>
                        <th>Foto</th>
                        <th>Absen/Tidak?</th>
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
    <div id="fullpage" onclick="this.style.display='none';"></div>
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
    imgs = document.querySelectorAll('.gallery img');
    fullPage = document.querySelector('#fullpage');

    function srcImage() {
        const img = document.querySelector('img');
        fullPage.style.backgroundImage = 'url(' + event.target.getAttribute('src') + ')';
        fullPage.style.display = 'block';
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
                    url: "/pegawai/" + kode,
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
                ajax: "{{ route('ss.pegawai') }}",
                columns: [{
                        "data": "DT_RowIndex"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "jabatan.jabatan"
                    },
                    {
                        "data": "no_identitas"
                    },
                    {
                        "data": "alamat"
                    },

                    {
                        "data": "no_hp"
                    },
                    {
                        "data": "foto"
                    },
                    {
                        "data": "is_absen"
                    },
                    {
                        "data": "action"
                    },
                ],
                "columnDefs": [{
                        "targets": 6,
                        "data": "foto",
                        "render": function(data, type, row, meta) {
                            var type = '';
                            if (data != null) {
                                type = '<img src="{{asset("inventaris/public/uploads")}}/' + data + '" onclick="srcImage()" height="50px"/>';
                            } else {
                                type = '-';
                            }
                            return type;

                        }
                    },
                    {
                        "targets": 7,
                        "data": "is_absen",
                        "render": function(data, type, row, meta) {
                            var type = '';
                            if (data == 0) {
                                type = '<span class="label label-danger">Tidak</span>';
                            } else {
                                type = '<span class="label label-success">Ya</span>';
                            }
                            return type;
                        }
                    }
                ]
            });
        });
    });
</script>
@endsection