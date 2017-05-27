<?php
	
    include_once 'matricula.php';
    include_once '../conf/acesso-dados.php';
    
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
					$matricula = new Matricula();

					if(isset($_POST["matId"])){
						$matricula->matId = $_POST["matId"];
					}						

					if(isset($_POST["matAluno"])){
						$matricula->matAluno = $_POST["matAluno"];
					}						

					if(isset($_POST["matTurma"])){
						$matricula->matTurma = $_POST["matTurma"];
					}						
                                        if(isset($_POST["matAluno"])&&isset($_POST["matTurma"])){
                                                $matricula->matNumero = $matricula->matTurma.$matricula->matAluno;
                                        }

					try{ 				 			

						if($matricula->salvarDados()){
							?>
							<script>
								swal("Dados salvos com sucesso!", "", "success");
								window.setTimeout("location.href='../pages/matricula-listar.php'",2000);
							</script>
							<?php
						}else{
							header('location: ..\pages\matricula-cadastro.php?id='.$matricula->matId.'&descricao='.$matricula->matDescricao);
						}
					}catch(Exception $e){
						echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
					}	 
				}
			?>
        </div>
    </div>
</div>

