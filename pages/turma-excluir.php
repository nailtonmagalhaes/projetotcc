<?php 
	include_once 'turma.php';
	//header('Content-type: text/html; charset=utf-8');
	//header('Content-type: text/html; charset=ISO-8859-1');

	/* VERIFICO SE HOUVE UM POST */
	if(count($_POST) > 0 && $_POST["id"] > 0) {
		try{         
			
			$turma = new Turma();
			$turma->turId = addslashes($_POST["id"]);
			echo $turma->turId;
			if($turma->excluirLogicamente()){
				echo json_encode(true);
			}else{
				echo json_encode(false);
			}
		}catch(Exception $e){
			echo json_encode($e->getMessage()); 
		}		 
	}else{
		echo json_encode("Turma não encontrado!");
	}
?>


