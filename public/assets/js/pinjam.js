app = angular.module("app", []);

app.controller("BarangKeluarController", [
    "$scope",
    "$http",
    function VerifikasiController($scope, $http) {
        $scope.detail_barangs = [];
        $scope.peralatans = [];
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
            url: "/get-peralatan"
        }).then(res => {
            $scope.peralatans = res.data;
            // $scope.selectedAlat= $scope.peralatans[0];
        });

        $http({
            method: "GET",
            url: "/proyek/getdata"
        }).then(res => {
            $scope.proyeks = res.data;
            // $scope.selectedBarang= $scope.barangs[0];
        });

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

        $scope.insertTabel = function() {
  
             if ($scope.selectedAlat==undefined){
                Swal.fire(
                    "Warning!",
                    "Pilih Peralatan!",
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

            $http({
                method: "GET",
                url: "/get-peralatan/"+$scope.selectedAlat.id
            }).then(res => {
                if(res.data['stok_aktif']>=$scope.jum){
                    $scope.cek=false;
                    angular.forEach($scope.detail_barangs, function(dt) {
                        if(dt['nama']==$scope.selectedAlat.nama){
                            $scope.cek=true;
                        }
                    });
                    if(!$scope.cek){
                        $scope.detail_barangs.push({
                            barang_id : $scope.selectedAlat.id,
                            nama: $scope.selectedAlat.nama,
                            jumlah: $scope.jum,
                            satuan_id : $scope.selectedAlat.satuan_detail.id,
                            satuan:$scope.selectedAlat.satuan_detail.satuan
                        });
                    }else {
                        $scope.detail_barangs.find(function(v) {
                            $tmpJum=v.jumlah;
                            $tmpKet=v.ket;
                            return v.nama == $scope.selectedAlat.nama;
                        }).jumlah = ($tmpJum+$scope.jum);

                        $scope.detail_barangs.find(function(v) {
                            return v.nama == $scope.selectedAlat.nama;
                        }).ket = $scope.ket;
                    }
                    $scope.jum = 0;
                }else {
                    Swal.fire(
                        "Warning!",
                        "Stok Peralatan Tidak Tersedia!",
                        "warning"
                    );
                }
            });
                
               
            }
            
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
                    "Pilih Tanggal Batas!",
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
                    "Pilih Peralatan!",
                    "warning"
                );
            }else {
                $http({
                    url: "/pinjam",
                    method: "POST",
                    data: {
                        pj: $scope.pj,
                        diterima: $scope.pj,
                        peralatans : $scope.detail_barangs,
                        tgl:$scope.tgl,
                        lokasi:$scope.ket,
                         proyek:($scope.selectedProyek)?$scope.selectedProyek.id:null
                    }
                }).then(res => {
                    Swal.fire(
                        "Success",
                        "Data Peminjaman berhasil ditambahkan",
                        "success"
                        ).then(result => {
                            window.location='/pinjam';
                        });
                });

                  
            }
        }
    }
]);
