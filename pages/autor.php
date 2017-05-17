<?php

	class Autor{

		public $autId;
		public $autNome;
		public $autDescricao;
		public $autAtivo;
		public $autMateriais;	/*CursoHasMaterial*/

		public function __construct(){
			$this->autId = 0;
			$this->autNome = "";
			$this->autDescricao = "";
			$this->autAtivo = 1;
			$this->autMateriais = array();
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