<?php 
    include_once 'material.php';

	/* VERIFICO SE HOUVE UM POST */
	if(count($_POST) > 0 && $_POST["id"] > 0) {
		try{         
			
			$material = new Material();
			$material->matId = addslashes($_POST["id"]);

			if($material->excluirLogicamente()){
				echo json_encode(true);
			}else{
				echo json_encode(false);
			}
		}catch(Exception $e){
			echo json_encode($e->getMessage()); 
		}		 
	}else{
		echo json_encode("Material não encontrada!");
	}
?>


