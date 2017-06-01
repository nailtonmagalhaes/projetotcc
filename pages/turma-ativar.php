<?php
    include_once '../conf/acesso-dados.php';
    include_once 'turma.php';
    header('Content-Type: application/json');
    //header('Content-type: text/html; charset=utf-8');
    //header('Content-type: text/html; charset=ISO-8859-1');

    /* VERIFICO SE HOUVE UM POST */
    if(count($_POST) > 0 && $_POST["id"] > 0) {
        try{

            $turma = new Turma();
            $turma->turId = addslashes($_POST["id"]);

            if($turma->ativar()){
                echo json_encode(array('success'=>true, 'message'=>'Turma reativada com sucesso!'));
            }else{
                echo json_encode(array('success'=>false, 'message'=>'Não foi possível inativar a Turma!'));
            }
        }
        catch(Exception $e){
            echo json_encode(array('success'=>false, 'message'=>utf8_encode($e->getMessage())));
        }
    }else{
        echo json_encode(array('success'=>false, 'message'=>'Turma não encontrada!'));
    }
?>