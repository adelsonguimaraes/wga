<?php
// control : usuario

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes Monteiro.
	Data de início: 2019-09-09T13:23:46.531Z.
	Data Atual: 09/09/2019.
*/

Class UsuarioControl {
	//atributos
	protected $con;
	protected $obj;
	protected $objDAO;

	//construtor
	public function __construct(Usuario $obj=NULL) {
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDAO = new UsuarioDAO($this->con);
		$this->obj = $obj;
	}

	//metodos
	function cadastrar () {
		return $this->objDAO->cadastrar($this->obj);
	}
	function buscarPorId () {
		return $this->objDAO->buscarPorId($this->obj);
	}
	function buscarPorEmail ($email) {
		return $this->objDAO->buscarPorEmail ($email);
	}
	function listar () {
		return $this->objDAO->listar();
	}
	function atualizar () {
		return $this->objDAO->atualizar($this->obj);
	}
	function deletar () {
		return $this->objDAO->deletar($this->obj);
	}
	function listarPaginado ($start, $limit) {
	return $this->objDAO->listarPaginado($start, $limit);
	}
	function qtdTotal () {
		return $this->objDAO->qtdTotal();
	}
	function logar ( $email, $senha ) {
		return $this->objDAO->logar ( $email, $senha );
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>