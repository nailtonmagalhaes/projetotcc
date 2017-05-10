<?php
	include_once "menu.php";
    include_once 'includes.php';

	$sql = "SELECT Id, Nome FROM tbEstado ORDER BY Nome";
	//header('Content-type: text/html; charset=ISO-8859-1');
	if ($result = listar($sql)) {
	    while($row = $result->fetch_array(MYSQL_ASSOC)) {
            echo "<option value=".$row["Id"].">".$row["Nome"]."</option>";
	    }
	}else{
		//echo '<option value="">Selecione uma cidade</option>';
		return null;
	}
?>