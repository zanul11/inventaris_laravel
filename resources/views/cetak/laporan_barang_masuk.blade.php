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

        @media print {
            table tr.highlighted>td {
                background-color: yellow !important;
            }
        }
    </style>
</head>

<body onload="cetak()">
    <table style="border-collapse: collapse; width: 100%; height: 191px; padding: 20px;" border="0">
        <tbody>
            <tr style="height: 146px;">
                <td style="width: 100%; height: 146px;">
                    <p><img style="display: block; margin-left: auto; margin-right: auto;" src="{{asset('assets/img/logo.png')}}" alt="logo" width="70" height="70" /></p>
                    <p style="text-align: center; font-size: 14px;"><strong><u>LAPORAN BARANG MASUK {{$ket_waktu}}</u></strong></p>
                </td>
            </tr>
            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <table style="border-collapse: collapse; width: 100%; font-size:12px;" border="1" padding="15px">
                        <thead>
                            <tr>

                                <td align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;" class="width-10" rowspan="2"><b>NO</b></td>
                                <td align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;" rowspan="2"><b>NAMA BARANG</b></td>
                                <td align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;" rowspan="2"><b>SATUAN</b></td>
                                <td align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;" rowspan="2"><b>JUMLAH MASUK</b></td>
                                <td align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;" rowspan="2"><b>TGL MASUK</b></td>
                                <td align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;" rowspan="2"><b>KETERANGAN</b></td>

                            </tr>

                        </thead>
                        <tbody>
                            @foreach($array_barang as $dt)
                            <tr align="center">

                                <th colspan="6" align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;">
                                    {{$dt->jenis}}
                                </th>
                            </tr>
                            @php
                            $total = 0;
                            @endphp
                            @foreach($dt->barang as $brg)
                            @foreach($brg->log_masuk as $log)
                            <tr align="center">
                                <td align="center" style="padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;">{{$loop->iteration}}</td>
                                <td align="center" style="padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;">{{$brg->detail->nama}}</td>
                                <td align="center" style="padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;">{{$brg->detail->satuan_detail->satuan}}</td>
                                <td align="center" style="padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;">{{$log->jumlah}}</td>
                                <td align="center" style="padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;">{{date('d-m-Y', strtotime($log->tgl))}}</td>
                                <td align="center" style="padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;">{{$log->ket}}</td>
                            </tr>
                            @php
                            $total +=$log->jumlah ;
                            @endphp
                            @endforeach
                            @endforeach
                            <tr class="rowss">
                                <td align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;" colspan="3"><b>TOTAL<b></td>
                                <td align="center" style="padding-left: 3px; padding-top: 3px;padding-bottom: 3px; padding-right: 3px;">
                                    <b> {{$total}}</b>
                                </td>
                                <td></td>
                                <td></td>
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