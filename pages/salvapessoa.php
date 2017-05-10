<?php
	include_once "menu.php";
    include_once 'includes.php';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dados salvos com sucesso!</h1>
            <?php

            	$nome = $_POST["pesNome"];
			    $cpf = $_POST["pesCpf"];
			    $rg = $_POST["pesRg"];
			    $dataNascimento = $_POST["pesDataNascimento"];
			    $senha = $_POST["pesSenha"];
			  	$responsavel = $_POST["pesResponsavel"];
			  	$sexo = $_POST["pesSexo"];

			  	if(validaCPF($cpf)){
			  		echo "O cpf ".$cpf." é válido.<br/>";
			  	}else{
			  		echo "O cpf ".$cpf." é inválido.<br/>";
			  	}

				$pessoa = new Pessoa();
				$pessoa->pesNome=$nome;
				$pessoa->pesCpf=$cpf;
				$pessoa->pesRg=$rg;
				$pessoa->pesDataNascimento=$dataNascimento;
				$pessoa->pesSexo=$sexo;

				echo"<br>"."Nome: ".$pessoa->pesNome."<br>";
				echo"<br>"."CPF: ".$pessoa->pesCpf."<br>";
				echo"<br>"."RG: ".$pessoa->pesRg."<br>";
				echo"<br>"."Data de Nascimento: ".$pessoa->pesDataNascimento."<br>";
				echo"<br>"."Sexo: ".$pessoa->pesSexo."<br>";
            ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>