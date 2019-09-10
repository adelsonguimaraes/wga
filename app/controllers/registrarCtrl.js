angular.module(module).controller('registrarCtrl', function ($rootScope, $scope, $location, authenticationAPI, genericAPI, SweetAlert, $uibModal, $timeout) {
    //Verifica Sessao e permissão de acesso
    if ($rootScope.usuario) { $location.path("/home"); return false; }


    $scope.reset = function () {
        // modelo do formulário de cadastro
        $scope.obj = {
            nome: null,
            email: null,
            senha1: null,
            senha2: null
        }
        // sinaliza tela de confirmação do código recebido por email
        $scope.confirmar = false;
        // variavel que armazena o código
        $scope.cod = '';
    }
    $scope.reset();

    let gerarCod = function (n) {
        let cod = '';
        const x = '0123456789ABCDEFGHIJLMNOPQRSTUVWXYZ';
        while (cod.length < n) {
            let r = parseInt(Math.random()*35);
            cod += x[r];
        }
        return cod;
    }
    
    $scope.salvar = function (obj) {
        let copy = angular.copy(obj);
        if (copy.senha1 != copy.senha2) {
            return SweetAlert.swal({ html: true, title: "Atenção", text: "As senhas estão diferentes!", type: "error" });
        }

        if (!$scope.confirmar) {
            $scope.confirmar = true;
            $scope.cod = gerarCod(6); // chamando a função de gerar código com 6 digitos
            console.log($scope.cod);
        }else{
            console.log(copy);
        }
    }

    $scope.insereCod = function ($event, obj) {
        let cod = obj.cod.replace(/[\W]/g, "");
        cod = cod.substr(0, 6);
        cod = cod.toUpperCase();
        $scope.obj.cod = cod;

        if (cod === $scope.cod) {
            registrar();
        }
    }

    function registrar () {
        $rootScope.loadon();

        return false;

        var dataRequest = {
            email: obj.email,
            senha: MD5(obj.senha),
            remember: obj.remember || false
        }

        var data = { "metodo": "logar", "data": dataRequest, "class": "authentication", request: 'POST' };

        authenticationAPI.genericAuthentication(data)
            .then(function successCallback(response) {
                //se o sucesso === true
                if (response.data.success == true) {
                    //criamos a session

                    authenticationAPI.createSession(response.data.data, dataRequest.remember);
                    $rootScope.loadoff();
                    $location.path("/home");
                    $rootScope.setValuesMyMenu();
                } else {
                    $rootScope.loadoff();
                    SweetAlert.swal({ html: true, title: "Atenção", text: response.data.msg, type: "error" });
                }
            }, function errorCallback(response) {
                //error
            });	
    }

    $scope.naoRecebiCod = function () {
        $scope.confirmar = false;

        if (obj.email === null || obj.senha === null) {
            SweetAlert.swal({ html: true, title: "Atenção", text: 'Preencha corretamente os campos.', type: "error" });
            return false;
        }
    }

});