angular.module(module).controller('meusdadosCtrl', function ($rootScope, $scope, $location, authenticationAPI, genericAPI, SweetAlert, $uibModal, $timeout, UploadFactory) {
    //Verifica Sessao e permissão de acesso
    if (!$rootScope.usuario) { $location.path("/login"); return false; }

    $scope.titulo = "Meu Perfil";

    $scope.obj = {
        id: $rootScope.usuario.idusuario,
        idocupacao: $rootScope.usuario.idocupacao + ' - ' + $rootScope.usuario.ocupacao,
        nome: $rootScope.usuario.nome,
        email: $rootScope.usuario.email,
        newsenha: "",
        celular1: $rootScope.usuario.celular1,
        celular2: $rootScope.usuario.celular2,
        foto: api + $rootScope.usuario.foto,
        link: window.location.href.substring(0, window.location.href.lastIndexOf('#')) + '#/perfil/' + '@' + $rootScope.usuario.email.toLowerCase().replace(/\s/g, '') + '&' + MD5($rootScope.usuario.idusuario)
    }
    if ($rootScope.usuario.foto === null || !$rootScope.usuario.foto) $scope.obj.foto = './libs/img/profile2.jpg';

    // quando o usuário clica na foto para alterar
    $scope.anexar = function (obj) {
        // pega o input file
        var input = document.querySelector('#inputFile');
        input.click(); // força o evento click
    }

    // listando consultores
    $scope.ocupacoes = [];
    $scope.listarOcupacoes = function () {
        // verificando se o filtro está preenchido
        var data = { "metodo": "listar", "data": "", "class": "ocupacao", request: 'GET' };

        $rootScope.loadon();

        genericAPI.generic(data)
            .then(function successCallback(response) {
                //se o sucesso === true
                if (response.data.success == true) {
                    $scope.ocupacoes = response.data.data;
                    // if ($scope.consultores.length) $scope.obj.consultor = $scope.consultores[0];
                    $rootScope.loadoff();
                } else {
                    SweetAlert.swal({ html: true, title: "Atenção", text: response.data.msg, type: "error" });
                }
            }, function errorCallback(response) {
                //error
            });
    }
    $scope.listarOcupacoes();


    $rootScope.filesCopy = [];
    var setPreviewAnexos = function (files) {
        $rootScope.loadoff();
        
        var file = $rootScope.filesCopy[0]; // pegando o file/img uplodado
        var preview = document.querySelector('#preview'); // getando elemento preview
        let img = preview.querySelector('img');
        preview.innerHTML = '';
        setTimeout(()=>{
            // preview.innerHTML += '<img height=120 width=120 src="' + file.base64 + '" alt="' + file.name + '">'; // atulizando a imagem
            preview.innerHTML += '<img height=120 width=120 style="background: #fff;border-radius: 5%; object-fit: cover;" src="' + file.base64 + '" alt="' + file.name + '">';
        }, 100);
    }
    $scope.closePreview = function () {
        var preview = document.querySelector('#preview');
        preview.innerHTML = '';
        $rootScope.filesCopy = [];
    }

    // quando o usuário seleciona as imagens
    $scope.changeFiles = function (target) { // evento que escuta a escolha de arquivos
        $rootScope.loadon();
        // fazendo a copia dos arquivos
        // $scope.filesCopy = Array.prototype.slice.call(target.files);
        $rootScope.filesCopy = [];// limpar o cache
        UploadFactory.convertFileBase64(target.files).then(result => {
            target.value = '';
            // exibindo anexos
            setTimeout(() => {
                setPreviewAnexos(result.files); // mostra anexos no preview
                if (result.erros !== '') {
                    SweetAlert.swal({ html: true, title: "Atenção", text: result.erros, type: "error" });
                }
            }, 1000);
        });
    }

    $scope.salvar = function (obj) {

        objcopy = angular.copy(obj);

        if (objcopy.newsenha != "") objcopy.newsenha = MD5(obj.newsenha); // caso a senha seja diferente de vazio
        objcopy.celular1 = objcopy.celular1.toString().replace(/^0|[\D]/g, "");
        objcopy.celular2 = objcopy.celular2.toString().replace(/^0|[\D]/g, "");
        let split = objcopy.idocupacao.split("-");
        objcopy.idocupacao = split[0].trim();

        $rootScope.loadon();

        var formData = new FormData();
        formData.append("files", JSON.stringify($rootScope.filesCopy));
        
        formData.append('usuario', JSON.stringify($rootScope.usuario)); // adicionando usuario
        formData.append('data', JSON.stringify(objcopy)); // adicionando data
        // verificar se temos um cadastro ou uma edição
        var method = 'atualizarMeusDados';//(values.id <= 0) ? 'cadastrar' : 'atualizar';
        formData.append('class', "usuario");
        formData.append('metodo', method);

        var xhttp = new XMLHttpRequest();
        xhttp.onload = function (e) {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                // se obteve sucesso na requisição
                if (response.success) {
                    $rootScope.loadoff();
                    $rootScope.logout();
                    // MyToast.show('Seus dados foram atualizados.', 3);
                } else {
                    SweetAlert.swal({ html: true, title: "Atenção", text: response.msg, type: "error" });
                }
            }
        }
        var timeStart;
        xhttp.addEventListener("loadstart", function (e) {
            var date = moment();
            timeStart = moment().valueOf();
        });
        xhttp.addEventListener("loadend", function (e) {
            var date = moment();
            // se o tempo de requisição for maior que 5 segundos 
            if ((date.valueOf() - timeStart) > 5000) {
                // caso a conexão esteja lenta
                MyToast.show('Conexão com o Servidor lenta.', 3);
            }
        });


        xhttp.open('POST', api + "/src/rest/autoload.php", true);
        xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // configurando o cabeçalho da requisição

        xhttp.send(formData);
    }

    // copy link
    $scope.copyLink = function () {
        var clipboard = document.querySelector('#clipboard');
        clipboard.select();
        document.execCommand("copy");
        MyToast.show('Copiado para a área de transferência.', 3);
    }
});