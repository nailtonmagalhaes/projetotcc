<?php
	include_once '../conf/database.php';
    include_once 'curso-has-material.php';

	class Curso{
		public $crsId;
		public $crsDescricao;
		public $crsDuracao;
		public $crsAtivo;
		public $crsMaterias;	/*array CursoHasMaterial*/

		public function __construct(){
			$this->crsId = 0;
			$this->crsDescricao = "";
			$this->crsDuracao = 0;
			$this->crsAtivo = 1;
			$this->crsMaterias = array();
		}

		function carregarDados(){
			$resultado = listar("SELECT Id, Descricao, Duracao, COALESCE(Ativo, 1) Ativo FROM tbCurso WHERE Id = ".$this->crsId);
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
		}

		function excluirLogicamente(){
			return insere("UPDATE tbCurso SET Ativo = 0 WHERE Id = ".$this->crsId);
		}

		function excluirFisicamente(){
			return insere("DELETE FROM tbCurso WHERE Id = ".$this->crsId);
		}

		function salvarDados(){
			if($this->crsId > 0){
				return alterar("UPDATE tbCurso SET Descricao = '".$this->crsDescricao."', Duracao = ".$this->crsDuracao.", Ativo = ".$this->crsAtivo." WHERE Id = ".addslashes($this->crsId));
			}else{
				return insere("INSERT INTO tbCurso (Descricao, Duracao, Ativo) VALUES ('".$this->crsDescricao."', ".$this->crsDuracao.", 1)");
			}
		}

		function listar(){
			return listar("SELECT Id, Descricao, Duracao, Ativo, CASE WHEN Ativo = 0 THEN 'Inativo' ELSE 'Ativo' END AS Situacao FROM tbCurso ORDER BY Descricao");
		}
	}
?>