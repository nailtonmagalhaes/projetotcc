<?php
    class TabA{
        public $Id;
        public $NomeTabA;

        function __construct(){
            $this->Id = 0;
            $this->NomeTabA = "NOME TAB A";
        }

        public function salvarDados(){
            $this->Id = AcessoDados::inserir("INSERT INTO tabA(NomeTabA) VALUES ('".$this->NomeTabA."')");
            return $this->Id > 0;
        }
    }
?>