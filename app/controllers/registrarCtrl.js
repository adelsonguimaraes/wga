angular.module(module).controller('registrarCtrl', function ($rootScope, $scope, $location, authenticationAPI, genericAPI, SweetAlert, $uibModal, $timeout) {
    //Verifica Sessao e permissão de acesso
    if ($rootScope.usuario) { $location.path("/home"); return false; }

    $scope.obj = {
        nome: null,
        email: null,
        senha1: null,
        senha2: null
    }

    $scope.confirmar = false;

    $scope.salvar = function (obj) {
        let copy = angular.copy(obj);
        if (copy.senha != copy.senha2) {
            return SweetAlert.swal({ html: true, title: "Atenção", text: "As senhas estão diferentes!", type: "error" });
        }

        if (!$scope.confirmar) {
            $scope.confirmar = true;
        }else{
            console.log(copy);
        }
   }
});