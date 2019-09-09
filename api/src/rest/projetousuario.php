<?php
// rest : projetousuario

/*
	Projeto: WGA - Web Gerenciador de Atividades.
	Project Owner: Adelson Guimarães Monteiro.
	Desenvolvedor: Adelson Guimaraes.
	Data de início: 2019-09-09T06:04:57.576Z.
	Data Atual: 09/09/2019.
*/

//inclui autoload
require_once 'autoload.php';

//verifica requisição
switch ($_POST['metodo']) {
	case 'cadastrar':
		cadastrar();
		break;
	case 'buscarPorId':
		buscarPorId();
		break;
	case 'listar':
		listar();
		break;
	case 'atualizar':
		atualizar();
		break;
	case 'deletar':
		deletar();
		break;
}

function cadastrar () {
	$data = $_POST['data'];
	$obj = new Projetousuario(
		NULL,
		new Projeto($data['idprojeto']),
		new Usuario($data['idusuario']),
		$data['ativo']
	);
	$control = new ProjetousuarioControl($obj);
	$response = $control->cadastrar();
	echo json_encode($response);
}
function buscarPorId () {
	$data = $_POST['data'];
	$control = new ProjetousuarioControl(new Projetousuario($data['id']));
	$response = $control->buscarPorId();
	echo json_encode($response);
}
function listar () {
	$control = new ProjetousuarioControl(new Projetousuario);
	$response = $control->listar();
	echo json_encode($response);
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new Projetousuario(
		$data['id'],
		new Projeto($data['idprojeto']),
		new Usuario($data['idusuario']),
		$data['ativo']
	);
	$control = new ProjetousuarioControl($obj);
	$response = $control->atualizar();
	echo json_encode($response);
}
function deletar () {
	$data = $_POST['data'];
	$banco = new Projetousuario();
	$banco->setId($data['id']);
	$control = new ProjetousuarioControl($banco);
	echo json_encode($control->deletar());
}


// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>