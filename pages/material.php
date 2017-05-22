<?php
	include_once 'valida-sessao.php';
	class Material{

		public $matId;
		public $matDescricao;
		public $matLink;
		public $matAno;
		public $matAtivo;
		public $matCursos;	/*array CursoHasMaterial*/

		public function __construct(){
			$this->matId = 0;
			$this->matDescricao = "";
			$this->matLink = "";
			$this->matAno = "";
			$this->matAtivo = 1;
			$this->matCursos = array();
		}

        public function listar(){
			return AcessoDados::listar("SELECT Id, Descricao, Ano, Link, COALESCE(Ativo, 1) Ativo, CASE WHEN COALESCE(Ativo, 1) = 1 THEN 'Ativo' ELSE 'Inativo' END Situacao FROM tbMaterial ORDER BY Descricao");
        }

        public function listarPorTurma($idTurma){

        }

        public function carregarDados(){
			$resultado = AcessoDados::listar("SELECT Id, Descricao, Ano, Link, COALESCE(Ativo, 1) Ativo FROM tbMaterial WHERE ".$this->matId);
			if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                $this->matDescricao = $row["Descricao"];
                $this->matAno = $row["Ano"];
                $this->matLink = $row["Link"];
                $this->matAtivo = $row["Ativo"];
				return true;
			}else{
				return false;
			}
        }

        public function salvarDados(){
			if($this->matId > 0){
				 return AcessoDados::alterar("UPDATE tbMaterial SET Descricao = '".$this->matDescricao."', Ano = ".$this->matAno.", Link = '".$this->matLink."' WHERE Id = ".$this->matId);
			}else{
				return AcessoDados::inserir("INSERT INTO tbMaterial (Descricao, Ano, Link, Ativo) VALUES ('".$this->matDescricao."', ".$this->matAno.", '".$this->matLink."', ".$this->matAtivo.")");
			}
        }

        public function excluirLogicamente(){
			return AcessoDados::alterar("UPDATE tbMaterial SET Ativo = 0 WHERE Id = ".$this->matId);
        }

        public function excluirFisicamente(){
            
        }
	}
?>