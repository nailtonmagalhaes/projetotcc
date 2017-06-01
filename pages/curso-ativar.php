<?php
    include_once '../conf/acesso-dados.php';
    include_once 'curso.php';
    header('Content-Type: application/json');
    //header('Content-type: text/html; charset=utf-8');
    //header('Content-type: text/html; charset=ISO-8859-1');

    /* VERIFICO SE HOUVE UM POST */
    if(count($_POST) > 0 && $_POST["id"] > 0) {
        try{

            $curso = new Curso();
            $curso->crsId = addslashes($_POST["id"]);

            if($curso->ativar()){
                echo json_encode(array('success'=>true, 'message'=>'Curso reativado com sucesso!'));
            }else{
                echo json_encode(array('success'=>false, 'message'=>'Não foi possível inativar o Curso!'));
            }
        }
        catch(Exception $e){
            echo json_encode(array('success'=>false, 'message'=>utf8_encode($e->getMessage())));
        }
    }else{
        echo json_encode(array('success'=>false, 'message'=>'Curso não encontrado!'));
    }
?>