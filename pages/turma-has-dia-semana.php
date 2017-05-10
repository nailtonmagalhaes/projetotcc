<?php
	
    include_once 'includes.php';

    class TurmaHasDiaSemana{
        public $thdId;
        public $thdDiaSemana;   /*DiaSemana*/
        public $thdTurma;       /*Turma*/
        public $thdHoraInicio;
        public $thdHoraTermino;
        public $thdFrequencias; /*Frequencia*/

        public function __construct(){
            $this->thdId = 0;
            $this->thdDiaSemana = new DiaSemana();
            $this->thdTurma = new Turma();
            $this->thdHoraInicio = "";
            $this->thdHoraTermino = "";
            $this->thdFrequencias = array();
        }

        public function salvarDados(){
            $sql = "";
            if($this->thdId > 0){
                $sql = "UPDATE tbTurma_has_DiaSemana SET IdDiaSemana = ".$this->thdDiaSemana->disId.", IdTurma = ".$this->thdTurma->turId.", HoraInicio = '".$this->thdHoraInicio."', HoraTermino = '".$this->thdHoraTermino."' WHERE Id = ".$this->thdId;
            }else{
                $sql = "INSERT INTO tbTurma_has_DiaSemana (IdTurma, IdDiaSemana, HoraInicio, HoraTermino) VALUES (".$this->thdTurma->turId.", ".$this->thdDiaSemana->disId.", '".$this->thdHoraInicio."', '".$this->thdHoraTermino."')";
            }
            return insere($sql);
        }

        public function listar(){
            return listar("SELECT
                            thas.Id, thas.HoraInicio, thas.HoraTermino,
                            t.Id AS IdTurma, t.DataInicio, t.IdCurso,
                            d.Id AS IdDiaSemana, d.Dia
                            FROM tbTurma_has_DiaSemana thas
                            INNER JOIN tbTurma t ON t.Id = thas.IdTurma
                            INNER JOIN tbDiaSemana d ON d.Id = thas.IdDiaSemana");    
        }

        public function carregarDados(){
            $resultado = listar("SELECT
                            thas.Id, thas.HoraInicio, thas.HoraTermino,
                            t.Id AS IdTurma, t.DataInicio,
                            d.Id AS IdDiaSemana, d.Dia,
                            c.Id AS IdCurso, c.Descricao, c.Duracao
                            FROM tbTurma_has_DiaSemana thas
                            INNER JOIN tbTurma t ON t.Id = thas.IdTurma
                            INNER JOIN tbDiaSemana d ON d.Id = thas.IdDiaSemana
                            INNER JOIN tbCurso c ON c.Id = t.IdCurso
                            WHERE thas.Id = ".$this->thdId); 
            if ($resultado && $resultado->num_rows > 0) {
                $linha = $resultado->fetch_assoc(); 
                $this->thdHoraInicio = $linha["HoraInicio"];
                $this->thdHoraTermino = $linha["HoraTermino"];
                $this->thdTurma = new Turma();
                $this->thdTurma->turId = linha["IdTurma"];
                $this->thdTurma->turDataInicio = linha["DataInicio"];
                $this->thdTurma->turCurso = new Curso();
                $this->thdTurma->turCurso->crsId = linha["IdCurso"];
                $this->thdTurma->turCurso->crsDescricao = linha["Descricao"];
                $this->thdTurma->turCurso->crsDuracao = linha["Duracao"];
                $this->thdDiaSemana = new DiaSemana();
                $this->thdDiaSemana->disId = linha["IdDiaSemana"];
                $this->thdDiaSemana->disDia = linha["Dia"];
            }
        }

        public function horaInicioFormatada(){
            if($this->thdHoraInicio != null){
                $date = new DateTime($this->thdHoraInicio);
                return $date->format("H:i");
            }else{
                return null;
            }
        }

        public function horaTerminoFormatada(){
            if($this->thdHoraTermino != null){
                $date = new DateTime($this->thdHoraTermino);
                return $date->format('H:i');
            }else{
                return null;
            }
        }
    }
?>