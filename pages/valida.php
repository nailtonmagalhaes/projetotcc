<?php
include_once 'acesso-dados.php';

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['CPF']) OR empty($_POST['SENHA']))) {
  header("Location: index.php"); exit;
}
try{
		$Pessoa = new Pessoa();
        $resultado = $Pesso->logar();
     if ($resultado && $resultado->num_rows != 1) {
         echo "Login inválido!"; exit;
     }
     else {
        // Salva os dados encontados na variável $resultado
        $resultado = mysql_fetch_assoc($query);
        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) session_start();
        // Salva os dados encontrados na sessão
        $_SESSION['ID'] = $resultado['Id'];
        $_SESSION['Nome'] = $resultado['Nome'];
        $_SESSION['CPF'] = $resultado['Cpf'];
        $_SESSION['Perfil'] = $resultado['Perfil'];
        // Redireciona o visitante
        header("Location: calendario_index.php"); exit;
}

                
