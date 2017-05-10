<?php
    include_once 'includes.php';

        
	class Professor extends Pessoa{
		public $profId;
                public $profNome;
                public $profData_nasc;
                public $profCpf;
                public $profRg;
                public $profSexo;
		
		//Construtor
		public function __construct(){
			parent::__construct();//Chamando o construtor da classe pai                      
                        $this->pesPerfil = EPerfil::Professor;
			$this->profId           = 0;
                        $this->profNome         = '';
                        $this->profData_nasc    = '';
                        $this->profCpf          = '';
                        $this->profRg           = '';
                        $this->profSexo         = 0;
                        $this->profSenha        = '';
                        $this->profSituacao     = '';  
                        
		}

                public function listar(){

			$this->pesPerfil = EPerfil::Professor;
                        //echo "--------------------------------------------------------- Perfil: ".$this->pesPerfil;
			return parent::listar();
		}

		function salvar(){
			$sql="";
                        
			if($this->profId > 0){
				$sql = "
                                        UPDATE 
                                                tbpessoa 
                                        SET 
                                                Id                  = {$this->profId}
                                                ,Nome               = '{$this->profNome}'
                                                ,Cpf                = '{$this->profCpf}'
                                                ,Rg                 = '{$this->profRg}'
                                                ,Sexo               = {$this->profSexo}
                                                ,DataNascimento     = '{$this->profData_nasc}'
                                                ,Perfil             = 2
                                                ,Senha              = '{$this->profSenha}'
                                                ,Situacao           = '{$this->profSituacao}'
                                        WHERE 
                                                Id = {$this->profId}
                                        ";
                                
			}else{
				$sql = "
                                        INSERT INTO 
                                                tbpessoa 
                                                (Nome
                                                ,Cpf
                                                ,Rg
                                                ,Sexo
                                                ,DataNascimento
                                                ,Perfil
                                                ,Senha
                                                ,Situacao) 
                                        VALUES 
                                                ('{$this->profNome}'
                                                ,'{$this->profCpf}'
                                                ,'{$this->profRg}'
                                                ,{$this->profSexo}
                                                ,'{$this->profDataNascimento}'
                                                ,2
                                                ,'{$this->profSenha}'
                                                ,{$this->profSituacao})";
			}
                        
                        if($this->profId>0){
                            $param = 
                                $this->profId
                                .','.$this->profNome
                                .','.$this->profCpf
                                .','.$this->profRg
                                .','.$this->profSexo
                                .','.$this->profDataNascimento
                                .','.$this->profSenha
                                .','.$this->profSituacao
                                .','.$this->profId;         
                        } else {
                            $param =
                                $this->profNome
                                .','.$this->profCpf
                                .','.$this->profRg
                                .','.$this->profSexo
                                .','.$this->profDataNascimento
                                .','.$this->profSenha
                                .','.$this->profSituacao;
                        }
                        
			return $sql;
                        
		}
                
                function excluir(){
                    $sql="UPDATE
                                tbpessoa
                          SET
                                Situacao    =   0
                          WHERE
                                Id          =   {$this->profId}";
                                
                    return $sql;
                }

	}
?>