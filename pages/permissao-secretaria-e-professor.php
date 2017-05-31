<?php
include_once 'perfil.php';
if(EPerfil::Secretaria != $_SESSION['perfil'] && EPerfil::Professor != $_SESSION['perfil']){
    header('location: index.php');
    die;
}
?>