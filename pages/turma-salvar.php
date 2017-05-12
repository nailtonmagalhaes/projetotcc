<?php
    include_once 'includes.php';

    /* VERIFICO SE HOUVE UM POST */
    if(count($_POST) > 0) {
        $turma = new Turma();
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        die;

        if(isset($_POST["turId"])){
            $turma->turId = $_POST["turId"];
        }
        if(isset($_POST["turDataInicio"])){
            $turma->turDataInicio = date("Y-m-d", strtotime(str_replace('/','-', $_POST["turDataInicio"])));
        }
        if(isset($_POST["turCurso"])){
            $turma->turCurso->crsId = $_POST["turCurso"];	
        }

        if (isset($_POST['form'])) {
            foreach ($_POST['form'] as $row) {
                print_r($row);
            }
        }

        if(empty($turma->turCurso->crsId) || $turma->turCurso->crsId < 1 || empty($turma->turDataInicio)){
            echo json_encode("Dados invalidos.");
        }else{		

            try{ 				 			

                if($turma->salvar()){
                    ?>
                    <script>
                        swal("Dados salvos com sucesso!", "", "success");
                        window.setTimeout("location.href='../pages/turma-listar.php'",2000);
                    </script>
                    <?php 
                    //echo json_encode(true);
                }else{
                    echo json_encode(false);
                }
            }catch(Exception $e){
                echo json_encode($e->getMessage());
            }	 
        }
    }
?>

