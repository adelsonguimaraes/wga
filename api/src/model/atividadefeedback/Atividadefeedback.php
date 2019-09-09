<?php
// model : atividadefeedback

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes Monteiro.
	Data de início: 2019-09-09T13:23:46.531Z.
	Data Atual: 09/09/2019.
*/

Class Atividadefeedback implements JsonSerializable {
	//atributos
	private $id;
	private $objatividade;
	private $objprojetousuario;
	private $mensagem;
	private $secreta;
	private $datacadastro;
	private $dataedicao;

	//constutor
	public function __construct
	(
		$id = NULL,
		Atividade $objatividade = NULL,
		Projetousuario $objprojetousuario = NULL,
		$mensagem = NULL,
		$secreta = NULL,
		$datacadastro = NULL,
		$dataedicao = NULL
	)
	{
		$this->id	= $id;
		$this->objatividade	= $objatividade;
		$this->objprojetousuario	= $objprojetousuario;
		$this->mensagem	= $mensagem;
		$this->secreta	= $secreta;
		$this->datacadastro	= $datacadastro;
		$this->dataedicao	= $dataedicao;
	}

	//Getters e Setters
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getObjatividade() {
		return $this->objatividade;
	}
	public function setObjatividade($objatividade) {
		$this->objatividade = $objatividade;
		return $this;
	}
	public function getObjprojetousuario() {
		return $this->objprojetousuario;
	}
	public function setObjprojetousuario($objprojetousuario) {
		$this->objprojetousuario = $objprojetousuario;
		return $this;
	}
	public function getMensagem() {
		return $this->mensagem;
	}
	public function setMensagem($mensagem) {
		$this->mensagem = $mensagem;
		return $this;
	}
	public function getSecreta() {
		return $this->secreta;
	}
	public function setSecreta($secreta) {
		$this->secreta = $secreta;
		return $this;
	}
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}
	public function getDataedicao() {
		return $this->dataedicao;
	}
	public function setDataedicao($dataedicao) {
		$this->dataedicao = $dataedicao;
		return $this;
	}

	//Json Serializable
	public function JsonSerialize () {
		return [
			"id"	=> $this->id,
			"objatividade"	=> $this->objatividade,
			"objprojetousuario"	=> $this->objprojetousuario,
			"mensagem"	=> $this->mensagem,
			"secreta"	=> $this->secreta,
			"datacadastro"	=> $this->datacadastro,
			"dataedicao"	=> $this->dataedicao
		];
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>