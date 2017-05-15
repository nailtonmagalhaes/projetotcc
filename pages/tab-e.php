<?php
    class TabE{
        public $NomeTabE;
        public $TabB;
        public $TabC;

        function __construct(){
            $this->NomeTabE = "NOME TAB E";
            $this->TabB = null;
            $this->TabC = null;
        }

        public function salvarDados(){
            return AcessoDados::inserir("INSERT INTO tabE(IdTabB, IdTabC, NomeTabE) VALUES (".$this->TabB->Id.", ".$this->TabC->Id.", '".$this->NomeTabE."')");
        }
    }
?>