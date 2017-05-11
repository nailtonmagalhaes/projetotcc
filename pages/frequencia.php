<?php

//    include_once 'includes.php';
    include_once '../conf/database.php';
    
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
               if($this->frqId > 0){
                        return altera("UPDATE tbFrequencia SET DataFrequencia = '".$this->frqData."', IdDiaSemana = ".$this->frqHasDiaSemana.", IdMatricula = ".$this->frqMatricula.", IdMatricula = ".$this->frqMatricula." WHERE Id = ".addslashes($this->crsId));
                }else{
                        return insere("INSERT INTO tbFrequencia (DataFrequencia, IdDiaSemana, IdMatricula, Presente) VALUES ('".$this->frqData."', ".$this->frqHasDiaSemana.",".$this->frqMatricula.",1)");
                }
        }

        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
    }
?>