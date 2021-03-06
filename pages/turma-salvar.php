<?php
    ini_set("display_erros", true);
    include_once 'turma.php';
    include_once 'curso.php';
    include_once '../conf/acesso-dados.php';
//    date_default_timezone_set('America/Sao_Paulo');
    header('Content-Type: application/json');
     
    $dias = array();
    $hora = array();
    
    $curso = new Curso();
    $curso->crsId = $_REQUEST["Curso"];
    $curso->carregarDados();
    
    
    foreach ($_REQUEST['Datas'] as $data) {
//        $d = new TurmaHasDiaSemana();
//        $d->thdId = $data["IdHasDia"];
//        $d->thdDiaSemana = new DiaSemana();
        $time = new DateTime($data["HoraInicio"]);
        $timeStop = new DateTime($data["HoraTermino"]);
        $diff = $timeStop->diff($time);
        $tempo = $diff->format('%h:%i');
        
//        $tempo = gmdate('H:i', strtotime(  ) - strtotime(  ) );
        
        $dias[] = $data["DiaSemana"];
        $hora[]["hora"] = $tempo;
//        $d->thdHoraInicio = date("Y-m-d H:i", strtotime($data["HoraInicio"]));
//        $d->thdHoraTermino = date("Y-m-d H:i", strtotime($data["HoraTermino"]));;
//        $turma->turHasDiaSemana[] = $d;
    }
    
//    echo "<pre>";
//    var_dump($dias);
//    var_dump($_REQUEST["DataInicio"]);die;
    $turma = new Turma();
    $arr_dias = $turma->calculaDiasTurma($dias,$hora,$curso->crsDuracao,$_REQUEST["DataInicio"]);
    
//    var_dump($arr_dias);
//    die;
    
    
    /*
    echo '<pre>';
    echo "REQUESET<br>############################################################################################<br>";
    print_r($_REQUEST);
    echo "DADOS<br>############################################################################################<br>";
    echo "</br>Data Inicio: ".$_REQUEST["DataInicio"];
    echo "</br>Data Inicio Banco: ".date("Y-m-d", strtotime(str_replace("/", "-", $_REQUEST["DataInicio"])));
    echo "</br>Data Inicio Banco 2: ".date("Y-m-d", strtotime($_REQUEST["DataInicio"]));
    echo "</br>Id Curso: ".$_REQUEST["Curso"];
    echo "</br>Professor Principal: ".$_REQUEST["ProfessorPrincipal"];
    echo "</br>Professor Apoio: ".$_REQUEST["ProfessorApoio"];
    echo "<br>";
    if (isset($_REQUEST['Datas'])) {
        echo "DATAS<br>############################################################################################<br>";
        var_dump($_REQUEST['Datas']);
        echo "<br>";
        $cont = 1;
        foreach($_REQUEST["Datas"] as $data){
            echo "</br>Dia Semana ".$cont." :".$data["DiaSemana"];
            echo "</br>Hora Início ".$cont." :".$data["HoraInicio"];
            echo "</br>Hora Término ".$cont." :".$data["HoraTermino"];
            $cont = $cont + 1;
        }
    }
    echo "<br>";
    
    // VERIFICO SE HOUVE UM POST
    echo '<pre>';
    var_dump($_REQUEST);
    echo "<br>Quantidade: ".count($_REQUEST);
    echo "<br>Postou REQUEST? ".isset($_REQUEST["DataInicio"]);
    echo "<br>Postou GET? ".isset($_GET["DataInicio"]);
    echo "<br>Postou POST? ".isset($_POST["DataInicio"]);
    echo "<br>Data Post? ".$_POST["DataInicio"];
    echo "<br>Data REQUEST? ".$_REQUEST["DataInicio"];
    */
    if(count($_REQUEST) > 0) {
        $turma = new Turma();
        if(isset($_REQUEST["Id"])){
            $turma->turId = $_REQUEST["Id"];
        }
        if(isset($_REQUEST["DataInicio"])){
            $turma->turDataInicio = date("Y-m-d", strtotime(str_replace("/", "-", $_REQUEST["DataInicio"])));
        }
        if(isset($_REQUEST["Curso"])){
            $turma->turCurso = new Curso();
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

//        var_dump($_REQUEST['Datas']);die;
        if (isset($_REQUEST['Datas'])) {
            foreach ($_REQUEST['Datas'] as $data) {
//                var_dump($data["DiaSemana"]);die;
                
                foreach ($arr_dias[0] as $key => $value) {
//                    var_dump($arr_dias[0][$key]);
//                    var_dump($arr_dias[1][$key]);
//                      var_dump($arr_dias[1][$key]);
//                      var_dump($data["DiaSemana"]);
//                    var_dump(date("Y-m-d H:i", strtotime($arr_dias[0][$key]." ".$data["HoraInicio"])));
//                    var_dump($data["HoraInicio"]);die;
                    if($arr_dias[1][$key] == $data["DiaSemana"]){
                        $d = new TurmaHasDiaSemana();
                        $d->thdId = $data["IdHasDia"];
                        $d->thdDiaSemana = new DiaSemana();
                        $d->thdDiaSemana->disId = $arr_dias[1][$key];
                        $d->thdHoraInicio = date("Y-m-d H:i", strtotime($arr_dias[0][$key]." ".$data["HoraInicio"]));
                        $d->thdHoraTermino = date("Y-m-d H:i", strtotime($arr_dias[0][$key]." ".$data["HoraTermino"]));;
                        $turma->turHasDiaSemana[] = $d;
                    }
                    
                }
                
            }
        }

        if(empty($turma->turDataInicio) || empty($turma->turCurso) || empty($turma->turCurso->crsId) || $turma->turCurso->crsId < 1 || empty($turma->turDataInicio) ||
            count($turma->turProfessorHasTurma) < 2 || empty($turma->turProfessorHasTurma[0]->phtProfessor) || empty($turma->turProfessorHasTurma[1]->phtProfessor->pesId) < 0 ||
            count($turma->turHasDiaSemana) < 1 || empty($turma->turHasDiaSemana[0]->thdDiaSemana) || empty($turma->turHasDiaSemana[0]->thdDiaSemana->disId) || $turma->turHasDiaSemana[0]->thdDiaSemana->disId < 1){
            echo json_encode("Dados invalidos.");
        }else{
            
            try{
                $result=$turma->salvarDados();
                echo json_encode(array('success'=>true, 'message'=>'Dados Salvos com Sucesso!'));
                //if($result){
                //    echo json_encode(array('success'=>true, 'message'=>'Dados Salvos com Sucesso!'));
                //}else{
                //   echo json_encode(array('success'=>false, 'message'=>'Não foi possível salvar os dados.'));
                //}
            }catch(Exception $e){
                echo json_encode(array('success'=>false, 'message'=>$e->getMessage()));
            }
            
            //echo json_encode($resultado);
        }
    }
?>

