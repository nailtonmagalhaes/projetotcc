<?php

    include_once 'includes.php';

    class ProfessorHasTurma{
        public $phtTipo;
        public $phtTurma;
        public $phtProfessor;
        
        public function __construct(){
            $this->phtTipo = ETipoProfessor::None;
            $this->phtTurma =  new Turma();
            $this->phtProfessor = new Professor();
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

        public function phtTipoDescricao(){
            switch ($this->phtTipo) {
                case ETipoProfessor::Principal:
                    return "Principal";
                    break;
                case ETipoProfessor::Apoio:
                    return "Apoio";
                    break;                
                default:
                    "Nenhum";
                    break;
            }
        }
    }
?>