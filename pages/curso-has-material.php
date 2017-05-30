<?php

    include_once 'curso.php';
    include_once 'material.php';

    class CursoHasMaterial{
        public $chmCurso;       /*Curso*/
        public $chmMaterial;    /*Material*/

        public function __construct(){
            $this->chmCurso = new Curso();
            $this->chmMaterial = new Material();
        }

        public function listar(){

        }

        public function carregarDados(){

        }

        public function salvarDados(){
            try {
                $resultado = AcessoDados::listar("SELECT * FROM tbCurso_has_Material WHERE IdCurso = ".$this->chmCurso->crsId." AND IdMaterial = ".$this->chmMaterial->matId);
                if($resultado == null || $resultado->num_rows <= 0)
                    AcessoDados::abreTransacao();
                    AcessoDados::inserir("INSERT INTO tbCurso_has_Material(IdCurso, IdMaterial) VALUES (".$this->chmCurso->crsId.", ".$this->chmMaterial->matId.")");
                    AcessoDados::confirmaTransacao();
            } catch (Exception $e) {
                throw new Exception("Erro ao salvar os dados do Curso HAS MAterial.<br>".$e->getMessage());                
            }

        }

        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
    }
?>