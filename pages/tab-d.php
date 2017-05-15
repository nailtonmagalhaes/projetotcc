<?php
    class TabD{
        public $Id;
        public $NomeTabD;
        public $TabA;

        function __construct(){
            $this->Id = 0;
            $this->NomeTabD = "NOME TAB D";
            $this->TabA = null;
        }

        public function salvarDados(){
            $this->Id = AcessoDados::inserir("INSERT INTO tabD(IdTabA, NomeTabD) VALUES (".$this->TabA->Id.", '".$this->NomeTabD."')");
            return $this->Id > 0;
        }
    }
?>