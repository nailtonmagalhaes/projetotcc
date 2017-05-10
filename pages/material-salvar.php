<?php
	
    include_once 'material.php';

 ?>
<!--Alert Top Cheio de Viadagem mais e Top--> 
<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">  

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
			<?php

				/* VERIFICO SE HOUVE UM POST */
				if(count($_POST) > 0) {
					$material = new Material();

					if(isset($_POST["matId"])){
						$material->matId = $_POST["matId"];
					}						

					if(isset($_POST["matDescricao"])){
						$material->matDescricao = $_POST["matDescricao"];
					}						

					if(isset($_POST["matAno"])){
						$material->matAno = $_POST["matAno"];
					}						

					if(empty($material->matDescricao) || empty($material->matAno)){
						header('location: ..\pages\material-cadastro.php?id='.$material->matId.'&descricao='.$material->matDescricao);
						die;
					}		

					try{ 				 			

						if($material->salvarDados()){
							?>
							<script>
								swal("Dados salvos com sucesso!", "", "success");
								window.setTimeout("location.href='../pages/material-listar.php'",2000);
							</script>
							<?php
						}else{
							header('location: ..\pages\material-cadastro.php?id='.$material->matId.'&descricao='.$material->matDescricao);
						}
					}catch(Exception $e){
						echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
					}	 
				}
			?>
        </div>
    </div>
</div>

