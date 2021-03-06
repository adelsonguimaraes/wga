function config($stateProvider, $urlRouterProvider, $ocLazyLoadProvider, IdleProvider, KeepaliveProvider) {
    $urlRouterProvider.otherwise("/home");

    $ocLazyLoadProvider.config({
        // Set to true if you want to see what and when is dynamically loaded
        debug: false
    });

    $stateProvider
        .state('home', {
            url: "/home",
            templateUrl: "app/views/home.html",
            controller: "homeCtrl",
            data: { pageTitle: 'Home', specialClass: 'gray-bg'},
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css', 'libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css', 'libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);

                }
            }
        })
        
        .state('login', {
            url: "/login",
            templateUrl: "app/views/login.html",
            controller: "loginCtrl",
            data: { pageTitle: 'Login', specialClass: 'gray-bg'},
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css', 'libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css', 'libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);
                
                }
            }
        })
        .state('registrar', {
            url: "/registrar",
            templateUrl: "app/views/registrar.html",
            controller: "registrarCtrl",
            data: { pageTitle: 'Registrar', specialClass: 'gray-bg'},
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css', 'libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css', 'libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);
                
                }
            }
        })
        .state('meusdados', {
            url: "/meusdados",
            templateUrl: "app/views/meusdados.html",
            controller: "meusdadosCtrl",
            data: { pageTitle: 'Meus Dados', specialClass: 'gray-bg' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css', 'libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css', 'libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);

                }
            }
        })
        .state('projeto', {
            url: "/projeto",
            templateUrl: "app/views/projeto.html",
            controller: "projetoCtrl",
            data: { pageTitle: 'Projetos', specialClass: 'gray-bg' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['libs/js/plugins/footable/footable.all.min.js', 'libs/css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['libs/js/plugins/footable/angular-footable.js']
                        },
                        {
                            files: ['libs/js/plugins/sweetalert/sweetalert.min.js', 'libs/css/plugins/sweetalert/sweetalert.css']
                        },
                        {
                            name: 'oitozero.ngSweetAlert',
                            files: ['libs/js/plugins/sweetalert/angular-sweetalert.min.js']
                        },
                        {
                            files: ['libs/css/plugins/iCheck/custom.css', 'libs/js/plugins/iCheck/icheck.min.js']
                        },
                        {
                            files: ['libs/js/plugins/moment/moment.min.js']
                        },
                        {
                            name: 'datePicker',
                            files: ['libs/css/plugins/datapicker/angular-datapicker.css', 'libs/js/plugins/datapicker/angular-datepicker.js']
                        },
                        {
                            files: ['libs/js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                    ]);

                }
            }
        })
}
angular
    .module(module)
    .config(config)
    .run(function($rootScope, $state) {
        $rootScope.$state = $state;
    });