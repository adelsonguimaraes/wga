<?php
// rest : atividadefeedbackusuario

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
	$obj = new Atividadefeedbackusuario(
		NULL,
		new Atividadefeedback($data['idatividadefeedback']),
		new Projetousuario($data['idprojetousuario'])
	);
	$control = new AtividadefeedbackusuarioControl($obj);
	$response = $control->cadastrar();
	echo json_encode($response);
}
function buscarPorId () {
	$data = $_POST['data'];
	$control = new AtividadefeedbackusuarioControl(new Atividadefeedbackusuario($data['id']));
	$response = $control->buscarPorId();
	echo json_encode($response);
}
function listar () {
	$control = new AtividadefeedbackusuarioControl(new Atividadefeedbackusuario);
	$response = $control->listar();
	echo json_encode($response);
}
function atualizar () {
	$data = $_POST['data'];
	$obj = new Atividadefeedbackusuario(
		$data['id'],
		new Atividadefeedback($data['idatividadefeedback']),
		new Projetousuario($data['idprojetousuario'])
	);
	$control = new AtividadefeedbackusuarioControl($obj);
	$response = $control->atualizar();
	echo json_encode($response);
}
function deletar () {
	$data = $_POST['data'];
	$banco = new Atividadefeedbackusuario();
	$banco->setId($data['id']);
	$control = new AtividadefeedbackusuarioControl($banco);
	echo json_encode($control->deletar());
}


// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães
?>