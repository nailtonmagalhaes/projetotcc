<?php
    include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'curso.php';

    $curso = new Curso();
    $resultado = $curso->listar();

    include_once 'curso-listar.php';
?>