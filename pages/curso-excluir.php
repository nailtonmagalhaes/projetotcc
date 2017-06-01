<?php
include_once '../conf/acesso-dados.php';
include_once 'curso.php';
header('Content-Type: application/json');
//header('Content-Type: application/json');
//header('Content-type: text/html; charset=utf-8');
//header('Content-type: text/html; charset=ISO-8859-1');

$msg = '';
$suc = false;

/* VERIFICO SE HOUVE UM POST */
if(count($_POST) > 0 && $_POST["id"] > 0) {
    try{
        //throw new Exception("fsdfsdçgjdskçljgkdjgjsj");
        $curso = new Curso();
        $curso->crsId = addslashes($_POST["id"]);

        if($curso->excluirLogicamente()){
            $suc = true;
            $msg = "Curso inativado com sucesso.";
        }else{
            $suc = false;
            $msg = utf8_encode('Não foi possível inativar o registro!');
        }
    }
    catch(Exception $e){
        $suc = false;
        $msg = utf8_encode($e->getMessage());
    }
}else{
    $suc = false;
    $msg ='Registro não encontrado!';
}
echo json_encode(array('success'=>$suc, 'message'=>$msg));
?>