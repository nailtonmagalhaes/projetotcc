<?php
    include_once 'valida-sessao.php';
    class Nota{
        public $notId;
        public $notProfessor;
        public $notAvaliacao;
        public $notNota;
        public $notAtivo;

        public function __construct(){
            $this->notId = 0;
            $this->notProfessor = null;
            $this->notAvaliacao = null;
            $this->notNota = 0;
            $this->notAtivo = 1;
        }

        public function listar(){

        }

        public function listarPorAvaliacao($idAvaliacao){

        }

        public function carregarDados(){
            try{
                $resultado = AcessoDados::listar("SELECT Id, IdProfessor, IdAvaliacao, Nota, Ativo FROM tbNota WHERE Id = {$this->notId}");
                if($resultado && $resultado->num_rows > 0){
                    $row = $resultado->fetch_assoc();
                    $this->notNota = $row['Nota'];
                    $this->notAtivo = $row['Ativo'];
                    $this->notProfessor = new Professor();
                    $this->notProfessor->pesId = $row['IdProfessor'];
                    $this->notProfessor->carregarDados();
                    $this->notAvaliacao = new Avaliacao();
                    $this->notAvaliacao = $row['IdAvaliacao'];
                    $this->notAvaliacao->carregarDados();
                    return true;
                }
                return false;
            }catch(Exception $ex){
                throw new Exception("Ocorreu um erro ao carregar os dados da nota.\n{$ex->getMessage()}");
            }
        }

        public function salvarDados(){
             try{
                AcessoDados::abreTransacao();
                if($this->notId > 0){
                    AcessoDados::alterar("");
                }else{
                    AcessoDados::inserir("");
                }
                AcessoDados::confirmaTransacao();
                return true;
            }catch(Exception $ex){
                throw new Exception("Ocorreu um erro ao carregar os dados da nota.\n{$ex->getMessage()}");
            }
        }
    
        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
    }
?>