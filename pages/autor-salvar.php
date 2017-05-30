<?php	
	include_once 'autor.php';
	include_once '../conf/acesso-dados.php';	

?>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">  
<script src="../sweetalert-master/dist/sweetalert.min.js"></script>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
			<?php
				/* VERIFICO SE HOUVE UM POST */
				if(count($_POST) > 0) {
					$autor = new Autor();
					if(isset($_POST["autId"])){
						$autor->autId = $_POST["autId"];
					}
					if(isset($_POST["autNome"])){
						$autor->autNome = $_POST["autNome"];
					}
					if(isset($_POST["autDescricao"])){
						$autor->autDescricao = $_POST["autDescricao"];
					}
					if(isset($_POST["autAtivo"])){
						$autor->autAtivo = $_POST["autAtivo"];
					}
					
					if(empty($autor->autDescricao) || empty($autor->autNome)){
						header('location: ..\pages\autor-cadastro.php?id='.$autor->autId.'&descricao='.$autor->autDescricao.'&nome='.$autor->autNome);
						die;
					}	
					try{
						AcessoDados::abreTransacao();
						$idinserido = $autor->salvarDados();
						AcessoDados::confirmaTransacao();
						if($idinserido){
							?>
							<script>
			            		try {
				            		swal("Dados salvos com sucesso", "", "success");
				            		window.setTimeout("location.href='../pages/autor-listar.php'",1000);
			            		} catch (e) {
			            			alert(e);
			            		}
			            	</script>
							<?php header("location: ..\pages\autor-listar.php");
						}else{
							header('location: ..\pages\autor-cadastro.php?id='.$autor->autId.'&descricao='.$autor->autDescricao.'&nome='.$autor->autNome);
						}
					}catch(Exception $e){
						echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
					}	 
				}
			?>
        </div>
    </div>
</div>	