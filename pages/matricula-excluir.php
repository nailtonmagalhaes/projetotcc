<?php 
    include_once 'matricula.php';
    include_once '../conf/acesso-dados.php';

//    var_dump($_REQUEST);die;
	/* VERIFICO SE HOUVE UM POST */
	if(count($_POST) > 0 && $_POST["id"] > 0) {
		try{         
			
			$matricula = new Matricula();
			$matricula->matId = addslashes($_POST["id"]);

			if($matricula->excluirLogicamente()){
				echo json_encode(true);
			}else{
				echo json_encode(false);
			}
		}catch(Exception $e){
			echo json_encode($e->getMessage()); 
		}		 
	}else{
		echo json_encode("Matrícula não encontrada!");
	}
?>


