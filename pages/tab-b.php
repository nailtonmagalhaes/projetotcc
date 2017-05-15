<?php
    class TabB{
        public $Id;
        public $NomeTabB;
        public $TabA;

        function __construct(){
            $this->Id = 0;
            $this->NomeTabB = "NOME TAB B";
            $this->TabA = null;
        }

        public function salvarDados(){
            $this->Id = AcessoDados::inserir("INSERT INTO tabB(IdTabA, NomeTabB) VALUES (".$this->TabA->Id.", '".$this->NomeTabB."')");
            return $this->Id > 0;
        }
    }
?>