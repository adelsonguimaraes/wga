<?php
// model : atividade

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes Monteiro.
	Data de início: 2019-09-09T13:23:46.531Z.
	Data Atual: 09/09/2019.
*/

Class Atividade implements JsonSerializable {
	//atributos
	private $id;
	private $objprojeto;
	private $objprojetousuario;
	private $nome;
	private $descricao;
	private $status;
	private $datacadastro;
	private $dataedicao;

	//constutor
	public function __construct
	(
		$id = NULL,
		Projeto $objprojeto = NULL,
		Projetousuario $objprojetousuario = NULL,
		$nome = NULL,
		$descricao = NULL,
		$status = NULL,
		$datacadastro = NULL,
		$dataedicao = NULL
	)
	{
		$this->id	= $id;
		$this->objprojeto	= $objprojeto;
		$this->objprojetousuario	= $objprojetousuario;
		$this->nome	= $nome;
		$this->descricao	= $descricao;
		$this->status	= $status;
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
	public function getObjprojeto() {
		return $this->objprojeto;
	}
	public function setObjprojeto($objprojeto) {
		$this->objprojeto = $objprojeto;
		return $this;
	}
	public function getObjprojetousuario() {
		return $this->objprojetousuario;
	}
	public function setObjprojetousuario($objprojetousuario) {
		$this->objprojetousuario = $objprojetousuario;
		return $this;
	}
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
		return $this;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
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
			"objprojeto"	=> $this->objprojeto,
			"objprojetousuario"	=> $this->objprojetousuario,
			"nome"	=> $this->nome,
			"descricao"	=> $this->descricao,
			"status"	=> $this->status,
			"datacadastro"	=> $this->datacadastro,
			"dataedicao"	=> $this->dataedicao
		];
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>