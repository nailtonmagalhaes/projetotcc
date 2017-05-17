<?php
	class Estado{

		public $estId;
		public $estNome;
		public $estSigla;
		public $estCidades;	/*array Cidade*/

		public function __construct(){
			$this->estId = 0;
			$this->estNome = "";
			$this->estSigla = "";
			$this->estCidades = array();
		}

		public function listar(){
			return AcessoDados::listar("SELECT Id, Sigla, Nome FROM tbEstado ORDER BY Nome");
		}

		public function listarCidades(){
			return AcessoDados::listar("SELECT Id, IdEstado, Nome FROM tbCidade WHERE IdEstado = ".$this->estId." ORDER BY Nome");
		}
	}
?>