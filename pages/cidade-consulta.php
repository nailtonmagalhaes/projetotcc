<?php
	include_once "../conf/database.php";
	include_once "../pages/cidade.php";

	$estado = isset($_GET['estado']) ? $_GET['estado'] : ''; 
	if(!empty($estado)){

		/*$sql = "SELECT Id, Nome FROM tbCidade WHERE IdEstado = ".addslashes($estado)." ORDER BY Nome";
		header('Content-type: text/html; charset=ISO-8859-1');
		if ($result = listar($sql)) {
		    while($row = $result->fetch_array(MYSQL_ASSOC)) {
	            echo "<option value=".$row["Id"].">".$row["Nome"]."</option>";
		    }
		}else{
			echo '<option value="">Selecione uma cidade</option>';
		}*/
		
		$cidades = array();
		$result = Cidade::listarPorEstado($estado);
		//header('Content-type: text/html; charset=ISO-8859-1');
		if ($result && $result->num_rows > 0) {
			while($row = $result->fetch_array(MYSQL_ASSOC)) {
					$cidade = new Cidade();
					$cidade->cidId = utf8_encode($row["Id"]);
					$cidade->cidNome = utf8_encode($row["Nome"]);
					$cidades[] = $cidade;			            
			}
			echo json_encode($cidades);
			//echo json_encode($cidades, JSON_FORCE_OBJECT);
		}	
	}
?>
