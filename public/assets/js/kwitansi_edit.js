app = angular.module("app", []);

app.controller("BarangKeluarController", [
    "$scope",
    "$http",
    function VerifikasiController($scope, $http) {
        $scope.detail_kwitansi = [];
     
        $scope.bidangs = [];
        $scope.pegawais = [];
        $scope.jenis_kwitansi = [];
        $scope.harga = 0;
        $scope.jumlahHarga = 0;
        $scope.ket = '';
        $scope.jumlahJenisKwitansi = 0;

        $scope.init = function(kode,pj, diterima, token, tgl, jenis)
        {
            $scope.tgl=new Date(tgl);
            $http({
                method: "GET",
                url: "/get-bidang"
            }).then(res => {
                $scope.bidangs = res.data;
                // $scope.selectedBarang= $scope.barangs[0];
                angular.forEach($scope.bidangs, function(dt) {
                    // console.log(dt);
                    if(dt['kd_bagian']==diterima){
                        $scope.selectedBidang=dt;
                        // console.log(dt);
                    }
                });
            });

            $http({
                url: "/get-jumlah-jenis",
                method: "POST",
                data: {
                    jenis : jenis
                }
            }).then(res => {
                $scope.jumlahJenisKwitansi = parseInt(res.data);
                //   console.log(res);
            });

            $http({
                method: "GET",
                url: "/get-jenis-kwitansi"
            }).then(res => {
                $scope.jenis_kwitansi = res.data;
                angular.forEach($scope.jenis_kwitansi, function(dt) {
                    if(dt['id']==jenis){
                        $scope.selectedJenis=dt;
                    }
                });
            });
    
            $http({
                method: "GET",
                url: "/get-pegawai"
            }).then(res => {
                $scope.pegawais = res.data;
                // $scope.selectedPegawai= $scope.pegawais[0];
                angular.forEach($scope.pegawais, function(dt) {
                    // console.log(dt);
                    if(dt['nip']==pj){
                        $scope.selectedPegawai=dt;
                        // console.log(dt);
                    }
                });
            });
          
            $http({
                url: "/kwitansi/get-detail-barang",
                method: "POST",
                data: {
                    kode : kode,
                }
                }).then(res => {
                    // console.log(res);
                    angular.forEach(res.data, function(dt) {
                        console.log(dt);
                        $scope.jumlahHarga = dt['jumlah'];
                        $scope.detail_kwitansi.push({
                            harga: dt['harga'],
                            ket:dt['ket'],
                        });
                    });
                });
            $scope.kode=kode;
        }


        $scope.pilihJenis = function() {
            $http({
                url: "/get-jumlah-jenis",
                method: "POST",
                data: {
                    jenis : $scope.selectedJenis.id
                }
            }).then(res => {
                if((parseInt(res.data)+$scope.jumlahHarga)>15000000){
                    Swal.fire(
                        "Warning!",
                        "Jumlah Total Jenis Kwitansi Lebih 15.000.000!",
                        "warning"
                    );
                    $scope.jumlahJenisKwitansi = parseInt(res.data);
                }else {
                    $scope.jumlahJenisKwitansi = parseInt(res.data);
                }
            });
        }

        $scope.insertTabel = function() {
  
            if($scope.harga==0 || $scope.harga==undefined){
                   Swal.fire(
                       "Warning!",
                       "Field Jumlah masih 0!",
                       "warning"
                   );
               }
              else {
                   angular.forEach($scope.detail_kwitansi, function(dt) {
                       if(dt['ket']==$scope.ket){
                           $scope.cek=true;
                       }
                   });
                   if(!$scope.cek){
                       $tmpTotal=$scope.jumlahHarga+$scope.harga;
                       $tmpTotalJenis = $scope.jumlahJenisKwitansi+$tmpTotal;
                       if($tmpTotalJenis>15000000){
                           Swal.fire(
                               "Warning!",
                               "Jumlah Total Jenis Kwitansi Lebih 15.000.000!",
                               "warning"
                           );
                       }else {
                           $scope.jumlahHarga+=$scope.harga;
                           $scope.detail_kwitansi.push({
                               harga: $scope.harga,
                               ket:$scope.ket,
                           });
                       }
                      
                   }else {
                       $scope.detail_kwitansi.find(function(v) {
                           $tmpJum=v.harga;
                           $tmpKet=v.ket;
                           $scope.jumlahHarga-=v.harga;
                           $scope.jumlahHarga+=$scope.harga;
                           $tmpTotal=$scope.jumlahHarga+$scope.harga;
                           $tmpTotalJenis = $scope.jumlahJenisKwitansi+$tmpTotal;
                           if($tmpTotalJenis>15000000){
                               Swal.fire(
                                   "Warning!",
                                   "Jumlah Total Jenis Kwitansi Lebih 15.000.000!",
                                   "warning"
                               );
                               $scope.jumlahHarga-=$scope.harga;
                               $scope.harga=v.harga;
                               $scope.jumlahHarga+=v.harga;
                           }
                           return v.ket == $scope.ket;
                         }).harga = ($scope.harga);
   
                       //   $scope.detail_kwitansi.find(function(v) {
                       //     return v.nama == $scope.ket;
                       //   }).ket = $scope.ket;
                   }
                   $scope.harga = 0;
                   $scope.ket = '';
               }
               
           };

        $scope.removeItem = function(index) {
            $scope.jumlahHarga-=($scope.detail_kwitansi[index]["harga"]);
            $scope.detail_kwitansi.splice(index, 1);
        };

        $scope.submitData = function() {
            console.log($scope.detail_kwitansi.length);
            if($scope.selectedPegawai==undefined){
                Swal.fire(
                    "Warning!",
                    "Pilih Pegawai!",
                    "warning"
                );
            }
            else if($scope.tgl==null){
                Swal.fire(
                    "Warning!",
                    "Pilih Tanggal Kwitansi!",
                    "warning"
                );
            }
            else if($scope.selectedJenis==undefined||$scope.selectedJenis==null){
                Swal.fire(
                    "Warning!",
                    "Pilih Jenis Kwitansi!",
                    "warning"
                );
            }
            else if($scope.detail_kwitansi.length==0){
                Swal.fire(
                    "Warning!",
                    "Pilih Permintaan Barang!",
                    "warning"
                );
            }else {
                $http({
                    url: "/kwitansi/edit",
                    method: "POST",
                    data: {
                        kode : $scope.kode,
                        pegawai: $scope.selectedPegawai.nip,
                        diterima: $scope.selectedPegawai.kd_bagian,
                        kwitansi : $scope.detail_kwitansi,
                        total : $scope.jumlahHarga,
                        tgl: $scope.tgl,
                        jenis : $scope.selectedJenis.id
                    }
                }).then(res => {
                       Swal.fire(
                    "Success",
                    "Data Kwitansi berhasil di-Update",
                    "success"
                    ).then(result => {
                        window.location='/kwitansi';
                    });
                });

               
            }
        }
    }
]);
