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
                    <p style="text-align: center; font-size: 14px;"><strong><u>LAPORAN BARANG</u></strong></p>
                </td>
            </tr>
            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <table style="border-collapse: collapse; width: 100%; font-size:12px;" border="1" padding="15px">
                        <tbody>
                            <tr align="center">
                                <td class="width-10" rowspan="2"><b>No.</b></td>
                                <td rowspan="2"><b>JENIS BARANG</b></td>
                                <td rowspan="2"><b>SATUAN</b></td>
                                <td colspan="4"><b>JUMLAH</b></td>
                            </tr>
                            <tr align="center">
                                <td><b>SALDO AWAL</b></td>
                                <td><b>MASUK</b></td>
                                <td><b>KELUAR</b></td>
                                <td><b>SALDO AKHIR</b></td>
                            </tr>
                            @foreach($array_barang as $dt)
                            <tr>
                                <td align="center"> <b>{{$loop->iteration}} </b></td>
                                <td colspan="7">
                                    <b>&nbsp;&nbsp;{{$dt->jenis}}<b>
                                </td>
                            </tr>
                            @php
                            $total = 0;
                            @endphp
                            @foreach($dt->barang as $brg)

                            <tr>
                                <td align="center" style="padding-left: 1px; padding-top: 1px;padding-bottom: 1px; padding-right: 1px;">{{$loop->iteration}}</td>
                                <td>&nbsp;&nbsp;{{$brg->detail->nama}}</td>
                                <td align="center" style="padding-left: 1px; padding-top: 1px;padding-bottom: 1px; padding-right: 1px;">{{$brg->detail->satuan_detail->satuan}}</td>
                                <td align="center" style="padding-left: 1px; padding-top: 1px;padding-bottom: 1px; padding-right: 1px;">{{$brg->detail->stok-($brg->log_masuk-$brg->log_keluar)}}</td>
                                <td align="center" style="padding-left: 1px; padding-top: 1px;padding-bottom: 1px; padding-right: 1px;">{{$brg->log_masuk}}</td>
                                <td align="center" style="padding-left: 1px; padding-top: 1px;padding-bottom: 1px; padding-right: 1px;">{{$brg->log_keluar}}</td>
                                <td align="center" style="padding-left: 1px; padding-top: 1px;padding-bottom: 1px; padding-right: 1px;">{{$brg->detail->stok}}</td>
                            </tr>
                            @php
                            $total +=$brg->detail->stok ;
                            @endphp
                            @endforeach
                            <tr align="center" style="background-color:grey; ">
                                <td colspan="6"><b>TOTAL</b></td>
                                <td>
                                    <b>{{$total}}</b>
                                </td>
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