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
    @php
    $bulanRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    @endphp
    <table style="border-collapse: collapse; width: 100%; height: 191px; padding: 20px;" border="0">
        <tbody>
            <tr style="height: 146px;">
                <td style="width: 100%; height: 146px;">
                    <p><img style="display: block; margin-left: auto; margin-right: auto;" src="{{asset('assets/img/logo.png')}}" alt="logo" width="70" height="70" /></p>
                    <!-- <p style="text-align: center; font-size: 14px;"><strong><u>LAPORAN RKK</u></strong></p> -->
                </td>
            </tr>
            <tr>
                <table style="width: 100%; border-collapse: collapse; margin-top: -70px; font-size: 12px; margin-bottom: 10px;" border="0">
                    <tbody>
                        <tr>
                            <td colspan="3">REKAPITULASI KAS KECIL</td>
                        </tr>
                        <tr>
                            <td style="width: 19.7849%;">NOMOR</td>
                            <td style="width: 3.87095%;">:</td>
                            <td style="width: 76.3441%;">&nbsp;{{(strlen($kas->no)>1)?$kas->no:'0'.$kas->no}}/{{$bulanRomawi[date("n")]}}/KK/2021</td>
                        </tr>
                        <tr>
                            <td style="width: 19.7849%;">TANGAL</td>
                            <td style="width: 3.87095%;">:</td>
                            <td style="width: 76.3441%;">&nbsp;{{date('d F Y',strtotime($kwitansi->tgl))}}</td>
                        </tr>
                        <tr></tr>
                    </tbody>
                </table>
            </tr>

            <tr style="height: 45px; ">
                <td style="width: 100%; height: 45px; ">
                    <table style="border-collapse: collapse; width: 100%; font-size:12px;" border="1" padding="15px">
                        <tbody>
                            <tr align="center">
                                <td rowspan="3"><b>No.</b></td>
                                <td rowspan="3"><b>PENJELASAN</b></td>
                                <td rowspan="3"><b>JUMLAH PEMBAYARAN (RP)</b></td>
                                <td colspan="8"><b>PERINCIAN PERKIRAAN</b></td>
                            </tr>
                            <tr align="center">
                                <td rowspan="2"><b>( Rp )</b></td>
                                <td rowspan="2"><b>( Rp )</b></td>
                                <td rowspan="2"><b>( Rp )</b></td>
                                <td rowspan="2"><b>( Rp )</b></td>
                                <td rowspan="2"><b>( Rp )</b></td>
                                <td rowspan="2"><b>( Rp )</b></td>
                                <td colspan="2"><b>RUPA-RUPA</b></td>
                            </tr>
                            <tr align="center">
                                <td><b>No. Perk (Rp)</b></td>
                                <td><b>Jumlah (Rp)</b></td>
                            </tr>
                            @php $total=0; @endphp


                            @foreach($dataRkk as $dt)
                            <tr>
                                <td align="center" style="width: 3%;padding-left: 1px; padding-top: 1px;padding-bottom: 1px; padding-right: 1px;">{{$loop->iteration}}</td>
                                <td style="width: 30%; padding-left: 5px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;">{{$dt->penjelasan}} (Nota Terlampir)</td>
                                <td align="right" style="width: 10%; text-align: rigth; height: 25px;  padding-right: 3px;">{{number_format($dt->jumlah)}}</td>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>

                            </tr> @php $total+=$dt->jumlah; @endphp



                            @endforeach
                            <tr>
                                <td style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"></td>
                                <td align="center" style="width: 5%; padding-left: 2px;  padding-top: 2px;padding-bottom: 2px; padding-right: 2px;"><b>JUMLAH</b></td>
                                <td align="right" style="width: 5%; padding-left: 2px; padding-top: 2px;padding-bottom: 2px; padding-right: 2px; text-align: rigth;"><b>{{number_format($total)}}</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>

                        </tbody>
                    </table>
                    <p style="text-align: left; font-size: 12px;">QR-UM.RT/06-03</p>

                    <table style="width: 100%; border-collapse: collapse; font-size: 12px;" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 50%; text-align: center;">Disetujui Oleh :</td>
                                <td style="width: 50%; text-align: center;">Disiapkan Oleh :</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: center;">Direktur Umum &amp; Keuangan</td>
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
                                <td style="width: 50%; text-align: center;">Aini Kurniati</td>
                                <td style="width: 50%; text-align: center;">Wawan Supryadi</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: center;">NIK. 99 04 159</td>
                                <td style="width: 50%; text-align: center;">NIK. 2007 04 238</td>
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
            // window.print();
        };
    </script>


</body>

</html>