<?php
    //Conectando ao banco de dados
//    include_once '../conf/database.php'; 
//    include_once '../conf/config.php';
    include_once '../conf/acesso-dados.php';
    
    
    $sql = "SELECT 
                    tds.IdTurma
                    ,tds.Id as id
                    ,concat(tc.Descricao, \" - \",TIME(HoraInicio),\" - \",TIME(HoraTermino)) as title
                    ,HoraInicio as start
                    ,null as teste
                    
            FROM 
                    tbturma_has_diasemana tds
                    INNER JOIN tbturma tt  ON(tds.IdTurma = tt.id)
                    INNER JOIN tbCurso tc ON(tc.Id = tt.IdCurso)
            ";
    
    $consulta = AcessoDados::listar($sql); 
    
//    echo '<pre>';
//    var_dump($sql);die;
           
    if($consulta){
        foreach ($consulta as $key => $value) { 
            //echo "Nome: {$linha['nome']} - E-mail: {$linha['email']}<br />";

            $vetor[] = $value; 
         }
    }
    

//     var_dump($vetor);die;
    //Passando vetor em forma de json
     
//    if($vetor==null){
//        $vetor[] = false;
//    }
    if($consulta==null){
        $vetor = false;
    }
    
    echo json_encode($vetor);
    
?>