<?php
    //Conectando ao banco de dados
//    include_once '../conf/database.php'; 
//    include_once '../conf/config.php';
    include_once '../conf/acesso-dados.php';
    
    $sql = "
                    SELECT
                            IdAluno
                            ,tse.IdTurma
                            ,tse.Id
                            ,mat.Id as NumeroMatricula
                            ,Nome
                            ,Presente
                            ,freq.Id as freqId
                    FROM
                            tbturma_has_diasemana tse
                            INNER JOIN tbmatricula mat ON(mat.IdTurma = tse.IdTurma)
                            INNER JOIN tbpessoa pes ON(mat.IdAluno = pes.Id)
                            LEFT JOIN tbfrequencia freq ON(freq.IdDiaSemana = tse.Id AND freq.IdMatricula = mat.Id)
                    WHERE
                            tse.Id = {$_POST["Id"]}
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

    if($consulta==null){
        $vetor = false;
    }
//     var_dump($vetor);die;
    //Passando vetor em forma de json
    echo json_encode($vetor);
    
?>