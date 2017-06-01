<?php
	include_once 'valida-sessao.php';
	class Estado{

		public $estId;
		public $estNome;
		public $estSigla;
		public $estCidades;	/*array Cidade*/

		public function __construct(){
			$this->estId = 0;
			$this->estNome = "";
			$this->estSigla = "";
			$this->estCidades = array();
		}

		public function listar(){
			return AcessoDados::listar("SELECT Id, Sigla, Nome FROM tbEstado ORDER BY Nome");
		}

		public function listarCidades(){
			return AcessoDados::listar("SELECT Id, IdEstado, Nome FROM tbCidade WHERE IdEstado = ".$this->estId." ORDER BY Nome");
		}

		public function carregarDados(){
			try{
				$resultado = AcessoDados::listar("SELECT Id, Sigla, Nome FROM tbEstado WHERE Id =".$this->estId);
				if($resultado && $resultado->num_rows > 0){
					$row = $resultado->fetch_assoc();
					$this->estNome = $row["Nome"];
					$this->estSigla = $row["Sigla"];
				}
				return true;
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao carregar os dados do estado.\n".$ex->getMessage());
			}
		}
	}
?>