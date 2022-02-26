app = angular.module("app", []);

app.controller("BarangKeluarController", [
    "$scope",
    "$http",
    function VerifikasiController($scope, $http) {
        $scope.detail_kwitansi = [];
        $scope.kwitansi = [];
        $scope.harga = 0;
        $scope.jumlahHarga = 0;
        $scope.ket = '';
        $scope.kode;


        $scope.init = function(kodes)
        {
            $scope.kode=kodes;
                //cek apakah ada yang sudah tersimpan
                $http({
                    method: "POST",
                    data: {
                        kode : kodes,
                    },
                    url: "/kas/get-selected-kas"
                }).then(res => {
                    $scope.jumlahHarga = res.data.jumlah;
                    angular.forEach(res.data.kwitansi, function(dt) {
                        // console.log($scope.kwitansi);
                        $scope.detail_kwitansi.push({
                            kode : dt['kode'],
                            tgl: dt['tgl'],
                            kwitansis:dt['kwitansis'],
                            jumlah:dt['jumlah']
                        });
                    });
                //    console.log(res);
                });
        }
        


        $http({
            method: "GET",
            url: "/kas/get-kwitansi-all"
        }).then(res => {
            angular.forEach(res.data, function(dt) {
                // console.log($scope.kwitansi);
                $scope.kwitansi.push({
                    kode : dt['kode'],
                    tgl: dt['tgl'],
                    kwitansis:dt['kwitansis'],
                    jumlah:dt['jumlah']
                });
            });
            // $scope.kwitansi = res.data;
          
        });

        $scope.pilihItem = function(index, i){
            $scope.kwitansi.splice(i, 1);
            $scope.detail_kwitansi.push({
                kode : index['kode'],
                tgl: index['tgl'],
                kwitansis:index['kwitansis'],
                jumlah:index['jumlah']
            });
            $scope.jumlahHarga+=index['jumlah'];
            console.log(index);
           
        }

        $scope.removeItem = function(index, i) {
                  $scope.detail_kwitansi.splice(i, 1);
                $scope.kwitansi.push({
                    kode : index['kode'],
                    tgl: index['tgl'],
                    kwitansis:index['kwitansis'],
                    jumlah:index['jumlah']
                });
                $scope.jumlahHarga-=index['jumlah'];
        };

        $scope.submitData = function() {
            console.log($scope.detail_kwitansi.length);
             if($scope.detail_kwitansi.length==0){
                Swal.fire(
                    "Warning!",
                    "Pilih Kwitansi!",
                    "warning"
                );
            }else {
                $http({
                    url: "/kas/edit",
                    method: "POST",
                    data: {
                        kwitansi : $scope.detail_kwitansi,
                        kode : $scope.kode,
                    }
                }).then(function(res){
                   console.log(res);
                    Swal.fire(
                        "Success",
                        "Data Kas Kecil berhasil diupdate",
                        "success"
                        ).then(result => {
                            window.location='/kas';
                        });
                });

                 
            }
        }
    }
]);
