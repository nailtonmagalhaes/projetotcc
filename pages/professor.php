<?php
        include_once 'pessoa.php';

                class Professor extends Pessoa{

                //Construtor
                public function __construct(){
                        parent::__construct();//Chamando o construtor da classe pai                      
                        $this->pesPerfil = EPerfil::Professor;                         
                }

                public function listar(){
                        $this->pesPerfil = EPerfil::Professor;
                        return parent::listar();
                }

                public function salvarDados(){
                        $salvou = parent::salvarDados();
                        return $salvou;
                }
        }
?>      