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
                        try{
                                AcessoDados::abreTransacao();
                                $salvou = parent::salvarDados();
                                AcessoDados::confirmaTransacao();
                                return $salvou;                                
                        }catch(Exception $ex){
                                throw new Exception("Erro ao salvar os dados do professor.\n".$ex->getMessage());                                
                        }
                }
        }
?>      