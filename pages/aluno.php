<?php
	include_once 'valida-sessao.php';
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

		public function addResponsavel(Responsavel $resp) {
			$this->alnResponsaveis[] = $resp;
		}
		
		public function getResponsaveis() {
			return $this->alnResponsaveis;
		}

		public function salvarDados(){
			try{
				AcessoDados::abreTransacao();
				$salvou = parent::salvarDados();
				//foreach($this->alnResponsaveis as $responsavel){

				//}
				AcessoDados::confirmaTransacao();
				return $salvou;
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao salvar o aluno.<br>".$ex->getMessage());
			}
		}
	}
?>