<?php
    include_once 'responsavel.php';
    include_once 'aluno.php';

    class AlunoHasResponsavel{
        public $ahrResponsavel;
        public $ahrAluno;

        public function __construct(){
            $this->ahrResponsavel = new Responsavel();
            $this->ahrAluno = new Aluno();
        }

        public function listar(){

        }

        public function listarPorAluno($idAluno){

        }

        public function listarPorResponsavel($idResposavel){
            
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