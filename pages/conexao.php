<?php

$servidor = 'robb0372.publiccloud.com.br';
$banco = 'marciovieira_bancoptn';
$usuario = 'marci_root';
$senha = '#@Bl860';
$link = mysql_connect($servidor, $usuario, $senha);
$db = mysql_select_db($banco,$link);
if(!$link)
{
    echo "erro ao conectar ao banco de dados!";exit();

    
}
?>