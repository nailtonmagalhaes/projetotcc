<?php
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
            $dados = self::listar();
            if($dados && $dados->num_rows > 0){
                $row = $dados->fetch_assoc();
                $this->disDia = $row["Dia"];
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