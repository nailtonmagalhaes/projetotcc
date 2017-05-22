<?php
    include_once 'valida-sessao.php';
    class DiaSemana{
        public $disId;
        public $disDia;
        public $disHasTurmas;   /*TurmaHasDiaSemana*/

        public function __construct(){
            $this->disId = 0;
            $this->disDia = "";
            $this->disHasTurmas = array();
        }

        public function listar(){
            return AcessoDados::listar("SELECT Id, Dia FROM tbDiaSemana ORDER BY Id");
        }

        public function carregarDados(){
            $resultado = AcessoDados::listar("SELECT Id, Dia FROM tbDiaSemana WHERE Id = ".$this->disId);
            if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();                                                                                                                   
                $this->disDia = $row["Dia"];
                return true;
            }else{
                return false;
            }
        }

        public function salvarDados(){

        }

        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
    }
?>