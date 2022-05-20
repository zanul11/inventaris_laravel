app = angular.module("app", []);

app.controller("BarangKeluarController", [
    "$scope",
    "$http",
    function VerifikasiController($scope, $http) {
        $scope.detail_peralatans = [];
        $scope.kembalians = [];
        $scope.bidangs = [];
        $scope.lokasis = [];
       
        $scope.jumlah = [];
        $scope.keterangan =[];
        $scope.ket = '';
        $scope.pj = '';
        $scope.tgl = null;

        $scope.init = function(kode,pj, lokasi, tgl)
        {
       
            $scope.pj = pj;
            $scope.ket = lokasi;
            $scope.tgl=new Date(tgl);
    
            $http({
                url: "/get-peralatan/detail",
                method: "POST",
                data: {
                    kode : kode,
                }
                }).then(res => {
                    $scope.jumlah = new Array(res.data.length).fill(0);
                    angular.forEach(res.data, function(dt) {
                        $scope.detail_peralatans.push({
                            pinjam_id: dt['id'],
                            barang_id : dt['peralatan_id'],
                            nama: dt['nama'],
                            jumlah: dt['jumlah'],
                            satuan_id : dt['satuan_id'],
                            satuan: dt['satuan']
                        });
                    });
                });

                $http({
                    url: "/get-peralatan/kembalian",
                    method: "POST",
                    data: {
                        kode : kode,
                    }
                    }).then(res => {
                        angular.forEach(res.data, function(dt) {
                            $scope.kembalians.push({
                                pinjam_id: dt['id'],
                                barang_id : dt['peralatan_id'],
                                nama: dt['nama'],
                                jumlah: dt['jumlah'],
                                satuan_id : dt['satuan_id'],
                                satuan: dt['satuan'],
                                ket: dt['ket'],
                                rusak: dt['rusak']
                            });
                        });
                    });

           
            $scope.kode=kode;
        }

        
        $scope.addPengembalian = function(data, index){
            if($scope.jumlah[index]>data['jumlah']){
                Swal.fire(
                    "Warning!",
                    "Jumlah rusak lebih !",
                    "warning"
                );
            }
            console.log(data);   
            $http({
                url: "/pinjam/kembali",
                method: "POST",
                data:{
                    id:data['pinjam_id'],
                    ket: $scope.keterangan[index],
                    rusak:$scope.jumlah[index]
                },
                }).then(res => {
                    console.log(res);
                      $scope.kembalians.push({
                        pinjam_id: data['pinjam_id'],
                        barang_id : data['peralatan_id'],
                        nama: data['nama'],
                        jumlah: data['jumlah'],
                        satuan_id : data['satuan_id'],
                        satuan: data['satuan'],
                        ket: $scope.keterangan[index],
                        rusak:$scope.jumlah[index]
                    });
                    $scope.detail_peralatans.splice(index, 1);
                    $scope.jumlah = new Array($scope.detail_peralatans.length).fill(0);
                });
          
        }



        $scope.removeItem = function(data, index) {
            $http({
                url: "/pinjam/hapus",
                method: "POST",
                data:{
                    id:data['pinjam_id'],
                },
                }).then(res => {
                    $scope.detail_peralatans.push({
                        pinjam_id: data['pinjam_id'],
                        barang_id : data['peralatan_id'],
                        nama: data['nama'],
                        jumlah: data['jumlah'],
                        satuan_id : data['satuan_id'],
                        satuan: data['satuan'],
                        ket: $scope.keterangan[index],
                        rusak:$scope.jumlah[index]
                    });
                    $scope.kembalians.splice(index, 1);
                    $scope.jumlah = new Array($scope.detail_peralatans.length).fill(0);
                });
           
        };

        $scope.submitData = function() {
           
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
         
            else if($scope.detail_peralatans.length==0){
                Swal.fire(
                    "Warning!",
                    "Pilih Peralatan!",
                    "warning"
                );
            }else {
                $http({
                    url: "/pinjam/edit",
                    method: "POST",
                    data: {
                        pj: $scope.pj,
                        diterima: $scope.pj,
                        peralatans : $scope.detail_peralatans,
                        tgl:$scope.tgl,
                        lokasi:$scope.ket,
                        kode:$scope.kode
                        
                    }
                }).then(res => {
                   Swal.fire(
                    "Success",
                    "Data Peminjaman berhasil diupdate",
                    "success"
                    ).then(result => {
                        window.location='/pinjam';
                    });
                });

                  
            }
        }
    }
]);
