<?php
class AgendaDia{
    public $idTurma;
    public $aluno;
    public $horaInicio;
    public $horaTermino;
    public $curso;
    function __construct(){
        $this->aluno='';
        $this->curso='';
        $this->horaInicio='';
        $this->horaTermino='';
        $this->idTurma=0;
    }
}
?>