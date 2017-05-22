<?php
    include_once 'turma.php';
    include_once 'aluno.php';
    
    class Matricula{
        public $matId;
        public $matAluno;
        public $matTurma;
        public $matNumero;
        public $matAtivo;
        public $matAvaliacoes; /*Avaliacao*/

        public function __construct(){
            $this->matId = 0;
            $this->matAluno = null;
            $this->matTurma = null;
            $this->matNumero = 0;
            $this->matAtivo = 1;
            $this->matAvaliacoes = array();
        }

        public function listar(){

        }

        public function listarPorTurma($idTurma){

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