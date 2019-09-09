<?php
// model : atividadefeedbackusuario

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes Monteiro.
	Data de início: 2019-09-09T13:23:46.531Z.
	Data Atual: 09/09/2019.
*/

Class Atividadefeedbackusuario implements JsonSerializable {
	//atributos
	private $id;
	private $objatividadefeedback;
	private $objprojetousuario;
	private $datacadastro;

	//constutor
	public function __construct
	(
		$id = NULL,
		Atividadefeedback $objatividadefeedback = NULL,
		Projetousuario $objprojetousuario = NULL,
		$datacadastro = NULL
	)
	{
		$this->id	= $id;
		$this->objatividadefeedback	= $objatividadefeedback;
		$this->objprojetousuario	= $objprojetousuario;
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
	public function getObjatividadefeedback() {
		return $this->objatividadefeedback;
	}
	public function setObjatividadefeedback($objatividadefeedback) {
		$this->objatividadefeedback = $objatividadefeedback;
		return $this;
	}
	public function getObjprojetousuario() {
		return $this->objprojetousuario;
	}
	public function setObjprojetousuario($objprojetousuario) {
		$this->objprojetousuario = $objprojetousuario;
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
			"objatividadefeedback"	=> $this->objatividadefeedback,
			"objprojetousuario"	=> $this->objprojetousuario,
			"datacadastro"	=> $this->datacadastro
		];
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>