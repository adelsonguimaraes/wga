angular.module(module).controller('mainCtrl', function ($rootScope, $scope, authenticationAPI, genericAPI, $location, $uibModal, $timeout) {
    authenticationAPI.sessionCtrl();

    $rootScope.api = api;
    
    $rootScope.loading = 'none';
    $scope.title = ' -- WGA --';

    $rootScope.loadon = function (msg) {
        var load = document.getElementById('loading');
        load.classList += " show-splash";
        load.querySelector("a").innerHTML = (msg==undefined) ? 'Carregando... Aguarde' : msg;
    }
    $rootScope.loadoff = function () {
        var load = document.getElementById('loading');
        load.classList = "main-splash";
    }

    $rootScope.rotinas = [
        {
            'nome': 'Home',
            'icon': 'fa fa-home',
            'url': 'home'
        },
        {
            'nome': 'Clientes',
            'icon': 'fa fa-user',
            'url': 'cliente'
        },
        {
            'nome': 'Agenda',
            'icon': 'fa fa-calendar',
            'url': 'agenda'
        },
        {
            'nome': 'Cartas de Crédito',
            'icon': 'fa fa-credit-card',
            'url': 'cartacredito'
        },
    ];

    // window.document.addEventListener("mousemove", function (e) {
    //     if (!$rootScope.usuario) {
    //         if (window.screen.width >= 1020) {
    //             let moveX = (e.pageX * -1 / 100);
    //             let moveY = (e.pageY * -1 / 60);
    //             let body = window.document.querySelector("body");
    //             body.style.backgroundPositionX = moveX + 'px';// + moveY + 'px';
    //         }
    //     }
    // });
    
    // menu
    $scope.toogleMenu = function () {
        let el = window.document.querySelector(".bottom-header");
        if (el.className.indexOf("bottom-header-show")==-1) {
            el.classList += " bottom-header-show";
        }else{
            el.classList = "bottom-header";
        }
    }

    // $scope.mouseEnterMenu = function (menu) {
    //     let el = window.document.querySelector(".bottom-header");
    //     // if (menu === "home") 
    //     el.style.background = "rgba(140, 45, 46, 0.45)";
    // }
    // $scope.mouseLeaveMenu = function (menu) {
    //     let el = window.document.querySelector(".bottom-header");
    //     // if (menu === "home") 
    //     el.removeAttribute("style");
    // }
});