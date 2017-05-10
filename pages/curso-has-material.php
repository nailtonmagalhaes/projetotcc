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

        }

        public function excluirLogicamente(){

        }

        public function excluirFisicamente(){
            
        }
    }
?>