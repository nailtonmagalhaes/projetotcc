<?php

    include_once 'includes.php';
    class Frequencia{
        public $frqId;
        public $frqHasDiaSemana;    /*TurmaHasDiaSemana*/
        public $frqMatricula;       /*Matricula*/
        public $frqData;
        public $frqPresente;
        public $frqAtivo;

        public function __construct(){
            $this->frqId = 0;
            $this->frqHasDiaSemana = null;
            $this->frqMatricula = null;
            $this->frqData = null;
            $this->frqPresente = true;
            $this->frqAtivo = 1;
        }

        public function listar(){

        }

        public function listarPorMatricula($idMatricula){

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