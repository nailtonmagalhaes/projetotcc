<?php
    class TabC{
        public $Id;
        public $NomeTabC;
        public $TabA;

        function __construct(){
            $this->Id = 0;
            $this->NomeTabC = "NOME TAB C";
            $this->TabA = null;
        }

        public function salvarDados(){
            $this->Id = AcessoDados::inserir("INSERT INTO tabC(IdTabA, NomeTabC) VALUES (".$this->TabA->Id.", '".$this->NomeTabC."')");
            return $this->Id > 0;
        }
    }
?>