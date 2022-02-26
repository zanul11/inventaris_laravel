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
                    <p style="text-align: center; font-size: 14px;"><strong><u>PERMINTAAN BARANG</u></strong></p>
                </td>
            </tr>
            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <table style="border-collapse: collapse; width: 100%;" border="1" padding="5px">
                        <tbody>
                            <tr>
                                <td style="width: 55.914%; height: 30px;" colspan="2">Nama Barang :&nbsp; {{$barang->nama}} / {{$barang->merk}}</td>
                                <td style="width: 44.086%; height: 30px;" colspan="3">Ukuran : {{$barang->ukuran}}</td>
                            </tr>
                            <tr>
                                <td style="width: 55.914%; height: 30px;" colspan="2">Satuan : {{$barang->satuan_detail->satuan}}</td>
                                <td style="width: 44.086%; height: 30px;" colspan="3">Kode : {{$barang->kode}}</td>
                            </tr>
                            <tr>
                                <td style="width: 18.4946%; text-align: center; height: 25px;">Tanggal</td>
                                <td style="width: 37.4194%; text-align: center; height: 25px;">Bukti</td>
                                <td style="width: 24.5053%; text-align: center; height: 25px;">Diterima</td>
                                <td style="width: 5.38709%; text-align: center; height: 25px;">Dikeluarkan</td>
                                <td style="width: 14.1936%; text-align: center; height: 25px;">Sisa</td>
                            </tr>
                            @foreach($kartu_barang as $dt)
                            <tr>
                                <td style="width: 18.4946%; text-align: center; height: 21px;">{{date('d-m-Y',strtotime($dt->tgl))}}</td>
                                <td style="width: 37.4194%; text-align: center; height: 21px;">{{$dt->kode}}</td>
                                <td style="width: 24.5053%; text-align: center; height: 21px;">{{$dt->diterima}}</td>
                                <td style="width: 5.38709% ; text-align: center; height: 21px;">{{$dt->dikeluarkan}}</td>
                                <td style="width: 14.1936%; text-align: center; height: 21px;">{{$dt->sisa}}</td>
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