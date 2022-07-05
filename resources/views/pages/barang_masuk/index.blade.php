@extends('layouts.master')

@section('title', 'Barang Masuk')

@section('plugins_styles')


<link href="{{asset('assets/vendors/dataTables/datatables.min.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page_styles')
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="">Manajemen Barang</a></li>
        <li class="breadcrumb-item"><a href="">Barang Masuk</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">DATA</span> BARANG MASUK</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="panel panel-success" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading" id="kepala">
            <div class="row width-full">
                <div class="col-xl-3 col-sm-3">
                    <div class="form-inline">
                        <a onclick="showModalsAdd()" class="btn btn-warning"><i class="fa fa-plus"></i> Tambah</a>
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
            <div class="row">
                <div class="col-lg-5">
                    <label>Barang :</label>
                    <select class="select4 form-control" id="type-barang" title="Please select" data-style="btn-solid" data-width="150px">
                        <option value="">All</option>
                        @foreach($barang as $dt)
                        <option value=" {{$dt->nama}}">{{$dt->nama}} - {{$dt->merk}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th class="width-10">No.</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>PJ</th>
                        <th>Ket</th>
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
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-info" novalidate enctype="multipart/form-data" method="post" action="/barang_masuk" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row ">
                            <div class="modal-body alert alert-success m-b-0">
                                <div class="form-group ">
                                    <label class="control-label">BARANG</label><br>
                                    <select class="select2  form-control required" name="barang" id="barang" data-width="100%" onchange="cekBtn()" data-style="btn-inverse" required>
                                        <option value="">Pilih Barang Masuk</option>
                                        @foreach($barang as $dt)
                                        <option value="{{$dt->id}}"> {{$dt->nama}}/{{$dt->ukuran}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">JUMLAH STOK MASUK</label><br>
                                    <input type="number" name="stok" id="stok" class="form-control" style="display: block;" placeholder="Stok barang..." required>
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

                                <div class="form-group ">
                                    <label class="control-label">KETERANGAN</label><br>
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
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Tanggal</label><br>
                                        <input type="date" name="tgl_edit" id="tgl_edit" class="form-control" style="display: block;" value="" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">PENANGGUNG JAWAB</label><br>
                                        <input type="text" name="pegawai_edit" id="pegawai_edit" class="form-control" style="display: block;" placeholder="Penanggungjawab..." required>
                                    </div>
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
                    url: "/barang_masuk/delete/" + kode,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // console.log(response);
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
    document.getElementById("myBtn").disabled = true;

    function cekBtn() {
        if (document.getElementById("barang").value == '' || document.getElementById("stok").value == '' || document.getElementById("stok").value <= 0 || document.getElementById("pegawai").value == '')
            document.getElementById("myBtn").disabled = true;
        else
            document.getElementById("myBtn").disabled = false;

    }

    $('#pegawai').on('input', function(e) {
        if (document.getElementById("barang").value == '' || document.getElementById("stok").value == '' || document.getElementById("stok").value <= 0 || document.getElementById("pegawai").value == '')
            document.getElementById("myBtn").disabled = true;
        else
            document.getElementById("myBtn").disabled = false;
    });

    $('#stok').on('input', function(e) {
        if (document.getElementById("barang").value == '' || document.getElementById("stok").value == '' || document.getElementById("stok").value <= 0 || document.getElementById("pegawai").value == '')
            document.getElementById("myBtn").disabled = true;
        else
            document.getElementById("myBtn").disabled = false;
    });

    function showModalsAdd() {
        $('#modal-add').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function showModalsEdit(kode, barang, jumlah, pj, tgl, ket) {
        console.log(pj);
        document.getElementById("id_barang_masuk").value = kode;
        document.getElementById("barang_edit").value = barang;
        document.getElementById("stok_edit").value = jumlah;
        document.getElementById("ket_edit").value = ket;
        document.getElementById("pegawai_edit").value = pj;
        $('#tgl_edit').val(tgl);
        var select = document.getElementById('barang_edits');

        $("#barang_edits").empty();

        $.ajax({
            url: '/get-barang',
            type: 'GET',
            success: function(result) {
                $.each(result, function(i, item) {
                    var opt = document.createElement('option');
                    opt.value = item['id'];
                    opt.innerHTML = item['nama'];
                    select.appendChild(opt);
                });
                $("#barang_edits").val(barang);
            },
        });



        $('#barang_edits').select2().trigger('change');


        $('#modal-edit').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.select3').select2({
            dropdownParent: $('#modal-edit')
        });
    }


    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#modal-add')
        });

        $('.select4').select2();


        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 7,
            lengthChange: false,
            responsive: true,
            ajax: "{{ route('ss.barang.masuk') }}",
            columns: [{
                    "data": "DT_RowIndex"
                },
                {
                    "data": "name"
                },
                {
                    "data": "jumlah"
                },
                {
                    "data": "kode"
                },
                {
                    "data": "tgl"
                },

                {
                    "data": "pj"
                },
                {
                    "data": "ket"
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
        $('#type-barang').on('change', function() {
            table.column(3).search($(this).val()).draw();
        });

    });
</script>
@endsection