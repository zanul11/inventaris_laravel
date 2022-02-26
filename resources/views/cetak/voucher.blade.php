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
    function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) { $temp=" " . $huruf[$nilai]; } else if ($nilai <20) { $temp=penyebut($nilai - 10). " belas" ; } else if ($nilai < 100) { $temp=penyebut($nilai/10)." puluh". penyebut($nilai % 10); } else if ($nilai < 200) { $temp=" seratus" . penyebut($nilai - 100); } else if ($nilai < 1000) { $temp=penyebut($nilai/100) . " ratus" . penyebut($nilai % 100); } else if ($nilai < 2000) { $temp=" seribu" . penyebut($nilai - 1000); } else if ($nilai < 1000000) { $temp=penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000); } else if ($nilai < 1000000000) { $temp=penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000); } else if ($nilai < 1000000000000) { $temp=penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000)); } else if ($nilai < 1000000000000000) { $temp=penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000)); } return $temp; } function terbilang($nilai) { if($nilai<0) { $hasil="minus " . trim(penyebut($nilai)); } else { $hasil=trim(penyebut($nilai)); } return $hasil; } @endphp @foreach($dataRkk as $dt)<br>
        <p style="text-align: center;"><strong><span style="text-decoration: underline;">VOUCHER KAS KECIL</span></strong></p>

        <table border="0" style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 100%;">
                        <table border="0" style="height: 247px; width: 100%; border-collapse: collapse; font-size: 12px;">
                            <tbody>
                                <tr style="height: 43px;">
                                    <td style="width: 100%; height: 43px;">
                                        <table border="0" style="height: 40px; width: 45.3097%; border-collapse: collapse; float: right; font-size: 12px;">
                                            <tbody>
                                                <tr style="height: 20px;">
                                                    <td style="width: 15.4572%; height: 20px;">Nomor</td>
                                                    <td style="width: 3.42179%; height: 20px;">:</td>
                                                    <td style="width: 26.4306%; height: 20px;">&nbsp;{{(strlen($loop->iteration)>1)?$loop->iteration:'0'.$loop->iteration}}/KK/{{$bulanRomawi[date("n")]}}/2021</td>
                                                </tr>
                                                <tr style="height: 20px;">
                                                    <td style="width: 15.4572%; height: 20px;">Tanggal</td>
                                                    <td style="width: 3.42179%; height: 20px;">:</td>
                                                    <td style="width: 26.4306%; height: 20px;">&nbsp;{{date('d F Y',strtotime($kwitansi->tgl))}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="height: 20px;">
                                    <td style="width: 100%; height: 20px;"></td>
                                </tr>
                                <tr style="height: 131px;">
                                    <td style="width: 100%; height: 131px;">
                                        <table border="0" style="width: 100%; border-collapse: collapse; border-style: solid; font-size: 12px;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30.6785%; padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">Dibayar kepada</td>
                                                    <td style="width: 3.24474%; padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">:</td>
                                                    <td style="width: 66.0767%; padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 5px; border-bottom: 1px solid black;">&nbsp;Wawan Supryadi</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30.6785%; padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">Jumlah Uang</td>
                                                    <td style="width: 3.24474%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">:</td>
                                                    <td style="width: 66.0767%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 5px; border-bottom: 1px solid black;">&nbsp;Rp. {{number_format($dt->jumlah)}} &nbsp;&nbsp;{{ucfirst(terbilang($dt->jumlah))}} rupiah</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30.6785%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">Untuk Keperluan</td>
                                                    <td style="width: 3.24474%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">:</td>
                                                    <td style="width: 66.0767%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 5px; border-bottom: 1px solid black;">&nbsp;{{$dt->penjelasan}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30.6785%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">Atas Beban Rekening</td>
                                                    <td style="width: 3.24474%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">:</td>
                                                    <td style="width: 66.0767%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 5px; border-bottom: 1px solid black;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30.6785%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">Diterima Sebesar</td>
                                                    <td style="width: 3.24474%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">:</td>
                                                    <td style="width: 66.0767%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 5px; border-bottom: 1px solid black;">&nbsp;Rp. {{number_format($dt->jumlah)}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30.6785%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">Dengan huruf</td>
                                                    <td style="width: 3.24474%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 2px;">:</td>
                                                    <td style="width: 66.0767%;padding-left: 2px; padding-top: 4px;padding-bottom: 4px; padding-right: 5px; border-bottom: 1px solid black;;">&nbsp;{{ucfirst(terbilang($dt->jumlah))}} rupiah</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="height: 13px;">
                                    <td style="width: 100%; height: 13px;"></td>
                                </tr>
                                <tr style="height: 20px;">
                                    <td style="width: 100%; height: 20px;">
                                        <table border="0" style="height: 120px; width: 39.2897%; border-collapse: collapse; float: right; font-size: 12px;">
                                            <tbody>
                                                <tr style="height: 20px;">
                                                    <td style="width: 100%; height: 20px; text-align: center;">Disetujui Oleh :</td>
                                                </tr>
                                                <tr style="height: 20px;">
                                                    <td style="width: 100%; height: 20px; text-align: center;">Direktur Umum &amp; Keuangan</td>
                                                </tr>
                                                <tr style="height: 20px;">
                                                    <td style="width: 100%; text-align: center; height: 20px;">PT. Air Minum Giri Menang</td>
                                                </tr>
                                                <tr style="height: 20px;">
                                                    <td style="width: 100%; height: 20px;"></td>
                                                </tr>
                                                <tr style="height: 20px;">
                                                    <td style="width: 100%; height: 20px;"></td>
                                                </tr>
                                                <tr style="height: 20px;">
                                                    <td style="width: 100%; height: 20px;"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="height: 20px;">
                                    <td style="width: 100%; height: 20px;">
                                        <table border="0" style="width: 100%; border-collapse: collapse; font-size: 12px;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 12.0796%;">Nama</td>
                                                    <td style="width: 2.87615%;">:</td>
                                                    <td style="width: 45.708%;">&nbsp;Wawan Supryadi</td>
                                                    <td style="width: 39.3363%; text-align: center;"><span style="text-decoration: underline;">Aini Kurniati</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 12.0796%;">Tangal</td>
                                                    <td style="width: 2.87615%;">:</td>
                                                    <td style="width: 45.708%;">&nbsp;{{date('d F Y',strtotime($kwitansi->tgl))}}</td>
                                                    <td style="width: 39.3363%; text-align: center;">NIK. 99 04 159</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 100%;"><br><br>QR-UM.RT/06-02</td>
                                </tr>
                                <tr>
                                    <td style="width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 100%; text-align: center;"><br><br>----------------------------------------------------------------------------------------------------------------------------------------------</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        @if($loop->iteration%2==0)
        <div style='page-break-before: always;'></div>
        @endif
        @endforeach

        <!-- <p style="text-align: center;"><strong><span style="text-decoration: underline;"></span></strong></p>
        <p style="text-align: center; page-break-after: always;"><strong><span style="text-decoration: underline;"></span></strong></p> -->

        <script type="text/javascript">
            function cetak() {
                window.print();
            };
        </script>


</body>

</html>