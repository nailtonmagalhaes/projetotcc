<?php
    //Conectando ao banco de dados
    include_once '../conf/database.php'; 
    include_once '../conf/config.php';
    
    $sql = "
                    SELECT
                            IdAluno
                            ,IdTurma
                            ,NumeroMatricula
                            ,Nome
                    FROM
                            tbmatricula mat
                            INNER JOIN tbpessoa pes ON(mat.IdAluno = pes.Id)
                    WHERE
                            IdTurma = {$_POST["IdTurma"]}
            ";
    
    $consulta = listar($sql); 
    
//    echo '<pre>';
//    var_dump($sql);die;

    foreach ($consulta as $key => $value) { 
        //echo "Nome: {$linha['nome']} - E-mail: {$linha['email']}<br />";
        
        $vetor[] = $value; 
     }

//     var_dump($vetor);die;
    //Passando vetor em forma de json
    echo json_encode($vetor);
    
?>