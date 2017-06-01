<?php
	include_once 'valida-sessao.php';
	class Responsavel{

		public $respId;
		public $respNome;
		public $respCpf;
		public $respParentesco;
		public $respAtivo;
		public $respAlunos; /*AlunoHasResposavel*/

		public function __construct(){
			$this->respId = 0;
			$this->respNome = "";
			$this->respCpf = "";
			$this->respParentesco = "";
			$this->respAtivo = 1;
			$this->respAlunos = array();
		}

		public function listar(){

        }

        public function listarPorAluno($idAluno){

        }

        public function carregarDados(){
			try {
				$resultado = AcessoDados::listar("SELECT Id, Nome, Parentesco, Cpf, COALESCE(Ativo, 1) Ativo FROM tbResponsavel WHERE Id = ".$this->respId);
				if($resultado && $resultado->num_rows > 0){
					$row = $resultado->fetch_assoc();
					$this->respNome = $row['Nome'];
					$this->respCpf = $row['Cpf'];
					$this->respParentesco = $row['Parentesco'];
					$this->respAtivo = $row['Ativo'];
				}
			} catch (Exception $e) {
				throw new Exception("Erro ao carregar os dados do responsável.\n".$e->getMessage());				
			}
        }

        public function salvarDados(){
        	try {
        		if($this->respId>0){
        			AcessoDados::alterar("UPDATE tbResponsavel SET Nome = '".$this->respNome."', Parentesco = '".$this->respParentesco."', Cpf = '".$this->respCpf."', Ativo = '".$this->respAtivo."' WHERE Id = ".$this->respId);
        		}else{
        			$this->respId = AcessoDados::inserir("INSERT INTO tbResponsavel(Nome, Parentesco, Cpf, Ativo) VALUES ('".$this->respNome."', '".$this->respParentesco."', '".$this->respCpf."', 1)");
        		}
				return true;
        	} catch (Exception $e) {
        		throw new Exception("Ocorreu um erro ao salvar os dados do responsável.\n".$e->getMessage());        		
        	}
        }
    
        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
	}
?>