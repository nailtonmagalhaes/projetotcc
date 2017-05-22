<?php
	session_start();

    if((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['senha']) == true) and (!isset($_SESSION['perfil']) == true)){
        unset($_SESSION['cpf']);
        unset($_SESSION['senha']);
        unset($_SESSION['nome']);
        unset($_SESSION['perfil']);
        header('location: ../index.php');
    }
?>