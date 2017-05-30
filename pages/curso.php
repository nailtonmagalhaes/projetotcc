<?php
	include_once 'valida-sessao.php';
    include_once 'curso-has-material.php';
	class Curso{
		public $crsId;
		public $crsDescricao;
		public $crsDuracao;
		public $crsAtivo;
		public $crsMateriais;	/*array CursoHasMaterial*/

		public function __construct(){
			$this->crsId = 0;
			$this->crsDescricao = "";
			$this->crsDuracao = 0;
			$this->crsAtivo = 1;
			$this->crsMateriais = array();
		}

		function carregarDados(){
			try {
				$resultado = AcessoDados::listar("SELECT Id, Descricao, Duracao, COALESCE(Ativo, 1) Ativo FROM tbCurso WHERE Id = ".$this->crsId);
	            if ($resultado && $resultado->num_rows > 0) {
	                $row = $resultado->fetch_assoc();                                                                                                                   
	                $this->crsId = $row["Id"];
	                $this->crsDescricao = $row["Descricao"];
	                $this->crsDuracao = $row["Duracao"];
	                $this->crsAtivo = $row["Ativo"];
	                return true;
	            }else{
	                return false;
	            }
			} catch (Exception $e) {
				throw new Exception("Erro ao carregar os dados do curso.<br>".$e->getMessage());				
			}			
		}

		function excluirLogicamente(){
			try {
				AcessoDados::abreTransacao();
				$result = AcessoDados::inserir("UPDATE tbCurso SET Ativo = 0 WHERE Id = ".$this->crsId);
				AcessoDados::confirmaTransacao();
				return $result;
				
			} catch (Exception $e) {
				throw new Exception("Erro ao inativar o curso.<br>".$e->getMessage());
			}			
		}

		function excluirFisicamente(){
			try {
				return AcessoDados::inserir("DELETE FROM tbCurso WHERE Id = ".$this->crsId);
			} catch (Exception $e) {
				throw new Exception("Erro ao excluir o curso.<br>".$e->getMessage());
			}
		}

		function salvarDados(){
			try {
				if($this->crsId > 0){
					return AcessoDados::alterar("UPDATE tbCurso SET Descricao = '".$this->crsDescricao."', Duracao = ".$this->crsDuracao.", Ativo = ".$this->crsAtivo." WHERE Id = ".addslashes($this->crsId));
				}else{
					return AcessoDados::inserir("INSERT INTO tbCurso (Descricao, Duracao, Ativo) VALUES ('".$this->crsDescricao."', ".$this->crsDuracao.", 1)");
				}
			} catch (Exception $e) {
				throw new Exception("Erro ao salvar o curso.<br>".$e->getMessage());				
			}			
		}

		function listar(){
			try {
				return AcessoDados::listar("SELECT Id, Descricao, Duracao, Ativo, CASE WHEN Ativo = 0 THEN 'Inativo' ELSE 'Ativo' END AS Situacao FROM tbCurso ORDER BY Descricao");
			} catch (Exception $e) {
				throw new Exception("Erro ao listar os cursos.<br>".$e->getMessage());				
			}
		}
	}
?>