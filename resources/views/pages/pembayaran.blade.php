<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=21cm, initial-scale=1">
    <meta name="description" content="Sistem Informasi Akademik Universitas Mataram">
    <meta name="author" content="Universitas Mataram">
    <title>Cetak KRS Mahasiswa (terkini) » Sistem Informasi Akademik</title>
    <link rel="stylesheet" href="https://sia.unram.ac.id/assets/styles/bootstrap.min.css?151bac3a70079f3ed3248fac77af0e07">
    <link rel="stylesheet" href="https://sia.unram.ac.id/assets/styles/font-awesome.min.css?151bac3a70079f3ed3248fac77af0e07">
    <link rel="stylesheet" href="https://sia.unram.ac.id/assets/styles/style.css?151bac3a70079f3ed3248fac77af0e07">
    <link rel="stylesheet" href="{{asset('assets/css/cetak.css')}}">
    <link rel="stylesheet" href="https://sia.unram.ac.id/assets/styles/print.css?151bac3a70079f3ed3248fac77af0e07">
    <link rel="shortcut icon" type="image/png" href="https://sia.unram.ac.id/assets/images/favicon.png" sizes="16x16">
    <link rel="apple-touch-icon" href="https://sia.unram.ac.id/assets/images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="https://sia.unram.ac.id/assets/images/favicon.png">
    <style>
        borderless td,
        .borderless th {
            border: none;
        }
    </style>
</head>

<body class="view mahasiswa halaman">
    <div class="container-fluid cetak krs">
        <div class="row">
            <div id="header">
                <div id="logofakultas" style="margin-top: 10px;">
                    <img src="{{asset('assets/img/logo.png')}}" height="10%">
                </div>
                <center style="margin-top: 0px;">
                    <b style="font-size: 8px;">
                        PUSAT PELATIHAN DAN PENGEMBANGAN PROFESI MATARAM (P4M)<br>
                    </b>
                    <div style="font-size: 8px;">Jln. Airlangga No.8 Telp. (0370) 631632 Mataram e-mail : p4mmataram@yahoo.com
                    </div>
                    <div style="font-size: 8px;"><b>Terakreditasi BAN-PNF</b>
                    </div>
                    <div style="font-size: 8px;"><b>SK Nomor : 013,14/SKEP/STS-AKR/BAN PNF/XII/2019</b>
                    </div>
                </center>
            </div>
            <center>
                <table class="table " style="margin-top: 10px; font-size: 6px;">
                    <tbody>
                        <tr>
                            <td align="center"><b>Program Pendidikan</b><br>
                                - Program Pendidikan I Tahun Komputer Perkantoran
                                <br>
                                - Program Pendidikan I Tahun Sekretaris
                                <br>
                                - Program Pendidikan I Tahun Administrasi Perkantoran
                                <br>
                                - Program Pendidikan I Tahun Manajeman Perhotelan<br>
                                - Program Pendidikan I Tahun Front Office</td>
                        </tr>
                    </tbody>
                </table>
            </center>
            <div style="font-size: 8px; margin-top: -10px;">
                <tr>
                    <td style="">Nama</td>
                    <td style="">:</td>
                    <td style="">Zanul Harir</td>
                </tr>
            </div>
            <br>
            <table class="table table-bordered table-striped" style="font-size: 8px;">
                <thead>
                    <tr>
                        <th>jenis Pembayaran</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pendaftaran Siswa Baru</td>
                        <td>Rp. {{number_format(250000)}}</td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="pull-left ttd">
                <br><br><br>
                <br>Ketua Program Studi,
                <br><br><br><br><br><br>
                <span class="nama">Prof. Dr.Eng. I Gede Pasek Suta Wijaya, ST., MT.</span>
                NIP. 197311302000031001 </div> -->
            <div class="pull-right ttd" style="font-size: 8px; margin-top: -10px;">
                <br>Mataram, {{date('d F Y')}}<br>
                <br>Tanda Terima
                <br><br><br><br>
                <span class="nama">Nama Penerima</span>
                <!-- NIP. 199203232019031012  -->
            </div>
        </div>
    </div>
    <script async="" src="//www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" src="https://sia.unram.ac.id/assets/scripts/jquery.min.js?151bac3a70079f3ed3248fac77af0e07"></script>
    <script type="text/javascript" src="https://sia.unram.ac.id/assets/scripts/jquery.ui.min.js?151bac3a70079f3ed3248fac77af0e07"></script>
    <script type="text/javascript" src="https://sia.unram.ac.id/assets/scripts/bootstrap.min.js?151bac3a70079f3ed3248fac77af0e07"></script>
    <script type="text/javascript" src="https://sia.unram.ac.id/assets/scripts/ga.js?151bac3a70079f3ed3248fac77af0e07"></script>
    <script type="text/javascript">
        // $(document).ready(function() {
        //     window.print();
        // });
    </script>
</body>

</html>