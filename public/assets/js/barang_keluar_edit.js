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

           
    
            // $http({
            //     method: "GET",
            //     url: "/get-bidang"
            // }).then(res => {
            //     $scope.bidangs = res.data;
            //     // $scope.selectedBarang= $scope.barangs[0];
            //     angular.forEach($scope.bidangs, function(dt) {
            //         // console.log(dt);
            //         if(dt['kd_bagian']==diterima){
            //             $scope.selectedBidang=dt;
            //             // console.log(dt);
            //         }
            //     });
            // });
    
            $http({
                url: "/barang_keluar/get-detail-barang",
                method: "POST",
                data: {
                    kode : kode,
                }
                }).then(res => {
                    console.log(res.data[0]['proyek_id']);
                    angular.forEach(res.data, function(dt) {
                        $scope.ket=dt['ket'];
                        $scope.detail_barangs.push({
                            barang_id : dt['barang_id'],
                            nama: dt['nama'],
                            jumlah: dt['jumlah'],
                            ket:dt['ket'],
                            satuan_id : dt['satuan_id'],
                            satuan: dt['satuan']
                        });
                    });

                    $http({
                        method: "GET",
                        url: "/proyek/getdata"
                    }).then(res2 => {
                        $scope.proyeks = res2.data;
                        angular.forEach(res2.data, function(dt) {
                            if(dt['id']==res.data[0]['proyek_id']){
                                $scope.selectedProyek=dt;
                            }
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
                        pj: $scope.pj,
                        diterima: $scope.pj,
                        barangs : $scope.detail_barangs,
                        kode : $scope.kode,
                        tgl:$scope.tgl,
                        ket:$scope.ket,
                        proyek:($scope.selectedProyek)?$scope.selectedProyek.id:null
                    }
                }).then(res => console.log(res));

                  Swal.fire(
                    "Success",
                    "Data Barang Keluar berhasil diupdate",
                    "success"
                    ).then(result => {
                        window.location='/barang_keluar';
                    });
            }
        }
    }
]);
