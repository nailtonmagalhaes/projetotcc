<?php
	include_once 'estado.php';
	class Cidade{
		
		public $cidId;
		public $cidEstado;	/*Estado*/
		public $cidNome;

		public function __construct(){
			$this->cidId = 0;
			$this->cidEstado = new Estado();
			$this->cidNome = "";
		}

		public function setEstado(Estado $est){
			$this->cidEstado = $est;
		}

		public function getEstado(){
			return $this->cidEstado;
		}

		public function listarPorEstado($idEstado){
			return listar("SELECT Id, IdEstado, Nome FROM tbCidade WHERE IdEstado = ".$idEstado." ORDER BY Nome");
		}

		public function listar(){

        }

        public function carregarDados(){

        }

        public function salvarDados(){

        }
    
        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
	}
?>