<?php

include('conexao.php');

if(empty($_POST['usuario'])||empty($_POST['senha'])) {

    header('Location: index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);

$query = "select usuario from usuario where usuario = '{$usuario}' and senha = ('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['usuario'] = $usuario;
	header('Location: painel.php');
	if($cargo == 'medico') {
        $_SESSION['usuario'] = $usuario;
        header('Location: painel.php');
        exit();
    } elseif($cargo =='secretaria') {
        $_SESSION['usuario'] = $usuario;
        header('Location: painel2.php');
        exit();
    }elseif($cargo =='gerente') {
        $_SESSION['usuario'] = $usuario;
        header('Location: painel3.php');
        exit();
}} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}





