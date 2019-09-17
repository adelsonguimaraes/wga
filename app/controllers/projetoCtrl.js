angular.module(module).controller('projetoCtrl', function ($rootScope, $scope, authenticationAPI, genericAPI, $location, SweetAlert, $uibModal, $timeout) {
    //Verifica Sessao e permissão de acesso
    if (!$rootScope.usuario) { $location.path("/login"); return false; }
    
    $scope.titulo = 'Projetos';
    
    $scope.projetos = [
        {
            id: 1,
            nome: 'Grupo Movus',
            descricao: 'Agrupamento de todos os projetos relativos ao grupo Movus',
            datacadastro: '2019-08-10 10:00:00'
        },
        {
            id: 2,
            nome: 'Câmara Municipal',
            descricao: 'Agrupamento de projetos realizados com a Câmara Municipal de Manaus',
            datacadastro: '2019-06-08 10:00:00'
        }
    ];

});