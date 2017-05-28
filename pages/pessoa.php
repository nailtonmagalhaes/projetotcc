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

		public function addTelefone(Telefone $t){
			$this->pesTelefones[] = $t;
		}

		public function getTelefones() {
			return $this->pesTelefones;
		}

		public function perfilDescricao(){
			switch ($this->pesPerfil) {
				case EPerfil::Aluno:
					return 'Aluno';
				case EPerfil::Professor:
					return 'Professor';
				case EPerfil::Secretaria:
					return 'Secretaria';				
				default:
					return '';
			}
		}

		public function perfilDescricaoPlural(){
			switch ($this->pesPerfil) {
				case EPerfil::Aluno:
					return 'Alunos';
				case EPerfil::Professor:
					return 'Professores';
				case EPerfil::Secretaria:
					return 'Secretarias';				
				default:
					return '';
			}
		}

		public function sexoDescricao(){
			switch ($this->pesSexo) {
				case ESexo::Masculino:
					return 'Masculino';
				case ESexo::Feminino:
					return 'Feminino';				
				default:
					return '';
			}
		}
                
		public function limparCaracteres($str){
			$str = str_replace(".", "", $str);
			$str = str_replace("-", "", $str);
			return $str;
		}
		
		public function verificarCampos(){
			
		}

		public function listar(){
			$sql = "SELECT *, CASE Sexo WHEN 1 THEN 'Masculino' WHEN 2 THEN 'Feminino' ELSE '' END AS SexoDescricao, CASE COALESCE(Situacao, 1) WHEN 1 THEN 'Ativo' ELSE 'Inativo' END AS SituacaoDescricao FROM tbPessoa WHERE Situacao = 1 AND Perfil = ".$this->pesPerfil;
			return AcessoDados::listar($sql);
		}

		public function listarInativos(){
			$sql = "SELECT * FROM tbPessoa WHERE Situacao = 0 AND Perfil = ".$this->pesPerfil;
			return AcessoDados::listar($sql);
		}
		
		public function carregarDados(){
			try{
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
						while($row = $listaEnderecos->fetch_assoc()){
							$end = new Endereco();
							$end->endId = $row["Id"];
							$end->carregarDados();
							$end->endPessoa = $this;
							$this->addEndereco($end);
						}
					}

					$telefones = AcessoDados::listar("SELECT Id FROM tbTelefone WHERE IdPessoa = ".$this->pesId);
					if($telefones && $telefones->num_rows > 0){
						while($rt = $telefones->fetch_assoc()){
							$t = new Telefone();
							$t->telId = $rt["Id"];
							$t->carregarDados();
							$t->telPessoa = $this;
							$this->addTelefone($t);
						}
					}
	                return true;
	            }else{
	                return false;
	            }
            }catch(Exception $ex){
            	echo "Ocorreu um erro ao carregar os dados<br>";
            }
		}

		public function salvarDados(){
                        
			try{
				$sql = "";
				$sucesso = (bool)false;
				$telefonespreservar = "";
				$enderecospreservar = "";
				if($this->pesId > 0){
					$sql = "UPDATE tbPessoa SET Nome = '".$this->pesNome."', Cpf = '".$this->pesCpf."', Rg = '".$this->pesRg."', Sexo = ".$this->pesSexo.", DataNascimento = '".$this->pesDataNascimento."', Perfil = ".$this->pesPerfil.", Senha = '".$this->pesSenha."', Situacao = ".$this->pesAtivo." WHERE Id = ".$this->pesId.";";
					$sucesso = AcessoDados::alterar($sql);					
				}else{
					$sql = "INSERT INTO tbPessoa (Nome, Cpf, Rg, Sexo, DataNascimento, Perfil, Senha, Situacao) 
					VALUES ('$this->pesNome', '$this->pesCpf', '$this->pesRg', $this->pesSexo, '$this->pesDataNascimento', $this->pesPerfil, '$this->pesSenha', 1)";

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

						if(empty($enderecospreservar))
							$enderecospreservar .= $e->endId;
						else
							$enderecospreservar .= ", ".$e->endId;
					}
					
					foreach($this->pesTelefones as $t){
						$t->telPessoa = $this;
						$t->salvarDados();

						if(empty($telefonespreservar))
							$telefonespreservar .= $t->telId;
						else
							$telefonespreservar .= ", ".$t->telId;
					}

					if(!empty($enderecospreservar)){
						$sqldeletaend = "DELETE FROM tbEndereco WHERE IdPessoa = ".$this->pesId." AND Id NOT IN(".$enderecospreservar.")";
						AcessoDados::alterar($sqldeletaend);
					}

					if(!empty($telefonespreservar)){
						$sqldeletatel = "DELETE FROM tbTelefone WHERE IdPessoa = ".$this->pesId." AND Id NOT IN(".$telefonespreservar.")";
						AcessoDados::alterar($sqldeletatel);
					}

					if(count($this->pesTelefones) <= 0){
						AcessoDados::alterar("DELETE FROM tbTelefone WHERE IdPessoa = ".$this->pesId);
					}

					if(count($this->pesEnderecos) <= 0){
						AcessoDados::alterar("DELETE FROM tbEndereco WHERE IdPessoa = ".$this->pesId);
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

		public function situacaoDescricao(){
			if($this->pesAtivo == 0)
				return "Inativo";
			return "Ativo";
		}

		public function Logar(){
			try{				
				$sql = "SELECT Id, Nome, Cpf, Perfil, Senha FROM tbPessoa WHERE (Cpf = '".$this->pesCpf."') AND (Senha = '".$this->pesSenha."') AND (Situacao = 1) LIMIT 1";
				return AcessoDados::listar($sql);
			}catch(Exception $ex){
				throw new Exception("Erro ao logar.<br>".$ex->getMessage());
			}
		}

		public function excluirLogicamente(){
			try{
				AcessoDados::abreTransacao();
				$sql = 'UPDATE tbPessoa SET Situacao = 0 WHERE Id = '.$this->pesId;
				$retorno = AcessoDados::alterar($sql);
				if($retorno){
					AcessoDados::confirmaTransacao();
				}
				return $retorno;
			}catch(Exception $ex){
				throw new Exception("Ocorreu um erro ao excluir os dados.<br>".$ex->getMessage());
			}
		}
	}
?>