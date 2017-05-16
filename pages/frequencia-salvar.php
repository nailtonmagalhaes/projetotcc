<?php //include_once 'menu.php';     
include_once 'frequencia.php';
//    $total = $_REQUEST['total'];
    
//    echo '<pre>';
    
    
    $erro = false;
    
    for($i = 0; $i <= $_REQUEST['total'];$i++){
        try{
            $insertFrequencia = new Frequencia();
//            var_dump($_REQUEST["Presenca".$i]=='true'?1:0);
//            var_dump($_REQUEST["idaluno".$i]);
             $insertFrequencia->frqId =                     $_REQUEST["FreqId".$i];
            $insertFrequencia->frqHasDiaSemana =            $_REQUEST["IdDiaSemana".$i];
            $insertFrequencia->frqMatricula =               $_REQUEST["numeromatricula".$i];
            $insertFrequencia->frqData =                    date("Y-m-d");
            $insertFrequencia->frqPresente =                ($_REQUEST["Presenca".$i]=='true'?1:0);
//                $insertFrequencia->frqAtivo =                   1;                 

            $salvar = $insertFrequencia->salvarDados();
            
            if(!$salvar){
                $erro = true;
            }

        } catch (Exception $e) {
            $erro = true;
        }

    }
    

    echo json_encode((bool)$erro);
        
 ?>