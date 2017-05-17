<?php
	
    include_once 'curso.php';
	include_once '../conf/acesso-dados.php';

 ?>
<!--Alert Top Cheio de Viadagem mais e Top--> 
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">  
<script src="../sweetalert-master/dist/sweetalert.min.js"></script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
			<?php

				/* VERIFICO SE HOUVE UM POST */
				if(count($_POST) > 0) {
					$curso = new Curso();

					if(isset($_POST["crsId"])){
						$curso->crsId = $_POST["crsId"];
					}
					if(isset($_POST["crsDescricao"])){
						$curso->crsDescricao = $_POST["crsDescricao"];
					}
					if(isset($_POST["crsDuracao"])){
						$curso->crsDuracao = $_POST["crsDuracao"];	
					}						

					if(empty($curso->crsDescricao) || empty($curso->crsDuracao)){
						header('location: ..\pages\curso-cadastro.php?id='.$curso->crsId.'&descricao='.$curso->crsDescricao.'&duracao='.$curso->crsDuracao);
						die;
					}		

					try{
						AcessoDados::abreTransacao();
						$idinserido = $curso->salvarDados();
						AcessoDados::confirmaTransacao();
						if($idinserido){
							header("location: ..\pages\curso-listar.php");
							?>
	
							<?php //header("location: ..\pages\curso-listar.php");
						}else{
							header('location: ..\pages\curso-cadastro.php?id='.$curso->crsId.'&descricao='.$curso->crsDescricao.'&duracao='.$curso->crsDuracao);
						}
					}catch(Exception $e){
						echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
					}	 
				}
			?>
        </div>
    </div>
</div>

