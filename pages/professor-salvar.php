<?php //include_once 'menu.php'; 
    include_once 'includes.php';
   
 ?>
<!--Alert Top Cheio de Viadagem mais e Top--> 
<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">  

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php

                    /* VERIFICO SE HOUVE UM POST */
                    if(count($_POST["profId"]) > 0) {
                        $professor = new Professor();

                        if(isset($_POST["profId"])){
                                $professor->profId = $_POST["profId"];
                        }
                        if(isset($_POST["profNome"])){
                                $professor->profNome = $_POST["profNome"];
                        }
                        if(isset($_POST["profDataNascimento"])){
                                $professor->profDataNascimento = $_POST["profDataNascimento"];	
                        }
                        if(isset($_POST["profCpf"])){
                                $professor->profCpf = $professor->limparCaracteres($_POST["profCpf"]);	
                        }
                        if(isset($_POST["profRg"])){
                                $professor->profRg = $professor->limparCaracteres($_POST["profRg"]);	
                        }
                        if(isset($_POST["profSexo"])){
                                $professor->profSexo = $_POST["profSexo"];	
                        }
                        if(isset($_POST["profSenha"])){
                                $professor->profSenha = $_POST["profSenha"];	
                        }
                        if(isset($_POST["profSituacao"])){
                                $professor->profSituacao = $_POST["profSituacao"];	
                        }

                        if(empty($professor->profNome) || empty($professor->profCpf) || empty($professor->profRg)){
                                header("location: ..\pages\professor-cadastro.php?id=".$id."&nome=".$nome."&cpf=".$cpf."&rg=".$rg."&cpf=".$cpf."&perfil=".$perfil."&sexo=".$sexo."&senha=".$senha."&DataNascimento=".$data_nasc."&situacao=".$situacao);
                                die;
                        }		


                        try{ 				 			
                            $retorno;

                            $retorno = $professor->salvar();

                            $insert = insere($retorno);

                            if($insert){
                                ?>
                                <script>
                                        swal("Dados salvos com sucesso!", "", "success");
                                        window.setTimeout("location.href='../pages/professor-listar.php'",2000);
                                </script>
                                <?php //header("location: ..\pages\curso-listar.php");
                            }else{
                                    header("location: ..\pages\professor-cadastro.php?id=".$id."&nome=".$nome."&cpf=".$cpf."&rg=".$rg."&cpf=".$cpf."&perfil=".$perfil."&sexo=".$sexo."&senha=".$senha."&DataNascimento=".$data_nasc."&situacao=".$situacao);
                            }
                        }catch(Exception $e){
                            echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
                        }	 
                    }
            ?>
        </div>
    </div>
</div>

