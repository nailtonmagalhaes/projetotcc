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
            try {
                return AcessoDados::listar("SELECT Id, Dia FROM tbDiaSemana ORDER BY Id");
            } catch (Exception $e) {
                throw new Exception("Erro ao listar os dias da semana".$e->getMessage());                
            }            
        }        

        public function carregarDados(){
            try {
                $resultado = AcessoDados::listar("SELECT Id, Dia FROM tbDiaSemana WHERE Id = ".$this->disId);
                if ($resultado && $resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc();                                                                                                                   
                    $this->disDia = $row["Dia"];
                    return true;
                }else{
                    return false;
                }                
            } catch (Exception $e) {
                throw new Exception("Erro ao carregar os dados do dia.\n".$e->getMessage());                
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