app = angular.module("app", []);

app.controller("AssetController", [
    "$scope",
    "$http",
    function AssetController($scope, $http) {
       
        $scope.btnDelete = function(kode) {
            Swal.fire({
                title: "Yakin?",
                text: "Anda akan menghapus data ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yas, Hapus!"
            }).then(result => {
                if (result.value) {
                    $http({
                        url: "/user/delete/" + kode,
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr("content")
                        }
                    }).then(res => {
                        Swal.fire(
                            "Deleted!",
                            "Data berhasil dihapus",
                            "success"
                        ).then(result => {
                            location.reload();
                        });
                    });
                }
            });
        };
    }
]);
