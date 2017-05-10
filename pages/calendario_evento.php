<?php
    //Conectando ao banco de dados
    include_once '../conf/database.php'; 
    include_once '../conf/config.php';
    

    $consulta = listar("SELECT * FROM eventos"); 
    
//    echo '<pre>';

    foreach ($consulta as $key => $value) { 
        //echo "Nome: {$linha['nome']} - E-mail: {$linha['email']}<br />";
        $vetor[] = $value;     
     }

//     var_dump($vetor);die;
    //Passando vetor em forma de json
    echo json_encode($vetor);
    
?>