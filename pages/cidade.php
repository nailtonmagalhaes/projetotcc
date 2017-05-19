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
			return AcessoDados::listar("SELECT Id, IdEstado, Nome FROM tbCidade WHERE IdEstado = ".$idEstado." ORDER BY Nome");
		}

		public function listar(){

        }

        public function carregarDados(){
 			$resultado = AcessoDados::listar("SELECT Id, IdEstado, Nome FROM tbCidade WHERE Id =".$this->cidId);
			 if($resultado && $resultado->num_rows > 0){
					$row = $resultado->fetch_assoc();
					$this->cidNome = $row["Nome"];
					$this->cidEstado = new Estado();
					$this->cidEstado->estId = $row["IdEstado"];
					$this->cidEstado->carregarDados();
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