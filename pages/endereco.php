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
			 $sql = "";
			 if($this->endId > 0){
				$sql = "UPDATE tbendereco SET IdPessoa = ".$this->endPessoa->pesId.", IdCidade = ".$this->endCidade->cidId.", Logradouro = '".$this->endLogradouro."', Bairro = '".$this->endBairro."', Numero = '".$this->endNumero."', Complemento = '".$this->endComplemento."', Cep = '".$this->endCep."', Ativo = ".$this->endAtivo." WHERE Id = ".$this->endId;
				return alterar($sql);
			 }else{
				$sql = "INSERT INTO tbendereco (IdPessoa, IdCidade, Logradouro, Bairro, Numero, Complemento, Cep, Ativo) 
										VALUES (".$this->endPessoa->pesId.", ".$this->endCidade->cidId.", '".$this->endLogradouro."', '".$this->endBairro."', '".$this->endNumero."', '".$this->endComplemento."', '".$this->endCep."', 1);";
				$this->endId = insere($sql);
				return $this->endId > 0;
			 }
		}
	}
?>