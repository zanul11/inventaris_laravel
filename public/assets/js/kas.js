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
      

        $scope.init = function(saldo)
        {
            console.log(saldo);
            $scope.pengisian = 75000000-saldo;
        }

        //cek apakah ada yang sudah tersimpan
        $http({
            method: "GET",
            url: "/kas-tmp/getKwitansiAll"
        }).then(res => {
            angular.forEach(res.data, function(dt) {
                // console.log($scope.kwitansi);
                $scope.detail_kwitansi.push({
                    kode : dt['kode'],
                    tgl: dt['kwitansi']['tgl'],
                    kwitansis:dt['kwitansi']['kwitansis'],
                    jumlah:dt['kwitansi']['jumlah']
                });
                $scope.jumlahHarga+= dt['kwitansi']['jumlah'];
            });
            // $scope.kwitansi = res.data;
          
        });


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

        $scope.pilihSemua = function(){
               
                $http({
                    url: "/kas-tmp/1",
                    method: "PUT",
                    data: {
                        kwitansi : $scope.kwitansi,
                    }
                }).then(function(res){
                    angular.forEach($scope.kwitansi, function(dt) {
                        $scope.detail_kwitansi.push({
                            kode : dt['kode'],
                            tgl: dt['tgl'],
                            kwitansis:dt['kwitansis'],
                            jumlah:dt['jumlah']
                        });
                        $scope.jumlahHarga+=dt['jumlah'];
                    });
                    $scope.kwitansi=[];
                });
            
        }

        $scope.hapusSemua = function(){
               
            $http({
                url: "/kas-tmp/1",
                method: "GET",
               
            }).then(function(res){
                angular.forEach($scope.detail_kwitansi, function(dt) {
                    $scope.kwitansi.push({
                        kode : dt['kode'],
                        tgl: dt['tgl'],
                        kwitansis:dt['kwitansis'],
                        jumlah:dt['jumlah']
                    });
                    $scope.jumlahHarga-=dt['jumlah'];
                });
                $scope.detail_kwitansi=[];
            });
        
        }

        $scope.pilihItem = function(index, i){
            $http({
                url: "/kas-tmp",
                method: "POST",
                data: {
                    kode : index['kode'],
                }
            }).then(function(res){
                $scope.kwitansi.splice(i, 1);
                $scope.detail_kwitansi.push({
                    kode : index['kode'],
                    tgl: index['tgl'],
                    kwitansis:index['kwitansis'],
                    jumlah:index['jumlah']
                });
                $scope.jumlahHarga+=index['jumlah'];
                console.log(index);
            });
           
        }

        $scope.removeItem = function(index, i) {
            $http({
                method: 'POST',
                url: '/kas-tmp/delete',
                data: {
                    kode: index['kode']
                },
            })
            .then(function(response) {
                console.log(response.data);
                  $scope.detail_kwitansi.splice(i, 1);
                $scope.kwitansi.push({
                    kode : index['kode'],
                    tgl: index['tgl'],
                    kwitansis:index['kwitansis'],
                    jumlah:index['jumlah']
                });
                $scope.jumlahHarga-=index['jumlah'];
            }, function(rejection) {
                console.log(rejection.data);
            });

          
        };

        $scope.submitData = function() {
            console.log($scope.detail_kwitansi.length);
             if($scope.detail_kwitansi.length==0){
                Swal.fire(
                    "Warning!",
                    "Pilih Kwitansi!",
                    "warning"
                );
            }
            else if($scope.pengisian==undefined||$scope.pengisian==null){
                Swal.fire(
                    "Warning!",
                    "Input Pengisian Saldo!",
                    "warning"
                );
            }
            else {
                $http({
                    url: "/kas",
                    method: "POST",
                    data: {
                        kwitansi : $scope.detail_kwitansi,
                        pengisian : $scope.pengisian
                    }
                }).then(function(res){
                //    console.log(res);
                    Swal.fire(
                        "Success",
                        "Data Kas Kecil berhasil disubmit",
                        "success"
                        ).then(result => {
                            window.location='/kas';
                        });
                });

                 
            }
        }
    }
]);
