<?php
    include_once 'valida-sessao.php';
    include_once '../conf/acesso-dados.php';
    include_once 'turma.php';

//    $cep = $_POST['cep'];
    $query = $_REQUEST['term'];
//    var_dump($_REQUEST["term"]);die;
    
    $turma = new Turma();
    
    $turma = $turma->listar($query);
    
    $array;
    
//     try{
        if ($turma && $turma->num_rows > 0) {
            foreach($turma as $tma){
//                $ida1 = $tma["Id"];
//                $nomea1 = $tma["Nome"];
                $array[] = array (
                    'label' => "Curso: ".$tma["Curso"]." - Início: ".$tma["DataInicioFormatada"]." - Professor: ".$tma["Nome"]." - Dias: ".$tma["Dias"],
                    'value' => "Curso: ".$tma["Curso"]." - Início: ".$tma["DataInicioFormatada"]." - Professor: ".$tma["Nome"]." - Dias: ".$tma["Dias"],
                    'id' => $tma["Id"]
                );
                
//                $dadosTurma[]["label"] = "Curso: ".$tma["Curso"]." - Início: ".$tma["DataInicioFormatada"]." - Professor: ".$tma["Nome"]." - Dias: ".$tma["Dias"];
//                $dadosTurma[]["value"] = $tma["Id"];
                
            }   
        }
//    } catch (Exception $e) {
//        echo $e->getMessage();
//    }
//    echo '<pre>';
//    var_dump(json_encode($array));die;
    
    if(!isset($array)){
        $array = false;
    }
    echo json_encode($array);
 
?>