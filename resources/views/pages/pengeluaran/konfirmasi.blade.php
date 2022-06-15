@extends('layouts.master')

@section('title', 'Dashboard')

@section('plugins_styles')

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
</style>
@endsection

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a>Keuangan</a></li>
        <li class="breadcrumb-item"><a href="{{url('/pengeluaran')}}">PENGELUARAN</a></li>
        <li class="breadcrumb-item"><a>{{$action}} Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">{{strtoupper($action)}} DATA</span> PENGELUARAN</h1>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Detail Pengeluaran</h4>

                </div>

                <div class="panel-body">
                    <div class="row width-full">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Jenis Pengeluaran</label>
                                <select class="select2 show-tick form-control required" name="jenis_akunting_id" data-style="btn-primary" disabled>
                                    <option value="">Pilih Jenis Pengeluaran</option>
                                    @foreach($jenis as $dt)
                                    <option value="{{$dt->id}}" {{(old('jenis_akunting_id',$pengeluaran->jenis_akunting_id??'')==$dt->id)?'selected':''}}>{{$dt->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nama Pengeluaran</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" style="display: block;" value="{{ old('nama',$pengeluaran->nama??'') }}" name="nama" placeholder="Nama Pengeluaran..." disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tanggal</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" style="display: block;" value="{{ old('tgl',date('d-m-Y',strtotime($pengeluaran->tgl))??'') }}" name="tgl" placeholder="Nama Pengeluaran..." disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Jumlah</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" style="display: block;" value="Rp. {{ old('jumlah',number_format($pengeluaran->jumlah)??'') }}" name="jumlah" placeholder="Jumlah/Nilai Pengeluaran..." disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Keterangan</label>
                                <div class="input-group">
                                    <textarea class="form-control" style="display: block;" value="" name="ket" disabled>{{ old('ket',$pengeluaran->ket??'') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Foto Bukti</label>
                                @if($action=='konfirmasi'|| $action=='lihat')
                                <div class="gallery">
                                    <img src="{{asset('inventaris/public/uploads/'.$pengeluaran->file)}}" height="100px">
                                </div>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if($action=='konfirmasi')
        <div class="col-lg-5">
            <div class="panel panel-success" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Form Konfirmasi Data</h4>
                </div>
                <form method="POST" action="/pengeluaran/{{$pengeluaran->id}}" enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{$action}}" name="action" />
                    <div class="panel-body">
                        <div class="row width-full">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select class="selectpicker show-tick form-control" name="status" data-style="btn-primary">
                                        <option value="2">KOREKSI</option>
                                        <option value="3">SETUJU</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <div class="input-group">
                                        <textarea class="form-control" style="display: block;" value="" name="ket_konfirmasi" required>{{ old('ket',$pengeluaran->ket_konfirmasi??'') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="submit" value="Simpan" class="btn btn-success m-r-3">
                        <a wire:click="batal" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <div class="col-lg-3">
            <div class="panel panel-primary" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">LOG KOREKSI</h4>
                </div>
                <div class="panel-body">
                    <div class="row width-full">
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="width-60">No.</th>
                                        <th>Tanggal</th>
                                        <th>Ket</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengeluaran->log as $dt) <tr>
                                        <td class="width-60">{{$loop->iteration}}</td>
                                        <td>{{$dt->created_at}}</td>
                                        <td>{{$dt->ket}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="fullpage" onclick="this.style.display='none';"></div>


</div>
@endsection

@section('plugins_scripts')

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
        // if (extension != 'pdf') {
        //     swal({
        //         title: "Warning!!!",
        //         text: "Format Dokument Harus PDF!",
        //         icon: "warning",
        //     });
        //     document.querySelector('#' + id).value = '';
        // }
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
        // document.querySelector('.output')
        //     .textContent = extension;
    };
</script>
@endsection