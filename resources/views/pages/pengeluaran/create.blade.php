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
        <li class="breadcrumb-item"><a>Tambah Data</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header text-danger font-weight-bold"><span class="text-custom">TAMBAH DATA</span> PENGELUARAN</h1>

    <div class="row">
        <div class="{{(isset($pengeluaran->log))?'col-lg-9':'col-lg-12'}}">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <!-- begin panel-heading -->
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Form Tambah Data</h4>

                </div>
                <form method="POST" action="{{($action=='add')?'/pengeluaran':'/pengeluaran/'.$pengeluaran->id}}" enctype='multipart/form-data'>
                    @csrf
                    @if($action!='add')
                    @method('PUT')
                    @endif
                    <input type="hidden" value="{{$action}}" name="action" />
                    <div class="panel-body">
                        <div class="row width-full">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Jenis Pengeluaran</label>
                                    <select class="select2 show-tick form-control required" name="jenis_akunting_id" data-style="btn-primary" required>
                                        <option value="">Pilih Jenis Pengeluaran</option>
                                        @foreach($jenis as $dt)
                                        <option value="{{$dt->id}}" {{(old('jenis_akunting_id',$pengeluaran->jenis_akunting_id??'')==$dt->id)?'selected':''}}>{{$dt->jenis}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nama Pengeluaran</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" style="display: block;" value="{{ old('nama',$pengeluaran->nama??'') }}" name="nama" placeholder="Nama Pengeluaran..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Jumlah</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" style="display: block;" value="{{ old('jumlah',$pengeluaran->jumlah??'') }}" name="jumlah" placeholder="Jumlah/Nilai Pengeluaran..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <div class="input-group">
                                        <textarea class="form-control" style="display: block;" value="" name="ket">{{ old('ket',$pengeluaran->ket??'') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">File Bukti</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" onchange="checkFileExtension('file')" id="file" style="display: block;" name="file">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if($action=='edit')
                                <div class="gallery">
                                    <img src="{{asset('uploads/'.$pengeluaran->file)}}" height="50px">

                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="submit" value="Simpan" class="btn btn-success m-r-3">
                        <a wire:click="batal" class="btn btn-danger">Batal</a>
                    </div>
            </div>
        </div>

        @if($action=='edit')
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
        @endif
    </div>


    <div id="fullpage" onclick="this.style.display='none';"></div>
    </form>

</div>
@endsection

@section('plugins_scripts')

@endsection

@section('page_scripts')
<script>
    $(function() {
        $('.select2').select2();
    });

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