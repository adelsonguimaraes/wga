<?php
/*
	Projeto: WGA - Web Gerenciador de Atividades.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes.
	Data de início: 2019-09-09T06:04:57.576Z.
	Data Atual: 09/09/2019.
*/

Class Conexao {
	private $con;

	protected function __construct () {
		$this->con = mysqli_connect("localhost","root","", "wga");
		if (mysqli_connect_error()) {
			echo "Falha na conexão com MySQL: " . mysqli_connect_error();
		}
	}
	public static function getInstance () {
		static $instance = null;
		if (null === $instance){
			$instance = new static();
		}
		return $instance;
	}
	public function getConexao () {
		mysqli_query($this->con, "SET NAMES 'utf8'");
		mysqli_query($this->con, 'SET character_set_connection=utf8');
		mysqli_query($this->con, 'SET character_set_client=utf8');
		mysqli_query($this->con, 'SET character_set_result=utf8');
		return $this->con;
	}
}

// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>