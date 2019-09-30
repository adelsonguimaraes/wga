<?php
// rest : usuario

/*
	Projeto: WGA - WEB GERENCIADOR DE ATIVIDADES.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes Monteiro.
	Data de início: 2019-09-09T13:23:46.531Z.
	Data Atual: 09/09/2019.
*/

//inclui autoload
require_once 'autoload.php';

//verifica requisição
$_POST['metodo']();

function cadastrar () {
	$data = $_POST['data'];
	$obj = new Usuario(
		NULL,
		$data['nome'],
		$data['celular1'],
		$data['celular2'],
		$data['email'],
		$data['senha'],
		$data['ultimoacesso']
	);
	$control = new UsuarioControl($obj);
	$response = $control->cadastrar();
	echo json_encode($response);
}
function buscarPorId () {
	$data = $_POST['data'];
	$control = new UsuarioControl(new Usuario($data['id']));
	$response = $control->buscarPorId();
	echo json_encode($response);
}
function listar () {
	$control = new OcupacaoControl();
	$response = $control->listar();
	echo json_encode($response);
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new Usuario(
		$data['id'],
		$data['nome'],
		$data['celular1'],
		$data['celular2'],
		$data['email'],
		$data['senha'],
		$data['ultimoacesso']
	);
	$control = new UsuarioControl($obj);
	$response = $control->atualizar();
	echo json_encode($response);
}
function deletar () {
	$data = $_POST['data'];
	$banco = new Usuario();
	$banco->setId($data['id']);
	$control = new UsuarioControl($banco);
	echo json_encode($control->deletar());
}


// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>