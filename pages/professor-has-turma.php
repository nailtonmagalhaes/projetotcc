<?php
    include_once 'turma.php';
    include_once 'professor.php';

    class ProfessorHasTurma{
        public $phtTipo;
        public $phtTurma;
        public $phtProfessor;
        
        public function __construct(){
            $this->phtTipo = ETipoProfessor::None;
            $this->phtTurma =  null;
            $this->phtProfessor = null;
        }

        public function listar(){

        }

        public function listarPorTurma($idTurma){

        }

        public function carregarDados(){

        }

        public function salvarDados(){
            $professorcommesmaturma = listar("SELECT * FROM tbProfessor_has_Turma WHERE IdTurma = ".$this->phtTurma->turId);
            if($professorcommesmaturma->num_rows > 0){
                return alterar("UPDATE tbProfessor_has_Turma SET IdProfessor = ".$this->phtProfessor->pesId.", Tipo = ".$this->phtTipo." WHERE IdTurma = ".$this->phtTurma->turId);
            }else{
                return insere("INSERT INTO tbProfessor_has_Turma(IdProfessor, IdTurma, Tipo) VALUES (".$this->phtProfessor->pesId.", ".$this->phtTurma->turId.", ".$this->phtTipo.")");
            }
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