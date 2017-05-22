<?php
	include_once 'valida-sessao.php';
	class Responsavel{

		public $respId;
		public $respNome;
		public $respCpf;
		public $respParentesco;
		public $respAtivo;
		public $respAlunos; /*AlunoHasResposavel*/

		public function __construct(){
			$this->respId = 0;
			$this->respNome = "";
			$this->respCpf = "";
			$this->respParentesco = "";
			$this->respAtivo = 1;
			$this->respAlunos = array();
		}

		public function listar(){

        }

        public function listarPorAluno($idAluno){

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