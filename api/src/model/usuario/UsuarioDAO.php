<?php
// dao : usuario

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes Monteiro.
	Data de início: 2019-09-09T13:23:46.531Z.
	Data Atual: 09/09/2019.
*/

Class UsuarioDAO {
	//atributos
	private $con;
	private $sql;
	private $obj;
	private $lista = array();
	private $superdao;

	//construtor
	public function __construct($con) {
		$this->con = $con;
		$this->superdao = new SuperDAO('usuario');
	}

	//cadastrar
	function cadastrar (usuario $obj) {
		$this->sql = sprintf("INSERT INTO usuario(nome, email, senha, ultimoacesso)
		VALUES('%s', '%s', '%s', '%s')",
			mysqli_real_escape_string($this->con, $obj->getNome()),
			mysqli_real_escape_string($this->con, $obj->getEmail()),
			mysqli_real_escape_string($this->con, $obj->getSenha()),
			mysqli_real_escape_string($this->con, $obj->getUltimoacesso()));

		$this->superdao->resetResponse();

		if(!mysqli_query($this->con, $this->sql)) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), get_class( $obj ), 'Cadastrar' ) );
		}else{
			$id = mysqli_insert_id( $this->con );

			$this->superdao->setSuccess( true );
			$this->superdao->setData( $id );
		}
		return $this->superdao->getResponse();
	}

	//atualizar
	function atualizar (Usuario $obj) {
		$this->sql = sprintf("UPDATE usuario SET nome = '%s', celular1 = '%s', celular2 = '%s', email = '%s', senha = '%s', ultimoacesso = '%s', dataedicao = '%s' WHERE id = %d ",
			mysqli_real_escape_string($this->con, $obj->getNome()),
			mysqli_real_escape_string($this->con, $obj->getCelular1()),
			mysqli_real_escape_string($this->con, $obj->getCelular2()),
			mysqli_real_escape_string($this->con, $obj->getEmail()),
			mysqli_real_escape_string($this->con, $obj->getSenha()),
			mysqli_real_escape_string($this->con, $obj->getUltimoacesso()),
			mysqli_real_escape_string($this->con, date('Y-m-d H:i:s')),
			mysqli_real_escape_string($this->con, $obj->getId()));
		$this->superdao->resetResponse();

		if(!mysqli_query($this->con, $this->sql)) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), get_class( $obj ), 'Atualizar' ) );
		}else{
			$this->superdao->setSuccess( true );
			$this->superdao->setData( true );
		}
		return $this->superdao->getResponse();
	}

	//buscarPorId
	function buscarPorId (Usuario $obj) {
		$this->sql = sprintf("SELECT * FROM usuario WHERE id = %d",
			mysqli_real_escape_string($this->con, $obj->getId()));
		$result = mysqli_query($this->con, $this->sql);

		$this->superdao->resetResponse();

		if(!$result) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), get_class( $obj ), 'BuscarPorId' ) );
		}else{
			while($row = mysqli_fetch_object($result)) {
				$this->obj = $row;
			}
			$this->superdao->setSuccess( true );
			$this->superdao->setData( $this->obj );
		}
		return $this->superdao->getResponse();
	}

	//buscarPorId
	function buscarPorEmail ($email) {
		$this->sql = "SELECT * FROM usuario WHERE email = '$email'";
		$result = mysqli_query($this->con, $this->sql);

		$this->superdao->resetResponse();

		if(!$result) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), "Usuario", 'buscarPorEmail' ) );
		}else{
			while($row = mysqli_fetch_assoc($result)) {
				$this->obj = $row;
			}
			$this->superdao->setSuccess( true );
			$this->superdao->setData( $this->obj );
		}
		return $this->superdao->getResponse();
	}

	//listar
	function listar () {
		$this->sql = "SELECT * FROM usuario";
		$result = mysqli_query($this->con, $this->sql);

		$this->superdao->resetResponse();

		if(!$result) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), 'Usuario' , 'Listar' ) );
		}else{
			while($row = mysqli_fetch_object($result)) {
				array_push($this->lista, $row);
			}
			$this->superdao->setSuccess( true );
			$this->superdao->setData( $this->lista );
		}
		return $this->superdao->getResponse();
	}

	//listar paginado
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM usuario limit " . $start . ", " . $limit;
		$result = mysqli_query ( $this->con, $this->sql );

		$this->superdao->resetResponse();

		if ( !$result ) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), 'Usuario' , 'ListarPaginado' ) );
		}else{
			while ( $row = mysqli_fetch_assoc ( $result ) ) {				array_push( $this->lista, $row);
			}

			$this->superdao->setSuccess( true );			$this->superdao->setData( $this->lista );
			$this->superdao->setTotal( $this->qtdTotal() );
		}

		return $this->superdao->getResponse();
	}
	//deletar
	function deletar (Usuario $obj) {
		$this->superdao->resetResponse();

		// buscando por dependentes
		$dependentes = $this->superdao->verificaDependentes($obj->getId());
		if ( $dependentes > 0 ) {
			$this->superdao->setMsg( resolve( '0001', $dependentes, get_class( $obj ), 'Deletar' ));
			return $this->superdao->getResponse();
		}

		$this->sql = sprintf("DELETE FROM usuario WHERE id = %d",
			mysqli_real_escape_string($this->con, $obj->getId()));
		$result = mysqli_query($this->con, $this->sql);

		if ( !$result ) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), get_class( $obj ), 'Deletar' ));
			return $this->superdao->getResponse();
		}

		$this->superdao->setSuccess( true );
		$this->superdao->setData( true );

		return $this->superdao->getResponse();
	}

	//quantidade total
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM usuario";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		$total = 0;
		while ( $row = mysqli_fetch_object ( $result ) ) {
			$total = $row->quantidade;
		}
		return $total;
	}

	/* Logar */
	function logar ( $email, $senha ) {

		$this->sql = "SELECT * 
		from usuario
		where email = '$email' and senha = '$senha'";
		$result = mysqli_query( $this->con, $this->sql );

		$this->superdao->resetResponse();
		
		if( !$result ) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), get_class( $obj ), 'Logar' ) );
		}else{
			// caso não retorne objeto mysql result, usuario não encontrado
			$usuario = '';
			while( $row = mysqli_fetch_object( $result) ) {
				$usuario = array(
					'idusuario'=>$row->id,
					'nome'=>$row->nome,
					'email'=>$row->email,
					// 'celular'=>$row->celular1,
					// 'perfil'=>$row->perfil,
					// 'foto'=>$row->foto,
					'auth'=>$row->auth
				);
			}
			if ( $usuario === '' ) {
				$this->superdao->setMsg( "Usuário ou Senha incorretos!" );
				return $this->superdao->getResponse();
			}
			
			// atualizando Autenticação
			$resp = $this->setAuth($usuario['idusuario']);
			if ($resp['success']===false) return ($resp);
			$usuario['auth'] = $resp['data']->auth;
			
			$this->superdao->setSuccess( true );
			$this->superdao->setData( $usuario );
		}
		return $this->superdao->getResponse();
	}

	function setAuth ($idusuario) {
		$this->sql = "UPDATE usuario u SET u.auth = MD5(CONCAT(u.nome, u.email, u.senha)) WHERE u.id = $idusuario";
		$this->superdao->resetResponse();

		if(!mysqli_query($this->con, $this->sql)) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), get_class( $obj ), 'setAuth' ) );
		}else{
			$id = mysqli_insert_id( $this->con );

			$resp = $this->buscarPorId (new Usuario($idusuario));
			if ($resp['success']===false) return ($resp);
			$usuario = $resp['data'];

			$this->superdao->setSuccess( true );
			$this->superdao->setData( $usuario );
		}
		return $this->superdao->getResponse();
	}

	// verificando authenticação do usuário
	function auth ($idusuario, $auth) {
		
		$this->sql = "SELECT u.* 
		FROM usuario u
		WHERE u.id = $idusuario AND u.auth = '$auth' AND u.ativo = 'SIM'";

		$result = mysqli_query( $this->con, $this->sql );

		$this->superdao->resetResponse();
		
		if( !$result ) {
			$this->superdao->setMsg( resolve( mysqli_errno( $this->con ), mysqli_error( $this->con ), 'Usuário', 'Auth' ) );
		}else{
			// caso não retorne objeto mysql result, usuario não encontrado
			$usuario = '';
			while( $row = mysqli_fetch_object( $result) ) {
				$usuario = $row;	
			}
			if ( $usuario === '' ) {
				$this->superdao->setMsg( "Usuário não autenticado!" );
				return $this->superdao->getResponse();
			}
			
			$this->superdao->setSuccess( true );
			$this->superdao->setData( $usuario );
		}
		return $this->superdao->getResponse();
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>