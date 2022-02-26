<center>
    <h4>Data Siswa</h4>
</center>
<!-- <div class="table-responsive row">
    <table class="table table-bordered table-hover table-md" id="datatable">
        <thead class="thead-default thead-lg">
         
        </thead>
    </table>
</div> -->
<div class="table-responsive row">
    <table class="table table-bordered table-hover table-md" id="datatable">
        <thead class="thead-default thead-lg">
            <tr>
                <th>Jurusan</th>
                <th>{{$jurusan}}</th>
            </tr>
            <tr>
                <th>Angkatan</th>
                <th>{{$angkatan}}</th>
            </tr>
            <tr>
                <th>Gelombang</th>
                <th>{{$gelombang}}</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>TTL</th>
                <th>No Hp</th>
                <th>Alamat</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $dt)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$dt->nis_siswa}}</td>
                <td>{{$dt->nik}}</td>
                <td>{{$dt->nama}}</td>
                <td>{{$dt->tempat_lahir}}, {{$dt->tgl_lahir}}</td>
                <td>{{$dt->no_hp}}</td>
                <td>{{$dt->alamat}}</td>
                <td>{{$dt->email}}</td>
            </tr>
            @endforeach
        </tbody>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    </table>
</div>