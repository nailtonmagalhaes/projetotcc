<?php
    include_once 'turma.php';



    echo '<pre>';

    print_r($_REQUEST);
    echo "</br>Data Inicio: ".$_REQUEST["DataInicio"];
    echo "</br>Id Curso: ".$_REQUEST["Curso"];
    echo "</br>Professor Principal: ".$_REQUEST["ProfessorPrincipal"];
    echo "</br>Professor Apoio: ".$_REQUEST["ProfessorApoio"];

    $cont = 1;
    foreach($_REQUEST["Datas"] as $data){
        echo "</br>Dia Semana ".$cont." :".$data["DiaSemana"];
        echo "</br>Hora Início ".$cont." :".$data["HoraInicio"];
        echo "</br>Hora Término ".$cont." :".$data["HoraTermino"];
        $cont = $cont + 1;
    }
    
    die;
    return true;

    /* VERIFICO SE HOUVE UM POST */
    if(count($_REQUEST) > 0) {
        $turma = new Turma();
        $turma->turProfessorHasTurma = new ProfessorHasTurma();
        $turma->turProfessorHasTurma->phtProfessor = new Professor();

        if(isset($_REQUEST["Id"])){
            $turma->turId = $_REQUEST["Id"];
        }
        if(isset($_REQUEST["DataInicio"])){
            $turma->turDataInicio = date("Y-m-d", strtotime(str_replace('/','-', $_REQUEST["DataInicio"])));
        }
        if(isset($_REQUEST["Curso"])){
            $turma->turCurso->crsId = $_REQUEST["Curso"];
        }
        if(isset($_REQUEST["ProfessorPrincipal"])){
            $profPrincipal = new ProfessorHasTurma();
            $profPrincipal->phtTipo = ETipoProfessor::Principal;
            $profPrincipal->phtProfessor = new Professor();
            $profPrincipal->phtProfessor->pesId = $_REQUEST["ProfessorPrincipal"];
            $turma->turProfessorHasTurma[] = $profPrincipal;
        }
        if(isset($_REQUEST["ProfessorApoio"])){
            $profApoio = new ProfessorHasTurma();
            $profApoio->phtTipo = ETipoProfessor::Apoio;
            $profApoio->phtProfessor = new Professor();
            $profApoio->phtProfessor->pesId = $_REQUEST["ProfessorApoio"];
            $turma->turProfessorHasTurma[] = $profApoio;
        }

        if (isset($_REQUEST['Datas'])) {
            foreach ($_REQUEST['Datas'] as $data) {
                $d = new TurmaHasDiaSemana();
                $d->thdDiaSemana = new DiaSemana();
                $d->thdDiaSemana->disId = $data["DiaSemana"];
                $d->thdHoraInicio = $data["HoraInicio"];
                $d->thdHoraTermino = $data["HoraTermino"];
                $turma->turHasDiaSemana[] = $d;
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

