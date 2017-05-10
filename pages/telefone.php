<?php

    include_once 'includes.php';

	class telefone{
		public $telId;		
		public $telPessoa;	/*Pessoa*/
		public $telNumero;
		public $telTipo;	/*ETipoTelefone*/
		public $telAtivo;
		

		public function __construct(){
			$this->telId = 0;
			$this->telPessoa = new Pessoa();
			$this->telNumero = "";			
			$this->telTipo = ETipoTelefone::none;
			$this->telAtivo = 1;			
			}

		function carregarDados(){
			$resultado = listar("SELECT Id,IdPessoa,Tipo,Numero,Ativo FROM tbTelefone WHERE Id = ".$this->telId);
            if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();                                                                                                                   
                $this->telId = $row["Id"];
                $this->telIdPessoa = $row["IdPessoa"];
                $this->telTipo = $row["Tipo"];
                $this->telNumero = $row["Numero"];
                $this->telAtivo = $row["Ativo"];
                return true;
            }else{
                return false;
            }
		}

		function excluirLogicamente(){
			return insere("UPDATE tbTelefone SET Ativo = 0 WHERE Id = ".$this->telId);
		}

		function excluirFisicamente(){
			return insere("DELETE FROM tbTelefone WHERE Id = ".$this->telId);
		}

		function salvar(){
			if($this->crsId > 0){
				return insere("UPDATE tbTelefone SET Numero = '".$this->telNumero."', Tipo = ".$this->telTipo.", Ativo = ".$this->telAtivo." WHERE Id = ".addslashes($this->telId));
			}else{
				//Ver como pega o Id da pessoa
				return insere("INSERT INTO tbTelefone (Numero, Tipo, Ativo) VALUES ('".$this->alnNumero."', ".$this->alnTipo.", 1)");
			}
		}

		function listar(){
			return listar("SELECT Id, IdPessoa, Numero, Tipo, Ativo, CASE WHEN Ativo = 0 THEN 'Inativo' ELSE 'Ativo' FROM tbTelefone ORDER BY Tipo");
		}
	}
?>