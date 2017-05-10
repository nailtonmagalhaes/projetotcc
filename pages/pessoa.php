<?php
    include_once 'perfil.php';
    include_once 'endereco.php';
    include_once 'telefone.php';
	
	class Pessoa{
		public $pesId;
		public $pesNome;
		public $pesCpf;
		public $pesRg;
		public $pesSexo;
		public $pesDataNascimento;
		public $pesPerfil;
		public $pesSenha;
		public $pesAtivo;

		public $pesEnderecos;		/*Endereco*/
		public $pesTelefone;		/*Telefone*/
		
		//construtor da classe
		public function __construct(){
			//echo "Classe Pessoa foi construída";
			$this->preparaPessoa();			
		}

		public function __destruct(){
			//echo "Classe Pessoa foi destruída";
		}

		private function preparaPessoa(){
			$this->pesId = 0;
			$this->pesNome = "";
			$this->pesCpf = "";
			$this->pesRg = "";
			$this->pesSexo = "";
			$this->pesSenha = "";
			$this->pesDataNascimento = "";
			$this->pesPerfil = EPerfil::None;
			$this->pesAtivo = 1;

			$this->pesEnderecos = array();
			$this->pesTelefone = array();
		}

		public function addEndereco(Endereco $ed){
			$this->pesEnderecos[] = $ed;
		}

		public function getEnderecos() {
			return $this->pesEnderecos;
		}
                
		public function limparCaracteres($str){			
			$str = str_replace(".", "", $str);
			$str = str_replace("-", "", $str);			
			return $str;
		}
		
		public function verificarCampos(){
			
		}

		public function listar(){
			$sql = "SELECT * FROM tbPessoa WHERE Perfil = ".$this->pesPerfil;
			//echo "----------------------------------------- SQL: ".$sql;
			return listar($sql);
		}
		
		public function carregarDados(){
			$resultado = listar("SELECT Id, Nome, Cpf, Rg, Sexo, DataNascimento, Perfil, Senha, COALESCE(Situacao, 1) AS Situacao FROM tbPessoa WHERE Id = ".$this->pesId);
            if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();                                                                                                                   
                $this->pesNome = $row["Nome"];
                $this->pesCpf = $row["Cpf"];
				$this->pesRg = $row["Rg"];
				$this->pesSenha = $row["Senha"];
                $this->pesAtivo = $row["Situacao"];
				$this->pesPerfil = $row["Perfil"];
				$this->pesSexo = $row["Sexo"];
				$this->pesDataNascimento = $row["DataNascimento"];

				$listaEnderecos = listar("SELECT e.Id, e.Logradouro, e.Bairro, e.Numero, e.Complemento, e.Cep,
											c.Id AS IdCidade, c.Nome, 
											est.Id as IdEstado, est.Nome as NomeEstado, est.Sigla
											FROM tbEndereco e
											INNER JOIN tbCidade c ON c.Id = e.IdCidade
											INNER JOIN tbEstado est ON est.Id = c.IdEstado
											WHERE e.IdPessoa = ".$this->pesId);

				if($listaEnderecos && $listaEnderecos->num_rows > 0){
					while($rowe = $listaEnderecos->fetch_assoc()){  
						$endb = new Endereco();                                                                                                                    
						$endb->endId = $rowe["Id"];
						$endb->endLogradouro = $rowe["Logradouro"];
						$endb->endBairro = $rowe["Bairro"];
						$endb->endNumero = $rowe["Numero"];
						$endb->endComplemento = $rowe["Complemento"];
						$endb->endCep = $rowe["Cep"];

						$cid = new Cidade();
						$cid->cidId = $rowe["IdCidade"];
						$cid->cidNome = $rowe["Nome"];
						
						$est = new Estado();
						$est->estId = $rowe["IdEstado"];
						$est->estNome = $rowe["Nome"];
						$est->estSigla = $rowe["Sigla"];

						$cid->setEstado($est);
						$endb->setCidade($cid);
						$this->addEndereco($endb);
					}
				}
                return true;
            }else{
                return false;
            }
		}

		public function salvarDados(){
			$sql = "";
			$sucesso = false;
			if($this->pesId > 0){
				$sql = "UPDATE tbPessoa SET Nome = '".$this->pesNome."', Cpf = '".$this->pesCpf."', Rg = '".$this->pesRg."', Sexo = ".$this->pesSexo.", DataNascimento = '".$this->pesDataNascimento."', Perfil = ".$this->pesPerfil.", Senha = '".$this->pesSenha."', Situacao = ".$this->pesAtivo." WHERE Id = ".$this->pesId;
				$sucesso = alterar($sql);
			}else{
				$sql = "INSERT INTO tbPessoa (Id, Nome, Cpf, Rg, Sexo, DataNascimento, Perfil, Senha, Situacao) VALUES ('".$this->pesNome."', ".$this->pesCpf.", ".$this->pesRg.", ".$this->pesSexo.", ".$this->pesDataNascimento.", ".$this->pesPerfil.", ".$this->pesSenha.", ".$this->pesAtivo.");";
				$this->pesId = insere($sql);
							}


		}
	}
?>