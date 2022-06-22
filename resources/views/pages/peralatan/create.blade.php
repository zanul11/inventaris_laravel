@extends('layouts.master')

@section('title', 'Peralatan')

@section('plugins_styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
        <li class="breadcrumb-item"><a href="{{url('/peralatan')}}">Manajemen Peralatan</a></li>
        <li class="breadcrumb-item"><a>Data Peralatan</a></li>
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH</span> DATA PERALATAN</h1>

    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Form Tambah Data</h4>

        </div>
        <form method="POST" action="{{($action=='add')?'/peralatan':'/peralatan/'.$peralatan->id}}" enctype='multipart/form-data'>
            @csrf
            @if (request()->routeIs('peralatan.create'))
            @method('post')
            @else
            @method('put')
            @endif
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Jenis Peralatan</label>
                            <select class="select2 show-tick form-control required" name="jenis" data-style="btn-inverse" required>
                                <option value="">Pilih Jenis Peralatan</option>
                                @foreach($jenis as $dt)
                                <option value="{{$dt->id}}" {{($action!='add')?(($peralatan->jenis_id==$dt->id)?'selected':''):((old('jenis')==$dt->id)?'selected':'')}}> {{$dt->jenis}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lokasi</label>
                            <select class="select2 show-tick form-control required" name="lokasi" data-style="btn-inverse" required>
                                <option value="">Pilih Lokasi</option>
                                @foreach($lokasi as $dt)
                                <option value="{{$dt->id}}" {{($action!='add')?(($peralatan->lokasi_id==$dt->id)?'selected':''):((old('lokasi')==$dt->id)?'selected':'')}}> {{$dt->lokasi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">SATUAN</label>
                            <select class="select2 show-tick form-control required" name="satuan" data-style="btn-inverse" required>
                                <option value="">Pilih Satuan</option>
                                @foreach($satuan as $dt)
                                <option value="{{$dt->id}}" {{($action!='add')?(($peralatan->satuan==$dt->id)?'selected':''):((old('satuan')==$dt->id)?'selected':'')}}>{{$dt->satuan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Harga</label>
                            <div class="input-group">
                                <input type="text" id="rupiah" name="harga" class="form-control" style="display: block;" placeholder="Harga beli..." value="{{($action!='add')?$peralatan->harga:(old('harga', ''))}}" required>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Nama Peralatan</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" class="form-control" autofocus style="display: block;" value="{{($action!='add')?$peralatan->nama:''}}" placeholder="Nama Peralatan..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Merk Peralatan</label>
                                    <div class="input-group">
                                        <input type="text" name="merk" class="form-control" autofocus style="display: block;" value="{{($action!='add')?$peralatan->merk:(old('merk', ''))}}" placeholder="Merk Peralatan..." required>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row input-group">
                            <div class="col-md-3">
                                <label class="control-label">Stok</label>
                                <div class="input-group">
                                    <input type="number" name="stok" class="form-control" style="display: block;" value="{{($action!='add')?$peralatan->stok:(old('stok', 0))}}" placeholder="Nama Peralatan..." required {{($action!='add')?'disabled':''}}>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Rusak</label>
                                <div class="input-group">
                                    <input type="number" name="rusak" class="form-control" style="display: block;" value="{{($action!='add')?$peralatan->rusak:(old('rusak', 0))}}" placeholder="Nama Peralatan..." required {{($action!='add')?'disabled':''}}>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Spesifikasi/Type</label>
                                <div class="input-group">
                                    <input type="text" name="spesifikasi" class="form-control" style="display: block;" value="{{($action!='add')?$peralatan->spesifikasi:(old('spesifikasi', ''))}}" placeholder="Spesifikasi/Type Peralatan...">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Foto Peralatan</label>
                            <div class="input-group">
                                <input type="file" class="form-control" onchange="checkFileExtension('file')" id="file" style="display: block;" name="file" {{($action=='edit')?'':'required'}}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if($action=='edit')
                        @if(isset($peralatan->foto))
                        <div class="gallery">
                            <img src="{{asset('inventaris/public/uploads/'.$peralatan->foto)}}" height="50px">
                        </div> @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" value="Simpan" class="btn btn-success m-r-3">
            </div>
    </div>
    </form>
    <div id="fullpage" onclick="this.style.display='none';"></div>
</div>
</div>
@endsection

@section('plugins_scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('page_scripts')
<script>
    const imgs = document.querySelectorAll('.gallery img');
    const fullPage = document.querySelector('#fullpage');

    imgs.forEach(img => {
        img.addEventListener('click', function() {
            fullPage.style.backgroundImage = 'url(' + img.src + ')';
            fullPage.style.display = 'block';
        });
    });

    function checkFileExtension(id) {
        fileName = document.querySelector('#' + id).value;
        extension = fileName.split('.').pop();
        const ekstensi = ["png", "jpg", "jpeg"];
        if (!ekstensi.includes(extension)) {
            swal({
                title: "Warning!!!",
                text: "Format Dokument Harus PNG/JPG/JPEG!",
                icon: "warning",
            });
            document.querySelector('#' + id).value = '';
        } else {
            const oFile = document.getElementById(id).files[0];
            // alert(oFile.size);

            if (oFile.size > 212000) // 500Kb for bytes.
            {
                swal({
                    title: "Warning!!!",
                    text: "Besar file maksimal 200 KB!",
                    icon: "warning",
                });
                document.querySelector('#' + id).value = '';
            }
        }
    };

    $(document).ready(function() {
        $('.select2').select2();
    });

    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>
@endsection