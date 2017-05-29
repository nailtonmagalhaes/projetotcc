<?php
    include_once 'tipo-professor.php';
    include_once 'professor.php';
    include_once 'turma.php';
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
            
//            $professorcommesmaturma = AcessoDados::listar("SELECT * FROM tbProfessor_has_Turma WHERE IdTurma = ".$this->phtTurma->turId);

//            if($professorcommesmaturma != null && $professorcommesmaturma->num_rows > 0){
//                echo "entrou no update";
//                $sql = "UPDATE tbProfessor_has_Turma SET IdProfessor = ".$this->phtProfessor->pesId.", Tipo = ".$this->phtTipo." WHERE IdTurma = ".$this->phtTurma->turId.";";
//                return AcessoDados::alterar($sql);
//            }else{
//                echo "entrou no insert";
                $sql = "INSERT INTO tbProfessor_has_Turma(IdProfessor, IdTurma, Tipo) VALUES (".$this->phtProfessor->pesId.", ".$this->phtTurma->turId.", ".$this->phtTipo.");";
                return AcessoDados::inserir($sql);
//            }
        }
        
        public function removeDados($IdTurma){
                    $alterar = AcessoDados::alterar("DELETE FROM tbProfessor_has_turma WHERE IdTurma = ".$IdTurma.";");
//                    var_dump($alterar);die;
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