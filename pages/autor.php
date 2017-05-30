<?php
	include_once 'valida-sessao.php';
	Include_once '../conf/acesso-dados.php';
//	include_once 'autor-has-material.php';
	class Autor{

		public $autId;
		public $autNome;
		public $autDescricao;
		public $autAtivo;
		public $autMateriais;	/*CursoHasMaterial*/

		public function __construct(){
			$this->autId = 0;
			$this->autNome = "";
			$this->autDescricao = "";
			$this->autAtivo = 1;
			$this->autMateriais = array();
		}

        public function listar(){
			try {
				return AcessoDados::listar("SELECT Id,Nome,Descricao,COALESCE(Ativo,1) AS Ativo, CASE WHEN COALESCE(Ativo,1)=1 THEN 'ATIVO' ELSE 'INATIVO' END AS Situacao  FROM tbAutor ORDER BY Nome");
			} catch (Exception $e) {
				throw new Exception("Erro ao listar os AUTOR.<br>".$e->getMessage());				
			}
        }

        public function carregarDados(){
			try {
				$resultado = AcessoDados::listar("SELECT Id, Nome, Descricao, COALESCE(Ativo, 1) Ativo FROM tbAutor WHERE Id = ".$this->autId);
	            if ($resultado && $resultado->num_rows > 0) {
	                $row = $resultado->fetch_assoc();                                                                                                                   
	                $this->autId = $row["Id"];
	                $this->autNome = $row["Nome"];
	                $this->autDescricao = $row["Descricao"];
	                $this->autAtivo = $row["Ativo"];
	                return true;
	            }else{
	                return false;
	            }
			} catch (Exception $e) {
				throw new Exception("Erro ao carregar os dados do Autor.<br>".$e->getMessage());				
			}			
        }

        public function salvarDados(){
			try {
				if($this->autId > 0){
					return AcessoDados::alterar("UPDATE tbAutor SET Nome = '".$this->autNome."', Descricao = '".$this->autDescricao."', Ativo = ".$this->autAtivo." WHERE Id = ".addslashes($this->autId));
				}else{
					return AcessoDados::inserir("INSERT INTO tbAutor (Nome, Descricao, Ativo) VALUES ('".$this->autNome."','".$this->autDescricao."', 1)");
				}
			} catch (Exception $e) {
				throw new Exception("Erro ao salvar o Autor.<br>".$e->getMessage());				
			}	
        }
    
        public function excluirLogicamente(){
			try {
				AcessoDados::abreTransacao();
				 $sucesso =  AcessoDados::alterar("UPDATE tbAutor SET Ativo = 0 WHERE Id = ".$this->autId);				
				AcessoDados::confirmaTransacao();
				return $sucesso;
			} catch (Exception $e) {
				throw new Exception("Erro ao inativar o autor.<br>".$e->getMessage());
			}
        }

        public function excluirFisicamente(){
			try {
				return AcessoDados::inserir("DELETE FROM tbaAutor WHERE Id = ".$this->autId);
			} catch (Exception $e) {
				throw new Exception("Erro ao excluir o AUTOR.<br>".$e->getMessage());
			}            
        }
	}
?>