<?php
session_start();

/* Inclui a Class de autoLoad */
require_once 'autoload.php';

$_POST['metodo']();

/*
	Metodos
*/

function enviarCodAutorizacao () {
    $data = $_POST["data"];
    $data['data']['nome'] = GenericFunctions::formatNome($data['data']['nome']);
    $cod = $data["cod"];

    // verificando se o email já está cadastrado no banco de dados
    $controlUsuario = new UsuarioControl();
    $resp = $controlUsuario->buscarPorEmail($data['data']['email']);
    if ($resp['success'] == false) return $resp;
    
    // caso retorne algum dado do email do usuario buscado
    if (!empty($resp['data'])) {
        $resp['msg'] = "Este email já está cadastrado!";
        $resp['success'] = false;
        die (json_encode($resp));
    }

    // html com o corpo da msg
    $html = "Olá <b>" . $data['data']['nome'] . "</b>,
    <br>seu código de autorização é <b>" . $cod . "</b>.";
    
    // como usar
    $obj = new EnviaEmail();
    $obj->setRemetente('GWA - Gerenciamento Web de Atividades')
	    ->setAssunto('Código de Autorização - '  . date('H:i:s d/m/Y'))
	    ->setEmails(array('adelsonguimaraes@gmail.com'))
	    ->setMensagem($html);
    $obj->enviar();

    $response = array("success"=>true, "data"=>"", "msg"=>"");

    echo json_encode($response);

}

function registrar () {
    $data = $_POST['data'];
    $data["nome"] = GenericFunctions::formatNome($data['nome']);

    // cadastrando novo usuario no banco de dados
    $obj = new Usuario();
    $obj->setNome($data["nome"])
        ->setEmail($data['email'])
        ->setSenha($data['senha'])
        ->setUltimoacesso(date("Y-m-d H:i:s"));
    $control = new UsuarioControl($obj);
    $resp = $control->cadastrar();
    if ($resp['success'] == false) die (json_encode($resp));

    // loga o usuário em seguida
    $control = new UsuarioControl();
	$resp = $control->logar($data['email'], $data['senha']);
    echo json_encode($resp);
}

function logar() {

    $con = Conexao::getInstance()->getConexao();

    $data = $_POST['data'];

    $senha= $data['senha'];
    $email = $data['email']; 

    $email = stripslashes       ( strip_tags( trim( $email ) ) ); 
    $senha = stripslashes ( strip_tags( trim( $senha ) ) ); 

    $email = mysqli_real_escape_string( $con, $email ); 
    $senha = mysqli_real_escape_string ( $con ,$senha ); 
    
    $usuarioControl = new UsuarioControl();
	$response = $usuarioControl->logar($email, $senha);

    echo json_encode( $response );
}

function mudarSenha() {

    $con = Conexao::getInstance()->getConexao();

    $data = $_POST;

    $idusuario = $data['idusuario'];
    $senhaatual= $data['senhaatual'];
    $novasenha = $data['novasenha'];

    $usuarioControl = new UsuarioControl();
    $response = $usuarioControl->mudarSenha($idusuario, $senhaatual, $novasenha);

    echo json_encode( $response );
}

function auth () {
    $usuario = $_POST['usuario'];
    $control = new UsuarioControl();
    if (empty($usuario['auth'])) die (json_encode(array("success"=>false, "msg"=>"Usuário não autenticado!")));
    echo json_encode($control->auth($usuario['idusuario'], $usuario['auth']));
}

function getMenu() {
    $usuario = $_POST["usuario"];
    $usuarioControl = new UsuarioControl();
    echo json_encode($usuarioControl->getMenu($usuario["idusuario"]));
}