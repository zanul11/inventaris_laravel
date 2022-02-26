<center>
    <h4>Daftar Siswa</h4>
</center>
<div class="table-responsive row">
    <table class="table table-bordered table-hover table-md" id="datatable">
        <thead class="thead-default thead-lg">
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>No Hp</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mapel->siswa as $data_siswa)
            <tr @if(!isset($data_siswa->nilai)) style="background-color: #f274af; color:white" @endif>
                <td>{{$loop->iteration}}</td>
                <td>{{$data_siswa->nis}}</td>
                <td>{{$data_siswa->siswa->nama}}</td>
                <td>{{$data_siswa->siswa->no_hp}}</td>
                <td>{{$data_siswa->semester}}</td>
                <td>{{(isset($data_siswa->nilai))?$data_siswa->nilai:'0'}}</td>
            </tr>
            @endforeach
        </tbody>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    </table>
</div>