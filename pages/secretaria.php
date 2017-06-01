<?php

	class Secretaria extends Pessoa{
		
		//Construtor
		public function __construct(){
			parent::__constuct;//Chamando o construtor da classe pai
			$this->pesPerfil = EPerfil::Secretaria;
		}

		public function listar(){
			$this->pesPerfil = EPerfil::Secretaria;
			return parent::listar();
		}

		public function salvarDados(){
			try{
				AcessoDados::abreTransacao();
				$salvou = parent::salvarDados();
				AcessoDados::confirmaTransacao();
				return $salvou;
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao salvar a secretaria.\n".$ex->getMessage());
			}
		}
	}
?>