<?php 
include_once 'turma.php';
include_once '../conf/acesso-dados.php';
	//header('Content-type: text/html; charset=utf-8');
	//header('Content-type: text/html; charset=ISO-8859-1');
    header('Content-Type: application/json');
	/* VERIFICO SE HOUVE UM POST */
	if(count($_POST) > 0 && $_POST["id"] > 0) {
		try{         
			
			$turma = new Turma();
			$turma->turId = addslashes($_POST["id"]);
			
			if($turma->excluirLogicamente()){
				echo json_encode(array('success'=>true, 'message'=>"Turma inativada com sucesso."));
			}else{
				echo json_encode(array('success'=>false, 'message'=>utf8_encode('Não foi possível inativar a turma.')));
			}
		}catch(Exception $e){
			echo json_encode(array('success'=>false, 'message'=>utf8_encode($e->getMessage())));
		}		 
	}else{
		echo json_encode(array('success'=>false, 'message'=>utf8_encode('Turma não encontrada')));
	}
?>


