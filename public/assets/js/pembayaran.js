app = angular.module("app", []);

app.controller("PembayaranController", [
    "$scope",
    "$http",
    function VerifikasiController($scope, $http) {
        $scope.pelanggans = [];
        $scope.selectedPelanggan =null;
        $scope.tagihans = [];
        $scope.totalTagihan = 0;
        $scope.totalTagihanTerbayarkan = 0;
        $scope.lembarTagihan = 0;
        $scope.saldo = 0;
        $scope.selection = [];

        $http({
            method: "GET",
            url: "/select2/pelanggan-all"
        }).then(res => {
            $scope.pelanggans = res.data;
        });

        $scope.changePelanggan = function() {
            $http({
                method: "POST",
                url: "/select2/tagihan",
                data:{
                    'pelanggan_ID' : $scope.selectedPelanggan.pelanggan_ID
                }
            }).then(res => {
               
                $scope.tagihans = [];
                $scope.saldo = $scope.selectedPelanggan.saldo;
                if(res.data.length>0){
                    $scope.lembarTagihan = res.data.length;
                    angular.forEach(res.data, function(dt) {
                        $scope.totalTagihan+=(parseInt(dt['harga_air'].substring(0, dt['harga_air'].length-3))+ parseInt(dt['admin'].substring(0, dt['admin'].length-3))+parseInt(dt['retrib'].substring(0, dt['retrib'].length-3))+parseInt(dt['materai'].substring(0, dt['materai'].length-3))+parseInt(dt['lingkungan'].substring(0, dt['lingkungan'].length-3))+dt['denda']);
                        $scope.tagihans.push({
                            m3:dt['m3'],
                            stand:dt['stand'],
                            bulan:dt['bulan'],
                            total: parseInt(dt['harga_air'].substring(0, dt['harga_air'].length-3))+ parseInt(dt['admin'].substring(0, dt['admin'].length-3))+parseInt(dt['retrib'].substring(0, dt['retrib'].length-3))+parseInt(dt['materai'].substring(0, dt['materai'].length-3))+parseInt(dt['lingkungan'].substring(0, dt['lingkungan'].length-3))+dt['denda'],
                            tagihan: parseInt(dt['harga_air'].substring(0, dt['harga_air'].length-3)),
                            admin: parseInt(dt['admin'].substring(0, dt['admin'].length-3)),
                            retrib: parseInt(dt['retrib'].substring(0, dt['retrib'].length-3)),
                            materai: parseInt(dt['materai'].substring(0, dt['materai'].length-3)),
                            lingkungan: parseInt(dt['lingkungan'].substring(0, dt['lingkungan'].length-3)),
                            denda: parseInt(dt['denda']),
                        });
                    });
                }else {
                    Swal.fire(
                        "Warning!",
                        "Tidak ada tagihan",
                        "warning"
                    );
                }
                
                
               
            });
        };

        

        $scope.toggleSelection = function toggleSelection(fruitName) {
            var idx = $scope.selection.indexOf(fruitName);
        
            // Is currently selected
            if (idx > -1) {
              $scope.selection.splice(idx, 1);
              $scope.saldo+=fruitName.total;
              $scope.totalTagihanTerbayarkan-=fruitName.total;
            }
            // Is newly selected
            else {
              $scope.selection.push(fruitName);
              $scope.saldo-=fruitName.total;
              $scope.totalTagihanTerbayarkan+=fruitName.total;
            }
            console.log($scope.selection);
          };

        $scope.submit = function() {
            if($scope.selectedPelanggan==undefined||$scope.selectedPelanggan==null){
                Swal.fire(
                    "Warning!",
                    "Pilih Pelanggan Dulu!",
                    "warning"
                );
            }
            else if($scope.selection.length==0){
                Swal.fire(
                    "Warning!",
                    "Pilih Tagihan yang akan dibayarkan!",
                    "warning"
                );
            }else {
                $http({
                    url: "/pembayaran",
                    method: "POST",
                    data: {
                        pelanggan_ID: $scope.selectedPelanggan.pelanggan_ID,
                        tagihan : $scope.selection
                    }
                }).then(res => {
                    console.log(res);
                  Swal.fire(
                    "Success",
                    "Data Pelanggan berhasil disubmit",
                    "success"
                    ).then(result => {
                        window.location='/pembayaran';
                    });
                });

                  
            }
        };

    }
        
]);
