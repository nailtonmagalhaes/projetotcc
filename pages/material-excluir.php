<?php 
    include_once 'material.php';
    include_once '../conf/acesso-dados.php';
    header('Content-Type: application/json');

	/* VERIFICO SE HOUVE UM POST */
	if(count($_POST) > 0 && $_POST["id"] > 0) {
		try{         
			
			$material = new Material();
			$material->matId = addslashes($_POST["id"]);

			if($material->excluirLogicamente()){
				echo json_encode(array('success'=>true, 'message'=>'Material inativado com sucesso'));
			}else{
				echo json_encode(array('success'=>false, 'message'=>~utf8_decode('Não foi possível inativar o material')));
			}
		}catch(Exception $e){
			echo json_encode(array('success'=>false, 'message'=>utf8_encode($e->getMessage())));
		}		 
	}else{
		echo json_encode(array('success'=>false, 'message'=>utf8_encode('Material não encontrado')));
	}
?>


