<?php

//    include_once 'includes.php';
//    include_once '../conf/database.php';
    include_once '../conf/acesso-dados.php';
    
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
            
            try {
                
                AcessoDados::abreTransacao();
                
                $sucesso = false;
                
               if($this->frqId > 0){
                        $sucesso = AcessoDados::alterar("UPDATE tbFrequencia SET DataFrequencia = '".$this->frqData."', IdDiaSemana = ".$this->frqHasDiaSemana.", IdMatricula = ".$this->frqMatricula.", Presente = ".$this->frqPresente." WHERE Id = ".addslashes($this->frqId));
                }else{
                        $sucesso = AcessoDados::inserir("INSERT INTO tbFrequencia (DataFrequencia, IdDiaSemana, IdMatricula, Presente) VALUES ('".$this->frqData."', ".$this->frqHasDiaSemana.",".$this->frqMatricula.",".$this->frqPresente.")");
                
                        $sucesso = $this->frqId > 0;
                }
                
                AcessoDados::confirmaTransacao();
                
                return $sucesso;
                
            } catch (Exception $exc) {
//                echo $exc->getTraceAsString();
                throw new Exception("Ocorreu um erro ao salvar os dados.<br>".$ex->getMessage());
            }
        }

        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
    }
?>