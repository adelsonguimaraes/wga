angular.module(module).service("authenticationAPI", function ($q, $location, $rootScope, $uibModal, $http) {
	
	function _genericAuthentication (data) {
		return $http({
			method: 'POST',
			url: api + "src/rest/autoload.php",
			data: {
				metodo: data.metodo,
				data: data.data,
				class: data.class
			}
		});
	};


	function _createSession (data, infinity) {
		//verifica se o cookie não foi marcado
		if(!infinity) infinity = false;
		//alimenta a variavel usuarioGWA com data;
		$rootScope.usuario = data;

		//criar a sessionStorage com oss dados do data
        sessionStorage["usuarioGWA"] = JSON.stringify(data);
        //cria obj Date com a data atual
        var now = new Date();
        //criar o obj do localStorage sessionGWA
        var sessionGWA = {
            "usuarioGWA": 	data, //alimenta os dados da session usuarioGWA
            "infinity": infinity, //passa true ou false para o cookie infinito
            "dataExp": 	new Date(now.getTime()+50000) //passa a data atual + 1 minuto para dataExp
        };

        //cria o local storage
		localStorage["sessionGWA"] = JSON.stringify(sessionGWA);
		
		if ($rootScope.usuario) {
			if ($rootScope.usuario.foto == undefined) $rootScope.usuario.foto = "../libs/img/profile2.jpg";
		}
    }

	function _sessionCtrl () {

		
		/*
			Function generica para as várias operaçõesss abaixo
		*/
		function atualizaLocalStorage () {
			//converte json string para obj e armazena em session.
			var session = JSON.parse(localStorage['sessionGWA']);
			//cria um novo obj de data atual
			var now = new Date();
			//atualiza o tempo da sessão, a hora atual +5 minutos
			session.dataExp = new Date(now.getTime()+50000);
			//atualiza a sessionStorage mynuvio cupom
			localStorage['sessionGWA'] = JSON.stringify(session);
			//converte o obj em json string e salva em sessionStorage
			sessionStorage['usuarioGWA'] = JSON.stringify(session.usuarioGWA);
			//converte json string para obj e passa para o scopo usuarioGWA
			$rootScope.usuario = JSON.parse(sessionStorage['usuarioGWA']);

			if ($rootScope.usuario) {
				if ($rootScope.usuario.foto == undefined) $rootScope.usuario.foto = "../libs/img/profile2.jpg";
			}

		}

		/*
			Verifica se existe sessionStore.usuarioGWA
		*/
		if(sessionStorage['usuarioGWA'] && localStorage['sessionGWA']) {

			atualizaLocalStorage();
			
		/*
			Caso não exista sessionStorage
		*/
		}else{
			/*
				Verifica se existe localStorage
			*/
			if(localStorage['sessionGWA']) {
				//converte json string para obj e armazena em session.
				var session = JSON.parse(localStorage['sessionGWA']);
				/*
					Verifica se a sessão tem conf infinita,
					sendo que o usuarioGWA está sempre logado
				*/
				if(session.infinity) {

					atualizaLocalStorage();

				}else{
					//cria um novo obj de data atual
					var now = new Date();
					//converte a string data da sessao em obj
					var dataSessao = new Date(session.dataExp);
					/*
						Compara se o tempo de sessão ainda está no prazo,
						convertendo as duas datas em milisegundos
					*/
					if(now.getTime() <= dataSessao.getTime()) {
						
						atualizaLocalStorage();
					
					}else{
					
						$rootScope.logout();
					
					}//fim if data.getTime
				}//fim if session infinity
			}//fim de if localStorage
		}//fim if sessionStorage

	}

	function _auth () {
		return $http({
			method: 'POST',
			url: api + "src/rest/autoload.php",
			data: {
				metodo: 'auth',
				data: '',
				class: 'authentication',
				usuario: $rootScope.usuario
			}
		}).then(function successCallback(response) {
				//se o sucesso === true
				if (response.data.success == false) {
					// SweetAlert.swal({ html: true, title: "Atenção", text: response.data.msg, type: "error" });
					var styleError = [
						"font-size:24px;",
						"color: #ececec;",
						"font-weight:bold;",
						"text-align:center;",
						"width:100%;height:100vh;",
						"position:fixed;",
						"background-color:#800c0c;",
						"padding-top:40px;",
						// "line-height: 25;",
						"top: 0;",
						"left:0;"
					];
					var html = '<div style="' + styleError.join(' ') +'">' +response.data.msg+ '<br><small>O Sistema será reiniciado..</small></div>';
					
					document.write(html);
					setTimeout(() => { $rootScope.logout(); }, 3000);
					
					return false;
				}else{
					return true;
				}
			}, function errorCallback(response) {
				console.console.error('Error', response);
			});	;
	}

	$rootScope.getMenu = function () {
		$rootScope.loadon();
        
        return $http({
			method: 'POST',
			url: api + "src/rest/autoload.php",
			data: {
				metodo: 'getMenu',
				data: '',
				class: 'authentication',
				usuario: $rootScope.usuario
			}
		}).then(function successCallback(response) {
			//se o sucesso === true
			if (response.data.success == true) {
				// alimentamos o menu
				if (response.data.data.length>0) $rootScope.rotinas = response.data.data;

				MyMenu.setNameinMenu($rootScope.usuario.nome); // nome do usuario
				if ($rootScope.usuario.foto!=null && $rootScope.usuario.foto!=undefined) MyMenu.setMenuProfile(api + $rootScope.usuario.foto + '?' + moment().valueOf()); // foto do usuario
				// rodape
				MyMenu.setFooter('<span class="version"> v' + version + '</span><a onclick="angular.element(this).scope().logout()"><i class="fa fa-power-off"></i> Deslogar</a>');
				MyMenu.setMenuItens($rootScope.rotinas); // itens do menu
				$rootScope.loadoff();                    
			} else {
				$rootScope.loadoff();
				var styleError = [
					"font-size:24px;",
					"color: #ececec;",
					"font-weight:bold;",
					"text-align:center;",
					"width:100%;height:100vh;",
					"position:fixed;",
					"background-color:#800c0c;",
					"padding-top:40px;",
					// "line-height: 25;",
					"top: 0;",
					"left:0;"
				];
				var html = '<div style="' + styleError.join(' ') + '">' + response.data.msg + '<br><small>O Sistema será reiniciado..</small></div>';

				document.write(html);
				setTimeout(() => { $rootScope.logout(); }, 3000);
			}
		}, function errorCallback(response) {
			//error
		});	
	}

	// logout global
    $rootScope.logout = function () {

		window.sessionStorage.removeItem("usuarioGWA");
		window.localStorage.removeItem("sessionGWA");
		$rootScope.usuario = "";
		
		//delete $rootScope.menus;
		// $location.path("/home");
		window.location.reload();
    }

    
	return {
		genericAuthentication: _genericAuthentication,
		// verificaSessao : _verificaSessao,
		createSession: _createSession,
		sessionCtrl: _sessionCtrl,
		auth: _auth
	};
});