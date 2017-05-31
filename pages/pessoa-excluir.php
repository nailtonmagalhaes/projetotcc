<?php
	include_once '../conf/acesso-dados.php';
	include_once 'pessoa.php';
	header('Content-Type: application/json');
	//header('Content-type: text/html; charset=utf-8');
	//header('Content-type: text/html; charset=ISO-8859-1');

	/* VERIFICO SE HOUVE UM POST */
	if(count($_POST) > 0 && $_POST["id"] > 0) {
		try{

			$pessoa = new Pessoa();
			$pessoa->pesId = addslashes($_POST["id"]);

			if($pessoa->excluirLogicamente()){
				echo json_encode(array('success'=>true, 'message'=>'Registro inativado com sucesso!'));
			}else{
				echo json_encode(array('success'=>false, 'message'=>'Não foi possíve inativar o registro!'));
			}
		}catch(Exception $e){
			echo json_encode(array('success'=>false, 'message'=>$e->getMessage()));
		}
	}else{
		echo json_encode(array('success'=>false, 'message'=>'Registro não encontrado!'));
	}
?>