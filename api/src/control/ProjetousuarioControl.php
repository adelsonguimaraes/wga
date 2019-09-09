<?php
// control : projetousuario

/*
	Projeto: WGA - Web Gerenciador de Atividades.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes.
	Data de início: 2019-09-09T06:04:57.576Z.
	Data Atual: 09/09/2019.
*/

Class ProjetousuarioControl {
	//atributos
	protected $con;
	protected $obj;
	protected $objDAO;

	//construtor
	public function __construct(Projetousuario $obj=NULL) {
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDAO = new ProjetousuarioDAO($this->con);
		$this->obj = $obj;
	}

	//metodos
	function cadastrar () {
		return $this->objDAO->cadastrar($this->obj);
	}
	function buscarPorId () {
		return $this->objDAO->buscarPorId($this->obj);
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
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>