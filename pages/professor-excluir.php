<?php 
	//include_once 'menu.php';
    include_once 'includes.php';
?>

<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css"> 

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
			<?php

				/* VERIFICO SE HOUVE UM POST */
				if(count($_POST) > 0 && $_POST["id"] > 0) {
                                
                                $professor = new Professor();    
                                    
                                if(isset($_POST["id"])){
                                    $professor->profId = $_POST["id"];
                                }
                                
			    	try{         
			 	
                                    $retorno = $professor->excluir();
                                    
			            $execucao = insere($retorno);
                                    
                                    if($execucao){
                                            ?>
                                            <script>
                                                swal("Professor excluído com sucesso!", "", "success");
                                                window.setTimeout("location.href='../pages/professor-listar.php'",2000);
                                            </script>	
                                            <?php							
                                    }
    					//header("location: ..\pages\curso-listar.php");
    					
		            }catch(Exception $e){
						echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
					}		 
				}
			?>
        </div>
    </div>
</div>

