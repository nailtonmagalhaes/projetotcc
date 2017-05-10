<?php
    //Conectando ao banco de dados
    include_once '../conf/database.php'; 
    include_once '../conf/config.php';
    
    $sql = "SELECT 
                    tds.IdTurma as id
                    ,concat(tc.Descricao, \" - \",TIME(HoraInicio),\" - \",TIME(HoraTermino)) as title
                    ,HoraInicio as start
                    ,null as teste
                    
            FROM 
                    tbturma_has_diasemana tds
                    INNER JOIN tbturma tt  ON(tds.IdTurma = tt.id)
                    INNER JOIN tbCurso tc ON(tc.Id = tt.IdCurso)
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