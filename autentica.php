<?php
	include_once 'conf/acesso-dados.php';
	include_once 'pages/pessoa.php';
	include_once 'pages/utils.php';

	session_start();

	$pessoa = new Pessoa();

	if(isset($_POST)){

		$pessoa->pesCpf = addslashes(Mascaras::removeMascara($_POST['cpf']));
		$pessoa->pesSenha = addslashes(sha1($_POST['senha']));

		$resultado = $pessoa->logar();

		if($resultado->num_rows > 0){
			$row = $resultado->fetch_assoc();
			$_SESSION['nome'] = $row['Nome'];
			$_SESSION['perfil'] = $row['Perfil'];
			$_SESSION['cpf'] = $row['Cpf'];
			$_SESSION['id'] = $row['Id'];
			$_SESSION['senha'] = $row['Senha'];
			header('location: pages/index.php');
		}else{			
			unset($_SESSION['nome']);
			unset($_SESSION['perfil']);
			unset($_SESSION['cpf']);
			unset($_SESSION['id']);
			unset($_SESSION['senha']);
			header('location: index.php');
		}
	}
?>