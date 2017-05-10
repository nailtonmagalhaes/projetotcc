<?php
	include_once 'cidade.php';
	class Endereco{

		public $endId;
		public $endPessoa;
		public $endCidade;
		public $endLogradouro;
		public $endBairro;
		public $endNumero;
		public $endComplemento;
		public $endCep;
		public $endAtivo;

		public function __construct(){
			$this->endId = 0;
			$this->endPessoa = null;
			$this->endCidade = null;
			$this->endLogradouro = "";
			$this->endBairro = "";
			$this->endNumero = "";
			$this->endComplemento = "";
			$this->endCep = "";
			$this->endAtivo = 1;
		}

		public function setPessoa(Pessoa $pes){
			$this->endPessoa = $pes;
		}

		public function getPessoa(){
			return $this->endPessoa;
		}

		public function setCidade(Cidade $cid){
			$this->endCidade = $cid;
		}

		public function getCidade(){
			return $this->endCidade;
		}
		//Método genérico que atribuir um valor a qualquer propriedade privada ou publica
		public function __set($campo,$valor){
        	$this->$campo = $valor;
 		}
		//Método genérico que retorna qualquer propriedade privada ou publica
 		public function get($campo){
			return $this->$campo;
		}

		public function carregarDados(){
			 
		}

		public function salvarDados(){
			 
		}
	}
?>