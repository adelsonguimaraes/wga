<?php
// model : usuario

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes Monteiro.
	Data de início: 2019-09-09T13:23:46.531Z.
	Data Atual: 09/09/2019.
*/

Class Usuario implements JsonSerializable {
	//atributos
	private $id;
	private $nome;
	private $idocupacao;
	private $celular1;
	private $celular2;
	private $email;
	private $senha;
	private $ultimoacesso;
	private $datacadastro;
	private $dataedicao;

	//constutor
	public function __construct
	(
		$id = NULL,
		$nome = NULL,
		$idocupacao = NULL,
		$celular1 = NULL,
		$celular2 = NULL,
		$email = NULL,
		$senha = NULL,
		$ultimoacesso = NULL,
		$datacadastro = NULL,
		$dataedicao = NULL
	)
	{
		$this->id	= $id;
		$this->nome	= $nome;
		$this->idocupacao = $cargo;
		$this->celular1	= $celular1;
		$this->celular2	= $celular2;
		$this->email	= $email;
		$this->senha	= $senha;
		$this->ultimoacesso	= $ultimoacesso;
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
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
		return $this;
	}
	public function getObjocupacao() {
		return $this->idocupacao;
	}
	public function setObjocupacao($idocupacao) {
		$this->idocupacao = $idocupacao;
		return $this;
	}
	public function getCelular1() {
		return $this->celular1;
	}
	public function setCelular1($celular1) {
		$this->celular1 = $celular1;
		return $this;
	}
	public function getCelular2() {
		return $this->celular2;
	}
	public function setCelular2($celular2) {
		$this->celular2 = $celular2;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
		return $this;
	}
	public function getUltimoacesso() {
		return $this->ultimoacesso;
	}
	public function setUltimoacesso($ultimoacesso) {
		$this->ultimoacesso = $ultimoacesso;
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
			"nome"	=> $this->nome,
			"idocupacao" => $this->idocupacao,
			"celular1"	=> $this->celular1,
			"celular2"	=> $this->celular2,
			"email"	=> $this->email,
			"senha"	=> $this->senha,
			"ultimoacesso"	=> $this->ultimoacesso,
			"datacadastro"	=> $this->datacadastro,
			"dataedicao"	=> $this->dataedicao
		];
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>