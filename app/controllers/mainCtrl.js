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

    $rootScope.menus = [
        {
            'nome': 'Home',
            'icone': 'fa fa-home',
            'url': 'home',
            'active': false
        },
        {
            'nome': 'Projetos',
            'icone': 'fa fa-book',
            'url': 'projeto',
            'active': false
        },
        {
            'nome': 'Amigos',
            'icone': 'fa fa-user',
            'url': 'amigo',
            'active': false
        },
        {
            'nome': 'Alertas',
            'icone': 'fa fa-bell',
            'url': 'alerta',
            'active': false
        },
    ];

    function setMenuAtivo () {
        // setando menu ativo
        let hash = window.document.location.hash;
        for (let i of $rootScope.menus) {
            if (hash.indexOf("#/" + i.url)>=0) {
                i.active = true;
            }else{
                i.active = false;
            }
        }
    }
    setMenuAtivo();

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
        setMenuAtivo();
    }

    $scope.clickProfileHeader = function () {
        let el = window.document.querySelector(".menu-profile");
        if (el.className.indexOf("menu-profile-show")==-1) {
            el.classList += " menu-profile-show";
        }else{
            el.classList = "menu-profile";
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