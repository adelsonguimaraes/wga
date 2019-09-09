<?php
// model : projetousuario

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes Monteiro.
	Data de início: 2019-09-09T13:23:46.531Z.
	Data Atual: 09/09/2019.
*/

Class Projetousuario implements JsonSerializable {
	//atributos
	private $id;
	private $objprojeto;
	private $objusuario;
	private $privilegio;
	private $ativo;
	private $datacadastro;
	private $dataedicao;

	//constutor
	public function __construct
	(
		$id = NULL,
		Projeto $objprojeto = NULL,
		Usuario $objusuario = NULL,
		$privilegio = NULL,
		$ativo = NULL,
		$datacadastro = NULL,
		$dataedicao = NULL
	)
	{
		$this->id	= $id;
		$this->objprojeto	= $objprojeto;
		$this->objusuario	= $objusuario;
		$this->privilegio	= $privilegio;
		$this->ativo	= $ativo;
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
	public function getObjusuario() {
		return $this->objusuario;
	}
	public function setObjusuario($objusuario) {
		$this->objusuario = $objusuario;
		return $this;
	}
	public function getPrivilegio() {
		return $this->privilegio;
	}
	public function setPrivilegio($privilegio) {
		$this->privilegio = $privilegio;
		return $this;
	}
	public function getAtivo() {
		return $this->ativo;
	}
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
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
			"objusuario"	=> $this->objusuario,
			"privilegio"	=> $this->privilegio,
			"ativo"	=> $this->ativo,
			"datacadastro"	=> $this->datacadastro,
			"dataedicao"	=> $this->dataedicao
		];
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>