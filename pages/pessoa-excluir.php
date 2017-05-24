<?php 
	include_once '../conf/acesso-dados.php';
	include_once 'pessoa.php';
	//header('Content-type: text/html; charset=utf-8');
	//header('Content-type: text/html; charset=ISO-8859-1');

	/* VERIFICO SE HOUVE UM POST */
	if(count($_POST) > 0 && $_POST["id"] > 0) {
		try{         
			
			$pessoa = new Pessoa();
			$pessoa->pesId = addslashes($_POST["id"]);
			echo $pessoa->pesId;
			
			echo "<pre>";
			var_dump($pessoa);

			if($pessoa->excluirLogicamente()){
				echo json_encode(true);
			}else{
				echo json_encode(false);
			}
		}catch(Exception $e){
			echo json_encode($e->getMessage()); 
		}		 
	}else{
		echo json_encode("Registro não encontrado!");
	}
?>