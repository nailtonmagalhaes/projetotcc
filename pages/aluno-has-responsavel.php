<?php
    include_once 'responsavel.php';
    include_once 'aluno.php';

    class AlunoHasResponsavel{
        public $ahrResponsavel;
        public $ahrAluno;

        public function __construct(){
            $this->ahrResponsavel = new Responsavel();
            $this->ahrAluno = new Aluno();
        }

        public function listar(){

        }

        public function listarPorAluno($idAluno){

        }

        public function listarPorResponsavel($idResposavel){
            
        }

        public function carregarDados(){

        }

        public function salvarDados(){
            try {
                $resultado = AcessoDados::listar("SELECT * FROM tbAluno_has_Responsavel WHERE IdResponsavel = ".$this->ahrResponsavel->respId." AND IdAluno = ".$this->ahrAluno->pesId);
                if($resultado == null || $resultado->num_rows <= 0)
                    AcessoDados::inserir("INSERT INTO tbAluno_has_Responsavel(IdResponsavel, IdAluno) VALUES (".$this->ahrResponsavel->respId.", ".$this->ahrAluno->pesId.")");
            } catch (Exception $e) {
                throw new Exception("Erro ao salvar os dados do aluno e responsavel.<br>".$e->getMessage());                
            }
        }
    
        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
    }
?>