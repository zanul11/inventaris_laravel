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
    <style type="text/css">
        .table {
            margin-right: 20px;
            margin-left: 20px;
        }

        thead {
            display: table-header-group;
            margin-top: 100px;
        }
    </style>
</head>

<body onload="cetak()">
    <table style="border-collapse: collapse; width: 100%; height: 191px; padding: 20px;" border="0">
        <tbody>
            <tr style="height: 146px;">
                <td style="width: 100%; height: 146px;">
                    <p><img style="display: block; margin-left: auto; margin-right: auto;" src="{{asset('assets/img/logo.png')}}" alt="logo" width="70" height="70" /></p>
                    <p style="text-align: center; font-size: 14px;"><strong><u>KAS KECIL</u></strong></p>
                </td>
            </tr>
            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <div style="margin-right:20px;margin-left:20px">
                        <table style="border-collapse: collapse; width: 100%; height: 45px; font-size: 12px;" border="1">
                            <thead>
                                <tr style="height: 24px;">
                                    <td style="width:  13.4307%; text-align: center; height: 24px;"><strong>TANGGAL</strong></td>
                                    <td style="width: 36.7737%; text-align: center; height: 24px;"><strong>URAIAN</strong></td>
                                    <td style="width: 16.7956%; text-align: center; height: 24px;"><strong>DEBET</strong></td>
                                    <td style="width: 14.4307%; text-align: center; height: 24px;"><strong>KREDIT</strong></td>
                                    <td style="width: 25.5036%; text-align: center; height: 24px;"><strong>SALDO</strong></td>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                $debet = $uang->saldo;
                                $kredit = 0;
                                $saldo = $debet;
                                @endphp
                                <tr style="height: 21px;">
                                    <td style="width: 6.49635%; text-align: center; height: 21px;">&nbsp;</td>
                                    <th style="width: 33.5036%; text-align: center; height: 21px;">
                                        SALDO
                                    </th>
                                    <th style="width: 13.7956%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($debet)}}</th>
                                    <th style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;</th>
                                    <th style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($saldo)}}</th>
                                </tr>
                                @php
                                $saldo = $uang->pengisian+$uang->saldo;
                                @endphp
                                <tr style="height: 21px;">
                                    <td style="width: 6.49635%; text-align: center; height: 21px;">&nbsp;</td>
                                    <th style="width: 33.5036%; text-align: center; height: 21px;">
                                        PENGSIAAN KEMBALI
                                    </th>
                                    <th style="width: 13.7956%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($uang->pengisian)}}</th>
                                    <th style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;</th>
                                    <th style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($saldo)}}</th>
                                </tr>
                                @foreach($kas->kwitansi as $dt)
                                @php
                                $saldo-=$dt->jumlah;
                                $kredit+=$dt->jumlah;
                                @endphp
                                <tr style="height: 21px;">
                                    <td style="width: 6.49635%; text-align: center; height: 21px;">&nbsp;{{date('d-m-Y', strtotime($dt->tgl))}}</td>
                                    <td style="width: 33.5036%; text-align: left; height: 21px;">
                                        @foreach($dt->kwitansis as $data)
                                        &nbsp;- {{$data->ket}} (Rp. {{number_format($data->harga)}})<br>
                                        @endforeach
                                    </td>
                                    <td style="width: 13.7956%; text-align: center; height: 21px;">&nbsp;</td>
                                    <td style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($dt->jumlah)}}</td>
                                    <td style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($saldo)}}</td>
                                </tr>
                                @endforeach
                                <tr style="height: 21px;">
                                    <td style="width: 6.49635%; text-align: center; height: 21px;">&nbsp;</td>
                                    <td style="width: 33.5036%; text-align: left; height: 21px;">
                                    </td>
                                    <th style="width: 13.7956%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($debet)}}</th>
                                    <th style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($kredit)}}</th>
                                    <th style="width: 13.4307%; text-align: center; height: 21px;">&nbsp;Rp. {{number_format($saldo)}}</th>
                                </tr>

                        </table>
        <tfoot style="border-collapse: collapse; width: 100%; height: 191px; padding: 20px; font-size: 12px;" border="0">
            <tr>
                <td colspan="5">QR-UM.RT/06-01</td>
            </tr>
        </tfoot>
        <p>&nbsp;</p>
        <table style="width: 100%; border-collapse: collapse; font-size: 12px;" border="0">
            <tbody>
                <tr>
                    <td style="width: 50%; text-align: center;"></td>
                    <td style="width: 50%; text-align: center;"></td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center;"></td>
                    <td style="width: 50%; text-align: center;">Asisten Manejer Rumah Tangga</td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center;">&nbsp;</td>
                    <td style="width: 50%; text-align: center;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center;">&nbsp;</td>
                    <td style="width: 50%; text-align: center;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center;"></td>
                    <td style="width: 50%; text-align: center;">Wawan Supryadi</td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center;"></td>
                    <td style="width: 50%; text-align: center;">NIK. 2007 04 238</td>
                </tr>
            </tbody>
        </table>
        </div>

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