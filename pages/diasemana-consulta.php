<?php
	include_once "../conf/database.php";
	include_once "diasemana.php";
		
	$dias = array();
	$result = DiaSemana::listar();
	//header('Content-type: text/html; charset=ISO-8859-1');
	if ($result && $result->num_rows > 0) {
		while($row = $result->fetch_array(MYSQL_ASSOC)) {
				$dia = new DiaSemana();
				$dia->disId = utf8_encode($row["Id"]);
				$dia->disDia = utf8_encode($row["Dia"]);
				$dias[] = $dia;			            
		}
		echo json_encode($dias);
	}
?>
