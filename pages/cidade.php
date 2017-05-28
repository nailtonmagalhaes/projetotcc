<?php

	include_once 'estado.php';
	class Cidade{
		
		public $cidId;
		public $cidEstado;	/*Estado*/
		public $cidNome;

		public function __construct(){
			$this->cidId = 0;
			$this->cidEstado = null;
			$this->cidNome = "";
		}

		public function setEstado(Estado $est){
			$this->cidEstado = $est;
		}

		public function getEstado(){
			return $this->cidEstado;
		}

		public function listarPorEstado($idEstado){
			try {
				return AcessoDados::listar("SELECT Id, IdEstado, Nome FROM tbCidade WHERE IdEstado = ".$idEstado." ORDER BY Nome");
			} catch (Exception $e) {
				throw new Exception("Erro ao listar as cidades por estado.<br>".$e->getMessage());				
			}			
		}

		public function listar(){

        }

        public function carregarDados(){
 			try {
 				$resultado = AcessoDados::listar("SELECT Id, IdEstado, Nome FROM tbCidade WHERE Id =".$this->cidId);
			 	if($resultado && $resultado->num_rows > 0){
					$row = $resultado->fetch_assoc();
					$this->cidNome = $row["Nome"];
					$this->cidEstado = new Estado();
					$this->cidEstado->estId = $row["IdEstado"];
					$this->cidEstado->carregarDados();
					return true;
			 	}
 			} catch (Exception $e) {
 				throw new Exception("Erro ao carregar os dados da cidade.<br>".$e->getMessage()); 				
 			}
        }

        public function salvarDados(){

        }
    
        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
	}
?>