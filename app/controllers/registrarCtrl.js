angular.module(module).controller('registrarCtrl', function ($rootScope, $scope, $location, authenticationAPI, genericAPI, SweetAlert, $uibModal, $timeout) {
    //Verifica Sessao e permissão de acesso
    if ($rootScope.usuario) { $location.path("/home"); return false; }


    $scope.reset = function () {
        // modelo do formulário de cadastro
        $scope.obj = {
            nome: null,
            email: null,
            senha1: null,
            senha2: null,
            cod: ''
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

        $scope.cod = gerarCod(6); // chamando a função de gerar código com 6 digitos
        
        let dataRequest = {
            data: copy,
            cod: $scope.cod
        }

        $rootScope.loadon();
        
        let data = { "metodo": "enviarCodAutorizacao", "data": dataRequest, "class": "authentication", request: 'POST' };

        authenticationAPI.genericAuthentication(data)
            .then(function successCallback(response) {
                //se o sucesso === true
                if (response.data.success == true) {
                    $scope.confirmar = true;
                    $rootScope.loadoff();
                } else {
                    $rootScope.loadoff();
                    SweetAlert.swal({ html: true, title: "Atenção", text: response.data.msg, type: "error" });
                }
            }, function errorCallback(response) {
                //error
            });	
        
    }

    $scope.registrando = false;
    $scope.insereCod = function ($event, obj) {
        if (obj.cod == undefined || obj.cod.length <= 0) return false;
        // se estiver enviando não passa mais
        if ($scope.registrando) return false;
        
        // removendo tudo que não senha numero e letras
        let cod = obj.cod.replace(/[\W]/g, "");
        cod = cod.substr(0, 6); // limitando a quantidade de digitos a 6
        cod = cod.toUpperCase(); // colocando tudo em caixa alta
        $scope.obj.cod = cod; // alimentando o scope.cod com o cod digitado

        // se o codigo inserido pelo usuário for identico ao gerado
        if (cod === $scope.cod) {
            $scope.registrando = true;
            registrar();
        }
    }

    function registrar() {
        $rootScope.loadon();

        let dataRequest = {
            nome: $scope.obj.nome,
            email: $scope.obj.email,
            senha: MD5($scope.obj.senha1),
            remember: false
        };

        var data = { "metodo": "registrar", "data": dataRequest, "class": "authentication", request: 'POST' };

        authenticationAPI.genericAuthentication(data)
            .then(function successCallback(response) {
                //se o sucesso === true
                if (response.data.success == true) {
                    //criamos a session
                    authenticationAPI.createSession(response.data.data, dataRequest.remember);
                    $rootScope.loadoff();
                    $location.path("/home");
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
        $scope.registrando = false;

        if (obj.email === null || obj.senha === null) {
            SweetAlert.swal({ html: true, title: "Atenção", text: 'Preencha corretamente os campos.', type: "error" });
            return false;
        }
    }

});