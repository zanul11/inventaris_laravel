app = angular.module("app", []);

app.controller("BarangKeluarController", [
    "$scope",
    "$http",
    function VerifikasiController($scope, $http, $location) {
        $scope.detail_barangs = [];
        $scope.barangs = [];
        $scope.bidangs = [];
        $scope.pj = '';
        $scope.jum = 0;
        $scope.ket = '';

        $scope.init = function(kode,pj, diterima, token, tgl)
        {
            $scope.pj = pj;
            $scope.tgl=new Date(tgl);
            $http({
                method: "GET",
                url: "/get-barang"
            }).then(res => {
                $scope.barangs = res.data;
                // $scope.selectedBarang= $scope.barangs[0];
            });
    
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
                url: "/barang_keluar/get-detail-barang",
                method: "POST",
                data: {
                    kode : kode,
                }
                }).then(res => {
                    // console.log(res);
                    angular.forEach(res.data, function(dt) {
                        console.log(dt);
                        $scope.detail_barangs.push({
                            barang_id : dt['barang_id'],
                            nama: dt['nama'],
                            jumlah: dt['jumlah'],
                            ket:dt['ket'],
                            satuan_id : dt['satuan_id'],
                            satuan: dt['satuan']
                        });
                    });
                });

           
            $scope.kode=kode;
        }

       

        $scope.insertTabel = function() {
  
             if ($scope.selectedBarang==undefined){
                Swal.fire(
                    "Warning!",
                    "Pilih Barang!",
                    "warning"
                );
            }
            else if($scope.jum==0 || $scope.jum==undefined){
                Swal.fire(
                    "Warning!",
                    "Field Jumlah masih 0!",
                    "warning"
                );
            }
           else {
                console.log($scope.selectedBarang.satuan_detail);
                $scope.cek=false;
                angular.forEach($scope.detail_barangs, function(dt) {
                    if(dt['nama']==$scope.selectedBarang.nama){
                        $scope.cek=true;
                    }
                });
                if(!$scope.cek){
                    $scope.detail_barangs.push({
                        barang_id : $scope.selectedBarang.id,
                        nama: $scope.selectedBarang.nama,
                        jumlah: $scope.jum,
                        ket:$scope.ket,
                        satuan_id : $scope.selectedBarang.satuan_detail.id,
                        satuan:$scope.selectedBarang.satuan_detail.satuan
                    });
                }else {
                    $scope.detail_barangs.find(function(v) {
                        $tmpJum=v.jumlah;
                        $tmpKet=v.ket;
                        return v.nama == $scope.selectedBarang.nama;
                      }).jumlah = ($tmpJum+$scope.jum);

                      $scope.detail_barangs.find(function(v) {
                        return v.nama == $scope.selectedBarang.nama;
                      }).ket = $scope.ket;
                }
               
            }
            $scope.jum = 0;
            $scope.ket = '';
        };

        $scope.removeItem = function(index) {
            $scope.detail_barangs.splice(index, 1);
        };

        $scope.submitData = function() {
            console.log($scope.detail_barangs.length);
            if($scope.pj==''){
                Swal.fire(
                    "Warning!",
                    "Isi Penanggung Jawab!",
                    "warning"
                );
            }
            else if($scope.tgl==null){
                Swal.fire(
                    "Warning!",
                    "Pilih Tanggal Barang Keluar!",
                    "warning"
                );
            }
            else if($scope.detail_barangs.length==0){
                Swal.fire(
                    "Warning!",
                    "Pilih Barang Keluar!",
                    "warning"
                );
            }else {
                $http({
                    url: "/barang_keluar/edit",
                    method: "POST",
                    data: {
                        pegawai: $scope.pj,
                        diterima: $scope.pj,
                        barangs : $scope.detail_barangs,
                        kode : $scope.kode,
                        tgl:$scope.tgl
                    }
                }).then(res => console.log(res));

                  Swal.fire(
                    "Success",
                    "Data Barang Masuk berhasil disubmit",
                    "success"
                    ).then(result => {
                        window.location='/barang_keluar';
                    });
            }
        }
    }
]);
