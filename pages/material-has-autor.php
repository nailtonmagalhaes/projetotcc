<?php

    include_once 'material.php';
    include_once 'autor.php';

    class MaterialHasAutor{
        public $mhaAutor;       /*Autor*/
        public $mhaMaterial;   /*Material*/

        public function __construct(){
            $this->mhaAutor = new Autor();
            $this->mhaMaterial = new Material();
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