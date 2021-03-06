<?php
// control : ocupacao

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: ADELSON GUIMARÃES MONTEIRO.
	Desenvolvedor: ADELSON GUIMARÃES MONTEIRO.
	Data de início: 2019-09-30T15:47:03.936Z.
	Data Atual: 30/09/2019.
*/

Class OcupacaoControl {
	//atributos
	protected $con;
	protected $obj;
	protected $objDAO;

	//construtor
	public function __construct(Ocupacao $obj=NULL) {
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDAO = new OcupacaoDAO($this->con);
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