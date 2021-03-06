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
			try {
				$resultado = AcessoDados::listar("SELECT Id, IdPessoa, IdCidade, Logradouro, Bairro, Numero, Complemento, Cep, Ativo FROM tbEndereco WHERE Id =".$this->endId);
			 	if($resultado && $resultado->num_rows > 0){
					$row = $resultado->fetch_assoc();
					$this->endLogradouro = $row["Logradouro"];
					$this->endBairro = $row["Bairro"];
					$this->endNumero = $row["Numero"];
					$this->endComplemento = $row["Complemento"];
					$this->endCep = $row["Cep"];
					$this->endAtivo = $row["Ativo"];
					$this->endCidade = new Cidade();
					$this->endCidade->cidId = $row["IdCidade"];
					$this->endCidade->carregarDados();
			 	}
			} catch (Exception $e) {
				throw new Exception("Ocorreu um erro ao carregar os dados do endereco.\n".$e->getMessage());				
			}		 	
		}

		public function salvarDados(){
            try
            {
            	$sql = "";
			     if($this->endId > 0){
				    $sql = "UPDATE tbEndereco SET IdPessoa = ".$this->endPessoa->pesId.", IdCidade = ".$this->endCidade->cidId.", Logradouro = '".$this->endLogradouro."', Bairro = '".$this->endBairro."', Numero = '".$this->endNumero."', Complemento = '".$this->endComplemento."', Cep = '".$this->endCep."', Ativo = ".$this->endAtivo." WHERE Id = ".$this->endId;
				    return AcessoDados::alterar($sql);
			     }else{
				    $sql = "INSERT INTO tbEndereco (IdPessoa, IdCidade, Logradouro, Bairro, Numero, Complemento, Cep, Ativo) 
										    VALUES (".$this->endPessoa->pesId.", ".$this->endCidade->cidId.", '".$this->endLogradouro."', '".$this->endBairro."', '".$this->endNumero."', '".$this->endComplemento."', '".$this->endCep."', 1);";
				    $this->endId = AcessoDados::inserir($sql);
				    return $this->endId > 0;
			     }
            }
            catch (Exception $e)
            {
                throw new Exception("Erro ao salvar os dados.\n".$e->getMessage());
            }			 
		}
	}
?>