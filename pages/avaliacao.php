<?php

    include_once 'includes.php';

    class Avaliacao{
        public $avaId;
        public $avaMatricula;       /*Matricula*/
        public $avaData;
        public $avaTipo;            /*ETipoAvaliacao*/
        public $avaAtivo;

        public function __construct(){
            $this->avaId = 0;
            $this->avaMatricula = new Matricula();
            $this->avaData = null;
            $this->avaTipo = ETipoAvaliacao::normal;
            $this->avaAtivo = 1;
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