<?php
    include_once 'valida-sessao.php';
    include_once '../conf/acesso-dados.php';
    
    $where;
    
    if($_SESSION["perfil"]==3){
        $where = "AND TRUE";
    } else {
        $where = " AND IdProfessor = {$_SESSION["perfil"]}";
    }
    
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
                    LEFT JOIN tbprofessor_has_turma tp ON(tds.IdTurma = tp.IdTurma {$where})
            ";
//    echo '<pre>';    
//    var_dump($sql);die;
    
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