<?php
	include_once "../conf/database.php";
	include_once "diasemana.php";
		
	$dias = array();
	$result = DiaSemana::listar();
	//header('Content-type: text/html; charset=ISO-8859-1');
	if ($result && $result->num_rows > 0) {
		// para php7 $row = $result->fetch_assoc()) 
		//var_dump($result->fetch_assoc());//transforma o resultado da consulta em um array com os nomes das colunas da tabla nos indices
		//var_dump($result->fetch_array(MYSQL_ASSOC));//transforma o resultado da consulta em um array com os nomes das colunas da tabla nos indices(não funciona no php 7)
		//var_dump($result->fetch_array(MYSQL_NUM));//transforma o resultado da consulta em um array com os numeros das colunas da tabla nos indices(não funciona no php 7)
		while($row = $result->fetch_assoc()) {
				$dia = new DiaSemana();
				$dia->disId = utf8_encode($row["Id"]);
				$dia->disDia = utf8_encode($row["Dia"]);
				$dias[] = $dia;			            
		}
		echo json_encode($dias);
	}
?>
