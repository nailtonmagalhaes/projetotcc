<?php

    include_once 'pessoa.php';
    include_once 'aluno-has-responsavel.php';
    
	class Aluno extends Pessoa{

		public $alnMatricula;			/*Matricula,5,*/
		public $alnResponsaveis;		/*AlunoHasResponsavel*/

		public function __construct(){
			parent::__construct();		/*Chamando o construtor da classe pai*/
			$this->alnMatricula = null;
			$this->pesPerfil = EPerfil::Aluno;
			$this->alnResponsaveis = array();
		}

		public function getMatricula(){
			return $this->alnMatricula;
		}

		public function listar(){
			$this->pesPerfil = EPerfil::Aluno;
			return parent::listar();
		}

		public function addResponsavel(AlunoHasResponsavel $resp) {
			$this->alnResponsaveis[] = $resp;
		}
		
		public function getResponsaveis() {
			return $this->alnResponsaveis;
		}

		public function salvarDados(){
			try{
				AcessoDados::abreTransacao();
				$salvou = parent::salvarDados();
				foreach($this->alnResponsaveis as $res){
					$res->ahrAluno = $this;
					$res->ahrResponsavel->salvarDados();
					$res->salvarDados();
				}
				AcessoDados::confirmaTransacao();
				return $salvou;
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao salvar o aluno.<br>".$ex->getMessage());
			}
		}

		public function carregarDados(){
			try {
				parent::carregarDados();
				$resultado = AcessoDados::listar("SELECT IdResponsavel FROM tbAluno_has_Responsavel WHERE IdAluno = ".$this->pesId);
				if($resultado && $resultado->num_rows > 0){
					while($row = $resultado->fetch_assoc()){
						$resp = new AlunoHasResponsavel();
						$resp->ahrAluno = $this;
						$resp->ahrResponsavel = new Responsavel();
						$resp->ahrResponsavel->respId =  $row['IdResponsavel'];
						$resp->ahrResponsavel->carregarDados();
						$this->addResponsavel($resp);
					}
				}
			} catch (Exception $e) {
				throw new Exception("Error Processing Request", 1);				
			}

		}
	}
?>