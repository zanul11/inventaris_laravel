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
                    <p style="text-align: center; font-size: 14px;"><strong><u>DATA KELENGKAPAN PROYEK </u></strong></p>
                </td>
            </tr>
            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <table style="margin-left: 20px; width: 100% margin; border-collapse: collapse; font-size: 14px;" border="0">
                        <tbody>
                            <tr style="height: 25px;">
                                <td style="width: 162.557px;">Nama Proyek</td>
                                <td style="width: 9.82955px;">:</td>
                                <td style="width: 337.102px;">&nbsp;{{$proyek->nama}}</td>
                            </tr>
                            <tr style="height: 25px;">
                                <td style="width: 162.557px;">Penanggung Jawab</td>
                                <td style="width: 9.82955px;">:</td>
                                <td style="width: 337.102px;">&nbsp;{{$proyek->pj}}</td>
                            </tr>
                            <tr style="height: 25px;">
                                <td style="width: 162.557px;">Lokasi</td>
                                <td style="width: 9.82955px;">:</td>
                                <td style="width: 337.102px;">&nbsp;{{$proyek->lokasi}}</td>
                            </tr>

                        </tbody>
                    </table>

                </td>
            </tr>
            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <table style="border-collapse: collapse; width: 100%; font-size:12px;" border="1" padding="200px">
                        <tbody>
                            <tr>
                                <td colspan="4"><b>BARANG</b></td>

                            </tr>
                            <tr align="center">
                                <td class="width-10"><b>No.</b></td>
                                <td class="width-10"><b>NAMA BARANG</b></td>
                                <td><b>SATUAN</b></td>
                                <td><b>JUMLAH</b></td>
                            </tr>
                            @foreach($barang as $dt)
                            <tr>
                                <td class="width-60" align="center">{{$loop->iteration}}</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->barang->nama}} ({{$dt->barang->merk}})</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->barang->satuan_detail->satuan}}</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->jumlah}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>


                    </blockquote>
                </td>
            </tr>

            <tr style="height: 45px;">
                <td style="width: 100%; height: 45px; ">
                    <table style="border-collapse: collapse; width: 100%; font-size:12px; margin-top:20px" border="1" padding="200px">
                        <tbody>
                            <tr>
                                <td colspan="4"><b>PERALATAN</b></td>

                            </tr>
                            <tr align="center">
                                <td class="width-10"><b>No.</b></td>
                                <td class="width-10"><b>NAMA PERALATAN</b></td>
                                <td><b>SATUAN</b></td>
                                <td><b>JUMLAH</b></td>
                            </tr>
                            @foreach($alat as $dt)
                            <tr>
                                <td class="width-60" align="center">{{$loop->iteration}}</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->alat->nama}} ({{$dt->alat->merk}})</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->alat->satuan_detail->satuan}}</td>
                                <td align="center" style="padding-left: 5px; padding-top: 5px;padding-bottom: 5px; padding-right: 5px;">{{$dt->jumlah}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>


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