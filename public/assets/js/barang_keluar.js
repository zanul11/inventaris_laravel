app = angular.module("app", []);

app.controller("BarangKeluarController", [
    "$scope",
    "$http",
    function VerifikasiController($scope, $http) {
        $scope.detail_barangs = [];
        $scope.barangs = [];
        $scope.bidangs = [];
        $scope.lokasis = [];
        $scope.proyeks = [];
        $scope.jum = 0;
        $scope.ket = '';
        $scope.pj = '';
        $scope.tgl = null;

        $scope.init = function(kode)
        {}

        $http({
            method: "GET",
            url: "/get-barang"
        }).then(res => {
            $scope.barangs = res.data;
            // $scope.selectedBarang= $scope.barangs[0];
        });

        $http({
            method: "GET",
            url: "/proyek/getdata"
        }).then(res => {
            $scope.proyeks = res.data;
            // $scope.selectedBarang= $scope.barangs[0];
        });

        // $http({
        //     method: "GET",
        //     url: "/getLokasi"
        // }).then(res => {
        //     $scope.lokasis = res.data;
        //     // $scope.selectedBarang= $scope.barangs[0];
        // });

        // $http({
        //     method: "GET",
        //     url: "/get-bidang"
        // }).then(res => {
        //     $scope.bidangs = res.data;
        //     // $scope.selectedBarang= $scope.barangs[0];
        // });


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
            else if($scope.selectedBarang.stok<$scope.jum){
                Swal.fire(
                    "Warning!",
                    "Stok tidak cukup!",
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
        };

        $scope.removeItem = function(index) {
            $scope.detail_barangs.splice(index, 1);
        };


        $scope.pilihProyek = function() {
           console.log($scope.selectedProyek);
           if($scope.selectedProyek!=null){
            $scope.pj = $scope.selectedProyek.pj;
            $scope.ket = $scope.selectedProyek.lokasi;
           }else {
            $scope.pj = '';
            $scope.ket = '';
            $scope.selectedProyek=null;
           }
           
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
            else if($scope.ket==''){
                Swal.fire(
                    "Warning!",
                    "Isi Lokasi!",
                    "warning"
                );
            }
            // else if($scope.selectedBidang==undefined){
            //     Swal.fire(
            //         "Warning!",
            //         "Pilih Bidang!",
            //         "warning"
            //     );
            // }
            else if($scope.detail_barangs.length==0){
                Swal.fire(
                    "Warning!",
                    "Pilih Barang Keluar!",
                    "warning"
                );
            }else {
                $http({
                    url: "/barang_keluar",
                    method: "POST",
                    data: {
                        pj: $scope.pj,
                        diterima: $scope.pj,
                        barangs : $scope.detail_barangs,
                        tgl:$scope.tgl,
                        ket:$scope.ket,
                        proyek:($scope.selectedProyek)?$scope.selectedProyek.id:null
                    }
                }).then(res => {
                    Swal.fire(
                        "Success",
                        "Data Barang Keluar berhasil disubmit",
                        "success"
                        ).then(result => {
                            window.location='/barang_keluar';
                        });
                });

                  
            }
        }
    }
]);
