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
    <table style="border-collapse: collapse; width: 65%; height: 191px; padding: 20px;" border="0">
        <tbody>
            <tr style="height: 146px;">
                <td style="width: 100%; height: 146px;">
                    <p><img style="display: block; margin-left: auto; margin-right: auto;" src="{{asset('assets/img/logo.png')}}" alt="logo" width="70" height="70" /></p>
                    <p style="text-align: center; font-size: 14px;"><strong><u>PERMINTAAN BARANG</u></strong></p>
                </td>
            </tr>
            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <table style="margin-left: 20px; width: 100% margin; border-collapse: collapse; font-size: 14px;" border="0">
                        <tbody>
                            <tr style="height: 25px;">
                                <td style="width: 162.557px;">Nomor</td>
                                <td style="width: 9.82955px;">:</td>
                                <td style="width: 337.102px;">&nbsp;{{$barang->kode}}</td>
                            </tr>
                            <tr style="height: 25px;">
                                <td style="width: 162.557px;">Tanggal</td>
                                <td style="width: 9.82955px;">:</td>
                                <td style="width: 337.102px;">&nbsp;{{$barang->created_at->format('d-m-Y')}}</td>
                            </tr>
                            <tr style="height: 25px;">
                                <td style="width: 162.557px;">Nama</td>
                                <td style="width: 9.82955px;">:</td>
                                <td style="width: 337.102px;">&nbsp;{{$barang->pj}}</td>
                            </tr>

                        </tbody>
                    </table>
                    <h5 style="margin-left: 20px; font-size: 12px;"><strong>DAFTAR BARANG :</strong></h5>
                    <div style="margin-right:20px;margin-left:20px">
                        <table style="border-collapse: collapse; width: 100%; height: 45px; font-size: 14px;" border="1">
                            <tbody>
                                <tr style="height: 24px;">
                                    <td style="width: 6.49635%; text-align: center; height: 24px;"><strong>NO</strong></td>
                                    <td style="width: 33.5036%; text-align: center; height: 24px;"><strong>NAMA BARANG</strong></td>
                                    <td style="width: 32.7737%; text-align: center; height: 24px;"><strong>JUMLAH PERMINTAAN</strong></td>
                                    <td style="width: 13.7956%; text-align: center; height: 24px;"><strong>SATUAN</strong></td>
                                    <td style="width: 13.4307%; text-align: center; height: 24px;"><strong>KETERANGAN</strong></td>
                                </tr>
                                @foreach($barang->barangs as $dt)
                                <tr style="height: 21px;">
                                    <td style="width: 6.49635%; text-align: center; height: 21px;">&nbsp;{{$loop->iteration}}</td>
                                    <td style="width: 33.5036%; text-align: center; height: 21px;">&nbsp;{{$dt->barang->nama}}</td>
                                    <td style="width: 32.7737%; text-align: center; height: 21px;">&nbsp;{{$dt->jumlah}}</td>
                                    <td style="width: 13.7956%; text-align: center; height: 21px;">&nbsp;{{$dt->barang->satuan_detail->satuan}}</td>
                                    <td style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;{{$dt->ket}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p>&nbsp;</p>
                    </div>
                    <table style="width: 100%; border-collapse: collapse; font-size: 12px;" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 33.3333%; text-align: center;">

                                </td>
                                <td style="width: 33.3333%;">

                                </td>
                                <td style="width: 33.3333%;">
                                    <p style="text-align: center;">Diminta oleh :</p>

                                    <p style="text-align: center;">&nbsp;{!!'<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('Diminta oleh : '.$barang->pj, 'QRCODE', 2,2) . '" alt="barcode" />'!!}</p>

                                </td>
                            </tr>
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