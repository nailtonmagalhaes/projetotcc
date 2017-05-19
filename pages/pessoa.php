<?php
    include_once 'perfil.php';
    include_once 'endereco.php';
    include_once 'telefone.php';
    include_once 'sexo.php';
	
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
		public $pesTelefones;		/*Telefone*/
		
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
			$this->pesSexo = ESexo::Masculino;
			$this->pesSenha = "";
			$this->pesDataNascimento = "";
			$this->pesPerfil = EPerfil::None;
			$this->pesAtivo = 1;

			$this->pesEnderecos = array();
			$this->pesTelefones = array();
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
			$sql = "SELECT * FROM tbPessoa WHERE Situacao = 1 AND Perfil = ".$this->pesPerfil;
			//echo "----------------------------------------- SQL: ".$sql;
			return AcessoDados::listar($sql);
		}
		
		public function carregarDados(){
			$resultado = AcessoDados::listar("SELECT Id, Nome, Cpf, Rg, Sexo, DataNascimento, Perfil, Senha, COALESCE(Situacao, 1) AS Situacao FROM tbPessoa WHERE Id = ".$this->pesId);
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

				$listaEnderecos = AcessoDados::listar("SELECT Id FROM tbEndereco WHERE IdPessoa = ".$this->pesId);

				if($listaEnderecos && $listaEnderecos->num_rows > 0){
					while($rowe = $listaEnderecos->fetch_assoc()){  
						$endb = new Endereco();                                                                                                                    
						$endb->endId = $rowe["Id"];
						$endb->carregarDados();
						$this->addEndereco($endb);
					}
				}
                return true;
            }else{
                return false;
            }
		}

		public function salvarDados(){
			try{
				$sql = "";
				$sucesso = (bool)false;
				if($this->pesId > 0){
					$sql = "UPDATE tbPessoa SET Nome = '".$this->pesNome."', Cpf = '".$this->pesCpf."', Rg = '".$this->pesRg."', Sexo = ".$this->pesSexo.", DataNascimento = '".$this->pesDataNascimento."', Perfil = ".$this->pesPerfil.", Senha = '".$this->pesSenha."', Situacao = ".$this->pesAtivo." WHERE Id = ".$this->pesId.";";
					$sucesso = AcessoDados::alterar($sql);					
				}else{
		$sql = "INSERT INTO tbPessoa (Nome, Cpf, Rg, Sexo, DataNascimento, Perfil, Senha, Situacao) VALUES ('$this->pesNome', '$this->pesCpf', '$this->pesRg', $this->pesSexo, '$this->pesDataNascimento', $this->pesPerfil, '$this->pesSenha', 1)";

					$this->pesId = AcessoDados::inserir($sql);

					if($this->pesId > 0){
						$sucesso = true;
					}
				}
		
				if($sucesso)
				{
					foreach($this->pesEnderecos as $e){
						$e->endPessoa = $this;
						$e->salvarDados();
					}

					foreach($this->pesTelefones as $t){
						$t->telPessoa = $this;
						$t->salvarDados();
					}
					
				}
				return $sucesso;
			}catch(Exception $ex){
				throw new Exception("Erro ao salvar os dados da pessoa.<br>".$ex->getMessage());
			}
		}

		public function dataNascimentoFormatada(){
			if(empty($this->pesDataNascimento)){
				return "";
			}else{
				return date('d/m/Y', strtotime($this->pesDataNascimento));
			}
		}

		public function Logar(){
			$sql="";
			$sql = "SELECT Id, Nome, Cpf, Perfil FROM tbPessoa WHERE Cpf = '".$this->pesCpf."') AND (Senha = '" .$this->sha1.$senha. "') AND (Situacao = 1) LIMIT 1";
			
			//echo "-------------------------------- SQL: ".$sql;
			return AcessoDados::listar($sql);
		}
	}
?>