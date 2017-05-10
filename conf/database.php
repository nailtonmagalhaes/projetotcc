<?php
	include_once 'config.php';
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	//header('Content-type: text/html; charset=utf-8');

	function open_database() {
		try {
			//echo "DB_HOST: ".DB_HOST;
			//echo "DB_USER: ".DB_USER;
			//echo "DB_PASSWORD: ".DB_PASSWORD;
			//echo "DB_NAME: ".DB_NAME;

			$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			return $conn;
		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	function close_database($conn) {
		try {
			mysqli_close($conn);
			//echo "conexao fechada com sucesso<br />";
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function alterar($str){
		$conn;
		try{
			$conn = open_database();
			//$stmt = $conn->prepare("INSERT INTO `cliente` (`nome`,`email`,`cidade`,`uf`) VALUES (?,?,?,?)"); 
			//$stmt->bind_param('ssss', $nome, $email, $cidade, $uf); 
			$stmt = $conn->prepare($str);
			if(!$stmt->execute()) { 
				return false;
			} else { 
				return true;
			}

		}catch(Exception $e){
			echo "<h1>Erro: ".$e->getMessage()."</h1>";
		}finally{
			close_database($conn);
		}
	}

	function insere($str){
		$conn;
		try{
			$conn = open_database();
			$stmt = $conn->prepare($str);
			if(!$stmt->execute()) { 
				return false;
			} else { 
				return $conn->insert_id;
			}
		}catch(Exception $e){
			echo "<h1>Erro: ".$e->getMessage()."</h1>";
		}finally{
			close_database($conn);
		}
	}

	function listar($str){
		$conn;
		try{
			//Para corrigir a acentuação
			//header('Content-type: text/html; charset=ISO-8859-1');
			$conn = open_database();
			$resultado = $conn->query($str);
			if ($resultado && $resultado->num_rows > 0) {
				return $resultado;
			}else{
				return null;
			}
		}catch(Exception $e){
			echo "<h1>Erro: ".$e->getMessage()."</h1>";
		}finally{
			close_database($conn);
		}
	}
?>