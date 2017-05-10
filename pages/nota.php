<?php
    include_once 'includes.php';


    class Nota{
        public $notId;
        public $notProfessor;
        public $notAvaliacao;
        public $notNota;
        public $notAtivo;

        public function __construct(){
            $this->notId = 0;
            $this->notProfessor = null;
            $this->notAvaliacao = null;
            $this->notNota = 0;
            $this->notAtivo = 1;
        }

        public function listar(){

        }

        public function listarPorAvaliacao($idAvaliacao){

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