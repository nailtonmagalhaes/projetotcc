<?php

    include_once 'tipo-telefone.php';

	class Telefone{
		public $telId;		
		public $telPessoa;	/*Pessoa*/
		public $telNumero;
		public $telTipo;	/*ETipoTelefone*/
		public $telAtivo;
		

		public function __construct(){
			$this->telId = 0;
			$this->telPessoa = null;
			$this->telNumero = "";			
			$this->telTipo = ETipoTelefone::none;
			$this->telAtivo = 1;			
			}

		function carregarDados(){
			$resultado = AcessoDados::listar("SELECT Id, IdPessoa, Tipo, Numero, Ativo FROM tbTelefone WHERE Id = ".$this->telId);
            if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();                                                                                                                   
                $this->telId = $row["Id"];
                $this->telTipo = $row["Tipo"];
                $this->telNumero = $row["Numero"];
                $this->telAtivo = $row["Ativo"];
                return true;
            }else{
                return false;
            }
		}

		function excluirLogicamente(){
			return AcessoDados::alterar("UPDATE tbTelefone SET Ativo = 0 WHERE Id = ".$this->telId);
		}

		function excluirFisicamente(){
			return AcessoDados::inserir("DELETE FROM tbTelefone WHERE Id = ".$this->telId);
		}

		function salvarDados(){
			try{
				if($this->telId > 0){
					$sqlUpdate = "UPDATE tbTelefone SET Numero = '".$this->telNumero."', Tipo = ".$this->telTipo.", Ativo = ".$this->telAtivo.", IdPessoa = ".$this->telPessoa->pesId." WHERE Id = ".$this->telId;
					$sucessoupdate = AcessoDados::alterar($sqlUpdate);
					return $sucessoupdate;
				}else{
					$sqlInsert = "INSERT INTO tbTelefone (IdPessoa, Tipo, Numero, Ativo) VALUES (".$this->telPessoa->pesId.", ".$this->telTipo.", '".$this->telNumero."', 1);";
					$sucessoinsert = AcessoDados::inserir($sqlInsert);
					$this->telId = $sucessoinsert;
					return $sucessoinsert;
				}
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao salvar os dados do Telefone.<br>".$ex->getMessage());				
			}
		}

		function listar(){
			return AcessoDados::listar("SELECT Id, IdPessoa, Numero, Tipo, Ativo, CASE WHEN Ativo = 0 THEN 'Inativo' ELSE 'Ativo' FROM tbTelefone ORDER BY Tipo");
		}

		public function tipoDescricao(){
			switch ($this->telTipo) {
				case ETipoTelefone::residencial:
					return "Residencial";

				case ETipoTelefone::celular:
					return "Celular";

				case ETipoTelefone::comercial:
					return "Comercial";
				
				default:
					return "Não informado";
			}
		}
	}
?>