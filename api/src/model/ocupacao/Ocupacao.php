<?php
// model : ocupacao

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: ADELSON GUIMARÃES MONTEIRO.
	Desenvolvedor: ADELSON GUIMARÃES MONTEIRO.
	Data de início: 2019-09-30T15:47:03.936Z.
	Data Atual: 30/09/2019.
*/

Class Ocupacao implements JsonSerializable {
	//atributos
	private $id;
	private $codigo;
	private $descricao;
	private $datacadastro;

	//constutor
	public function __construct
	(
		$id = NULL,
		$codigo = NULL,
		$descricao = NULL,
		$datacadastro = NULL
	)
	{
		$this->id	= $id;
		$this->codigo	= $codigo;
		$this->descricao	= $descricao;
		$this->datacadastro	= $datacadastro;
	}

	//Getters e Setters
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getCodigo() {
		return $this->codigo;
	}
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
		return $this;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}

	//Json Serializable
	public function JsonSerialize () {
		return [
			"id"	=> $this->id,
			"codigo"	=> $this->codigo,
			"descricao"	=> $this->descricao,
			"datacadastro"	=> $this->datacadastro
		];
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>