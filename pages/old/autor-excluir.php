<?php 

    include_once 'autor.php';

	/* VERIFICO SE HOUVE UM POST */
	if(count($_POST) > 0 && $_POST["id"] > 0) {
		try{         
			
			$autor = new Autor();
            
			$autor->autId = addslashes($_POST["id"]);
			
            
			if($autor->excluirLogicamente()){
                echo json_encode(true);
			}else{
				echo json_encode(false);
			}
		}catch(Exception $e){
			echo json_encode($e->getMessage()); 
		}		 
	}else{
		echo json_encode("Autor não encontrado!");
	}
?>


