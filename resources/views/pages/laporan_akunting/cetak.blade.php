<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=21cm, initial-scale=1">
    <meta name="description" content="Sistem Informasi Akademik Universitas Mataram">
    <meta name="author" content="Universitas Mataram">
    <title>Cetak LAPORAN AKUNTING</title>
    <link rel="stylesheet" href="{{asset('cetak/b.min.css')}}">
    <link rel="stylesheet" href="{{asset('cetak/f.min.css')}}">
    <link rel="stylesheet" href="{{asset('cetak/style.css')}}">

    <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/logo.png')}}" sizes="16x16">
    <link rel="apple-touch-icon" href="{{asset('assets/img/logo.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/img/logo.png')}}">

    <style>

    </style>
</head>

<body class="view mahasiswa halaman" onload="cetak()">
    <div class="container-fluid cetak krs">
        <div class="row">
            <!-- <div id="header">
                <div id="logofakultas">
                    <img src="{{asset('assets/img/logo.png')}}">
                </div>
                <div id="isi" align="center" style="margin-top: 10px;">
                    <b style="font-size: 16px;">
                        PUSAT PELATIHAN DAN PENGEMBANGAN PROFESI MATARAM (P4M) </b><br>
                    <div style="font-size: 10px;">Jln. Airlangga No.8 Telp. (0370) 631632 Mataram e-mail : p4mmataram@yahoo.com
                    </div>
                    TERAKREDITASI BAN-PNF<br>
                    SK Nomor : 013,14/SKEP/STS-AKR/BAN PNF/XII/2019 <br>

                    <br>
                </div>

            </div> -->
            <!-- <div class="clear" style="margin-top: 0px;">
                <hr style="height:3px;  background-color:black">
            </div> -->
            <center style="margin-top: 10px;">
                <b style="font-size: 16px;">LAPORAN AKUNTING </b><br>
            </center>
            <br>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Jenis </td>
                        <td>:</td>
                        <td>{{$jenis_keuangan}}</td>
                    </tr>
                    <tr>
                        <td>Kelompok </td>
                        <td>:</td>
                        <td>{{$nm_kelompok}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Laporan</td>
                        <td>:</td>
                        <td>{{date('d-m-Y', strtotime($dTgl))}} sampai {{date('d-m-Y', strtotime($sTgl))}}</td>
                    </tr>
                    <tr>
                        <td>Kata Kunci</td>
                        <td>:</td>
                        <td>{{$cari??'-'}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <b style="font-size: 14px;">DATA LAPORAN AKUNTING </b><br><br>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Ket</th>
                        <th>Tanggal</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tBody>
                    @php
                    $total = 0;
                    $pemasukan = 0; $pengeluaran = 0;
                    @endphp
                    @foreach($data as $dt)
                    @php

                    if($dt->jenis==1)
                    $total += $dt->jumlah;
                    else
                    $total -= $dt->jumlah;
                    @endphp
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$dt->nama}} ({{$dt->jenis_akunting->jenis}})</td>
                        <td>{{$dt->ket}}</td>
                        <td>{{date('d-m-Y', strtotime($dt->tgl))}}</td>
                        <td>{{($dt->jenis==1)?number_format($dt->jumlah):0}}</td>
                        <td>{{($dt->jenis==0)?number_format($dt->jumlah):0}}</td>
                        <td>{{($jenis_keuangan=='Pengeluaran')? number_format($total*-1):number_format($total)}}</td>
                    </tr>
                    @php
                    if($dt->jenis==1)
                    $pemasukan += $dt->jumlah;
                    else
                    $pengeluaran += $dt->jumlah;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="4" align="center"><b>Total</b></td>
                        <td>{{number_format($pemasukan)}}</td>
                        <td>{{number_format($pengeluaran)}}</td>
                        <th>{{($jenis_keuangan=='Pengeluaran')? number_format(($pemasukan-$pengeluaran)*-1):number_format($pemasukan-$pengeluaran)}}</th>
                    </tr>
                </tBody>
                <tfoot>

                </tfoot>
            </table>
            <hr style="height:3px;  background-color:black">



            <!-- <div class="pull-left ttd">
                <br><br><br>Pimpinan P4M,
                <br><br>

                {!!'<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('Disahkan oleh Direktur P4M : ', 'QRCODE', 3,3) . '" alt="barcode" />'!!}

                <br><br>
                <span class="nama">Zanul</span>
            </div> -->



            <div class="pull-right ttd">
                <br>Mataram, {{date('d F Y')}}<br>
                <br>Pembuat,
                <br><br>
                {!!'<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('Diterbitkan oleh : '.Auth::user()->nama, 'QRCODE', 3,3) . '" alt="barcode" />'!!}
                <br><br>
                <span class="nama">{{Auth::user()->nama}}</span>
            </div>
        </div>
        <br>
    </div>

    <script type="text/javascript">
        function cetak() {
            window.print();
        };
    </script>


</body>

</html>