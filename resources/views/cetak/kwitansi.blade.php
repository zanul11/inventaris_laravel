<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=21cm, initial-scale=1">
    <meta name="description" content="Sistem Informasi Akademik Universitas Mataram">
    <meta name="author" content="Universitas Mataram">
    <link rel="stylesheet" href="{{asset('cetak/b.min.css')}}">
    <link rel="stylesheet" href="{{asset('cetak/f.min.css')}}">
    <link rel="stylesheet" href="{{asset('cetak/style.css')}}">
    <title>Export</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" sizes="16x16">
    <link rel="apple-touch-icon" href="{{asset('assets/img/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/img/favicon.png')}}">
    <style>
        .table {
            margin-right: 20px;
            margin-left: 20px;
        }
    </style>
</head>

<body onload="cetak()">
    <table style="border-collapse: collapse; width: 100%; height: 191px; padding: 20px;" border="0">
        <tbody>
            <tr style="height: 146px;">
                <td style="width: 100%; height: 146px;">
                    <p><img style="display: block; margin-left: auto; margin-right: auto;" src="{{asset('assets/img/logo.png')}}" alt="logo" width="70" height="70" /></p>
                    <p style="text-align: center; font-size: 14px;"><strong><u>DAFTAR KWITANSI </u></strong></p>
                </td>
            </tr>
            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <table style="border-collapse: collapse; width: 100%; font-size:12px;" border="1" padding="200px">
                        <tbody>
                            <tr align="center">
                                <td class="width-10"><b>No.</b></td>
                                <td class="width-10"><b>TANGGAL</b></td>
                                <td><b>PJ</b></td>
                                <td><b>JENIS</b></td>
                                <td><b>DAFTAR KWITANSI</b></td>
                                <td><b>JUMLAH</b></td>
                            </tr>
                            @php
                            $total = 0;
                            @endphp
                            @foreach($kwitansi as $dt)

                            <tr>
                                <td align="center" style="height:5px;">{{$loop->iteration}}</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->tgl->format('d/m/Y')}}</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->pegawai->nm_pegawai}}</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->jenis_det->jenis}}</td>
                                <td style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">
                                    @foreach ($dt->kwitansis as $kwt)
                                    - {{$kwt->ket}} (Rp. {{number_format($kwt->harga)}} ) <br>
                                    @endforeach
                                </td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px; width: 15%;">{{number_format($dt->jumlah)}}</td>
                            </tr>
                            @php
                            $total +=$dt->jumlah ;
                            @endphp
                            @endforeach
                            <tr align="center">
                                <td colspan=" 5" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;"><b>TOTAL</b>
                                </td>
                                <td style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">
                                    <b>Rp. {{number_format($total)}}</b>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                    <p style="text-align: right; font-size: 12px;">AMGM-QR-UM.RT/01-04</p>


                    </blockquote>
                </td>
            </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        function cetak() {
            window.print();
        };
    </script>


</body>

</html>