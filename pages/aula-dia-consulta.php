<?php
include_once '../conf/acesso-dados.php';
include_once 'agenda-aulas-dia.php';

$strData = $_POST['data'];

$listaAulas = array();
$aulas = AcessoDados::listar("SELECT
t.Id as IdTurma, p.Nome as Aluno, c.Descricao as Curso, DATE_FORMAT(has.HoraInicio,'%H:%i') as HoraInicio,
DATE_FORMAT(has.HoraTermino,'%H:%i') as HoraTermino
FROM tbTurma t 
INNER JOIN tbTurma_has_DiaSemana has ON has.IdTurma = t.Id
INNER JOIN tbMatricula m ON m.IdTurma = t.Id
INNER JOIN tbPessoa p ON p.Id = m.IdAluno
INNER JOIN tbCurso c ON c.Id = t.IdCurso
WHERE STR_TO_DATE( '".$strData."', '%d/%m/%Y') = DATE_FORMAT(has.HoraInicio,'%Y-%m-%d') OR 
STR_TO_DATE( '".$strData."', '%d/%m/%Y') = DATE_FORMAT(has.HoraTermino,'%Y-%m-%d')
");
if($aulas && $aulas->num_rows>0){
    while ($row = $aulas->fetch_assoc())
    {
        try
        {
            $aula = new AgendaDia();
            $aula->idTurma=$row['IdTurma'];
            $aula->aluno=$row['Aluno'];
            $aula->horaInicio=$row['HoraInicio'];
            $aula->horaTermino=$row['HoraTermino'];
            $aula->curso=$row['Curso'];
            $listaAulas[]=$aula;
        }
        catch (Exception $exception)
        {

        } 
    }   
}
echo json_encode($listaAulas);
?>