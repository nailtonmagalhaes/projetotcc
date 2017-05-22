<?php

	class Secretaria extends Pessoa{
		public $propriedade;
		
		//Construtor
		public function __construct(){
			parent::__constuct;//Chamando o construtor da classe pai
			$this->pesPerfil = EPerfil::Secretaria;
			$this->propriedade = '';
		}

		public function getPropriedade(){
			return $this->propriedade;
		}

		public function listar(){
			$this->pesPerfil = EPerfil::Secretaria;
			return parent::listar();
		}

	}
?>