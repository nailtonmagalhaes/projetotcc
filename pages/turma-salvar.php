<?php
    include_once 'turma.php';

    echo '<pre>';

    print_r($_REQUEST);

    $campos = explode("&", $_REQUEST['campos']);
    //$horarios = $_REQUEST['horarios'];
    var_dump($campos);

    echo "<br>Id: ".$_REQUEST['Id'];
    echo "<br>DataInicio: ".$_REQUEST['DataInicio'];
    echo "<br>Curso: ".$_REQUEST['Curso'];
    echo "<br>ProfessorPrincipal: ".$_REQUEST['ProfessorPrincipal'];
    echo "<br>ProfessorApoio: ".$_REQUEST['ProfessorApoio'];


    //var_dump($_REQUEST);
    //$explodido = explode("LL", $_REQUEST['horarios']);
    //var_dump($explodido);
    return true;
    die;
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

