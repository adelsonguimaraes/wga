angular.module(module).controller('registrarCtrl', function ($rootScope, $scope, $location, authenticationAPI, genericAPI, SweetAlert, $uibModal, $timeout) {
    //Verifica Sessao e permissão de acesso
    if ($rootScope.usuario) { $location.path("/home"); return false; }

    $scope.obj = {
        email: null,
        senha1: null,
        senha2: null
    }

   $scope.salvar = function (obj) {
        console.log(obj);
   }
});