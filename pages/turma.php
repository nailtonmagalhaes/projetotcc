<?php
    include_once 'includes.php';
    class Turma{
        public $turId;
        public $turCurso;
        public $turDataInicio;
        public $turAtivo;
        public $turMatriculas;          /*array Matricula*/
        public $turHasDiaSemana;        /*array TurmaHasDiaSemana*/
        public $turProfessorHasTurma;   /*array ProfessorHasTurma*/

        public function __construct(){
            $this->turId = 0;
            $this->turCurso = null;
            $this->turDataInicio = null;
            $this->turAtivo = 1;
            $this->turMatriculas = array();
            $this->turHasDiaSemana = array();
            $this->turProfessorHasTurma = array();
        }

        function carregarDados(){
            $resultado = listar("SELECT t.Id, t.DataInicio, t.Ativo, date_format(t.DataInicio, '%d/%m/%Y') DataInicioFormatada,
                                    c.Id AS IdCurso, c.Descricao, c.Duracao
                                    FROM tbTurma t 
                                    INNER JOIN tbCurso c ON c.Id = t.IdCurso
                                    WHERE t.Id = ".$this->turId);

/***************CARREGA OS DADOS DA TURMA*/
            if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();                                                                                                                   
                $this->turId = $row["Id"];
                $this->turDataInicio = $row["DataInicio"];
                $this->turCurso = new Curso();
                $this->turCurso->crsId = $row["IdCurso"];
                $this->turCurso->crsDescricao = $row["Descricao"];
                $this->turCurso->crsDuracao = $row["Duracao"];

/***************CARREGA OS DIAS DA SEMANA DA TURMA*/
                $dias = listar("SELECT
                                hs.Id, hs.HoraInicio, hs.HoraTermino,
                                d.Id AS IdDiaSemana, d.Dia
                                FROM tbTurma_has_DiaSemana hs 
                                INNER JOIN tbDiaSemana d ON d.Id = hs.IdDiaSemana
                                WHERE hs.IdTurma = ".$this->turId);

                if($dias && $dias->num_rows > 0){
                    while($rowdias = $dias->fetch_assoc()){
                        $dia = new TurmaHasDiaSemana();
                        $dia->thdId = $rowdias["Id"];
                        $dia->thdHoraInicio = $rowdias["HoraInicio"];
                        $dia->thdHoraTermino = $rowdias["HoraTermino"];
                        $dia->thdDiaSemana = new DiaSemana();
                        $dia->thdDiaSemana->disId = $rowdias["IdDiaSemana"];
                        $dia->thdDiaSemana->disDia = $rowdias["Dia"];
                        
                        $this->turHasDiaSemana[] = $dia;
                        $dia->thdTurma = $this;
                    }
                }

/***************CARREGA OS PROFESSORES DA TURMA*/
                $professores = listar("SELECT IdProfessor, Tipo FROM tbProfessor_has_Turma IdTurma WHERE IdTurma = ".$this->turId);
                if($professores && $professores->num_rows > 0){
                    while($rowprof = $professores->fetch_assoc()){
                        $tprofessor = new ProfessorHasTurma();
                        $tprofessor->phtTipo = $rowprof["Tipo"];
                        $tprofessor->phtProfessor = new Professor();
                        $tprofessor->phtProfessor->pesId = $rowprof["IdProfessor"];
                        $tprofessor->phtProfessor->carregarDados();
                        $this->turProfessorHasTurma[] = $tprofessor;
                        $tprofessor->phtTurma = $this;
                    }
                }

                return true;
            }else{
                return false;
            }
        }

		function excluirLogicamente(){
			return insere("UPDATE tbTurma SET Ativo = 0 WHERE Id = ".$this->turId);
		}

		function excluirFisicamente(){
			return insere("DELETE FROM tbTurma WHERE Id = ".$this->turId);
		}

        function listar(){
            return listar("
                SELECT t.Id, t.IdCurso, t.DataInicio, CASE WHEN t.Ativo = 0 THEN 'Inativo' ELSE 'Ativo' END Situacao, date_format(t.DataInicio, '%d/%m/%Y') DataInicioFormatada, c.Descricao AS Curso, c.Duracao
                FROM tbTurma t
                INNER JOIN tbCurso c ON c.Id = t.IdCurso");
        }

        function salvar(){
            if($this->turId > 0){
                return insere("UPDATE tbTurma SET IdCurso = ".$this->turcrsId.", DataInicio = '".$this->turDataInicio."', Ativo = ".$this->turAtivo." WHERE Id = ".addslashes($this->turId));
            }else{
                return insere("INSERT INTO tbTurma (IdCurso, DataInicio, Ativo) VALUES (".$this->turCurso->crsId.", '".$this->turDataInicio."', 1);");
            }
        }

        public function turDataInicioFormatada(){
            if($this->turDataInicio != null){
                $date = new DateTime($this->turDataInicio);
                return $date->format('d/m/Y');
                //return date('d/m/Y', strtotime($this->turDataInicio));
            }else{
                return null;
            }
        }
    }
?>