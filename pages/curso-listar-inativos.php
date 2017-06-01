<?php
    include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'curso.php';

    $curso = new Curso();
    $resultado = $curso->listarInativos();

    include_once 'curso-listar.php';
?>