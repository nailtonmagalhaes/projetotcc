<?php
$consultaTurma = "select
t.id as CodigoTurma, date(t.DataInicio), c.Descricao as Curso, d.Dia, time(hd.HoraInicio) HoraInicio, time (hd.HoraTermino) HoraTermino,
(select p.Nome from tbprofessor_has_turma pht inner join tbpessoa p on p.id = pht.IdProfessor where pht.IdTurma = t.id and pht.Tipo = 1) ProfessorPrincipal,
(select p.Nome from tbprofessor_has_turma pht inner join tbpessoa p on p.id = pht.IdProfessor where pht.IdTurma = t.id and pht.Tipo = 2) ProfessorApoio
from tbTurma t
inner join tbcurso c on c.Id = t.idcurso
inner join tbturma_has_diasemana hd on t.id = hd.IdTurma
inner join tbdiasemana d on d.Id = hd.IdDiaSemana
";
    include_once 'professor-has-turma.php';
    include_once 'turma-has-dia-semana.php';
    include_once 'matricula.php';
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
            $resultado = AcessoDados::listar("SELECT Id, IdCurso, DataInicio, Ativo, date_format(DataInicio, '%d/%m/%Y') DataInicioFormatada FROM tbTurma WHERE Id = ".$this->turId);
           
/***************CARREGA OS DADOS DA TURMA*/
            if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();                                                                                                                   
                $this->turId = $row["Id"];
                $this->turDataInicio = $row["DataInicio"];
                $this->turCurso = new Curso();
                $this->turCurso->crsId = $row["IdCurso"];
                $this->turCurso->carregarDados();

/***************CARREGA OS DIAS DA SEMANA DA TURMA*/
                $dias = AcessoDados::listar("SELECT Id, IdDiaSemana, HoraInicio, HoraTermino FROM tbTurma_has_DiaSemana WHERE IdTurma = ".$this->turId);

                if($dias && $dias->num_rows > 0){
                    while($rowdias = $dias->fetch_assoc()){
                        $dia = new TurmaHasDiaSemana();
                        $dia->thdId = $rowdias["Id"];
                        $dia->thdHoraInicio = $rowdias["HoraInicio"];
                        $dia->thdHoraTermino = $rowdias["HoraTermino"];
                        $dia->thdDiaSemana = new DiaSemana();
                        $dia->thdDiaSemana->disId = $rowdias["IdDiaSemana"];
                        $dia->thdDiaSemana->carregarDados();
                        $dia->thdTurma = $this;
                        $this->turHasDiaSemana[] = $dia;      
                    }
                }

/***************CARREGA OS PROFESSORES DA TURMA*/
                $professores = AcessoDados::listar("SELECT pht.IdProfessor, pht.Tipo FROM tbProfessor_has_Turma pht WHERE pht.IdTurma = ".$this->turId);
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

        function listar($query=null){
            $where = "";
                    
            if(isset($query)){
                $where = "WHERE
                                c.Descricao LIKE '%{$query}%'
                                OR prof.Nome LIKE '%{$query}%'
                                

                 ";
            }
            
            return AcessoDados::listar("  
            SELECT 
                t.Id
                , t.IdCurso
                , t.DataInicio
                , (CASE WHEN t.Ativo = 0 THEN 'Inativo' ELSE 'Ativo' END) as Situacao
                , date_format(t.DataInicio, '%d/%m/%Y') as DataInicioFormatada
                , c.Descricao AS Curso
                , c.Duracao
                , group_concat(DISTINCT ds.Dia, ',') as Dias
                , prof.Nome
            FROM 
                    tbTurma t
                LEFT JOIN tbCurso c ON (c.Id = t.IdCurso)
                LEFT JOIN tbTurma_has_DiaSemana tds ON(tds.IdTurma = t.Id)
                LEFT JOIN tbDiaSemana ds ON(ds.Id = tds.IdDiaSemana)
                LEFT JOIN tbProfessor_has_Turma tp ON(tp.IdTurma = t.Id AND tp.Tipo = 1)
                LEFT JOIN tbPessoa prof ON(prof.Id = tp.IdProfessor)
            {$where}
            GROUP BY
                    t.Id
                , t.IdCurso
                , t.DataInicio
                , t.Ativo
                , t.DataInicio
                , c.Descricao
                , c.Duracao
                , prof.Nome");
            
        }

        function salvarDados(){
            try{
                AcessoDados::abreTransacao();
                $sucesso = false;
                if($this->turId > 0){
                    $sucesso = AcessoDados::alterar("UPDATE tbTurma SET IdCurso = ".$this->turCurso->crsId.", DataInicio = '".$this->turDataInicio."', Ativo = ".$this->turAtivo." WHERE Id = ".$this->turId);
                }else{
                    $this->turId = AcessoDados::inserir("INSERT INTO tbTurma (IdCurso, DataInicio, Ativo) VALUES (".$this->turCurso->crsId.", '".$this->turDataInicio."', 1);");
                    $sucesso = $this->turId > 0;
                }

                if($sucesso){
                    
                    $turma = new TurmaHasDiaSemana;
                    $turma->removeDados($this->turId);
                    
                    foreach($this->turHasDiaSemana as $dia){
                        $dia->thdTurma = $this;
                        $sucesso = $dia->salvarDados();
                        
                    }
                    
                    $professor = new ProfessorHasTurma;
                    $professor->removeDados($this->turId);
                    
                    
                    foreach($this->turProfessorHasTurma as $prof){
                        $prof->phtTurma = $this;
                        $sucesso = $prof->salvarDados();
                        
                    }                    
                }
                AcessoDados::confirmaTransacao();
              
                return $sucesso;
            }catch(Exception $ex){
                throw new Exception("Ocorreu um erro ao salvar os dados.<br>".$ex->getMessage());
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
        
        public function calculaDiasTurma($dias,$hora,$duracaoCurso,$dataInicio){
            try{
              $dataInicio = explode("/", $dataInicio);
              $dataInicio = $dataInicio[2]."-".$dataInicio[1]."-".$dataInicio[0];

              $sqlDatas = "SELECT
                          dte
                      ,DAYOFWEEK(dte)
                  FROM
                          (

                        SELECT 
                            '".$dataInicio."' + INTERVAL a + b DAY dte
                        FROM
                            (SELECT 0 a 
                            UNION SELECT 1 a 
                             UNION SELECT 2 
                             UNION SELECT 3
                             UNION SELECT 4 
                             UNION SELECT 5 
                             UNION SELECT 6 
                             UNION SELECT 7
                             UNION SELECT 8 
                             UNION SELECT 9 ) d,
                            (SELECT 0 b 
                             UNION SELECT 10 
                             UNION SELECT 20 
                             UNION SELECT 30 
                             UNION SELECT 40
                             UNION SELECT 50
                             UNION SELECT 60
                             UNION SELECT 70
                             UNION SELECT 80
                             UNION SELECT 90
                             UNION SELECT 100
                             UNION SELECT 110
                             UNION SELECT 120
                             UNION SELECT 130
                             UNION SELECT 140
                             UNION SELECT 150
                             UNION SELECT 160
                             UNION SELECT 170
                             UNION SELECT 180
                             UNION SELECT 190
                             UNION SELECT 200
                             UNION SELECT 210
                             UNION SELECT 220
                             UNION SELECT 230
                             UNION SELECT 240
                             UNION SELECT 250
                             UNION SELECT 260
                             UNION SELECT 270
                             UNION SELECT 280
                             UNION SELECT 290
                             UNION SELECT 300
                             UNION SELECT 310
                             UNION SELECT 320
                             UNION SELECT 330
                             UNION SELECT 340
                             UNION SELECT 350
                             UNION SELECT 360
                             ) m
                        WHERE 
                            '".$dataInicio."' + INTERVAL a + b DAY  <  '2017-07-01'
                        ORDER BY 
                            a + b

                      ) as t";
  //            echo '<pre>';
              
              
              $dadosDatas = AcessoDados::listar($sqlDatas);
              
              $dadosDatas = $dadosDatas->fetch_all();
              
  //            var_dump($dias);die;
              
  //            echo '<pre>';
              
              $datas_uteis;
              $dia_semana;
              
              foreach ($dadosDatas as $key => $value) {
  //                var_dump($key,$value);
                  if(in_array($value[1], $dias)){
                      $datas_uteis[] = $value[0];
                      $dia_semana[] = $value[1];
                  }
              }
  //            var_dump($dia_semana);die;
              $tempo = 0.00;
  //            var_dump($hora);die;
              foreach ($hora as $key => $value) {
                  $horas = explode( ":", $value["hora"] );
                  
                  
  //                var_dump($tempo);
                  $tempo = $tempo+($horas[0]+round(($horas[1]/60),2));
  //                var_dump($tempo);
              }
              
              
              
              $dias_uteis = round($duracaoCurso/$tempo);
  //            var_dump($tempo);
  //            die;
              
              for ($index = count($datas_uteis); $index >= $dias_uteis; $index--) {
  //                var_dump($index,$datas_uteis[$index]);
                  unset($datas_uteis[$index]);
                  unset($dia_semana[$index]);
              }
              
  //            var_dump($dias_uteis);
  //            var_dump($datas_uteis);
  //            var_dump(count($datas_uteis));
  //        echo '<pre>';
              $retorno[] = $datas_uteis;
              $retorno[] = $dia_semana;
              
  //            var_dump($retorno);die;
              return $retorno;
  //            var_dump($dias, $duracaoCurso);
  //            die;
            }catch(Exception $e){
              throw $e;
            }
            
        }
        
        public function getDados(){
            $resultado = AcessoDados::listar("SELECT tma.Id, IdCurso, DataInicio, tma.Ativo, date_format(DataInicio, '%d/%m/%Y') DataInicioFormatada ,cur.Descricao FROM tbTurma tma LEFT JOIN tbCurso cur ON(cur.Id = tma.IdCurso) WHERE tma.Id = ".$this->turId);
            
            
/***************CARREGA OS DADOS DA TURMA*/
            if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();                                                                                                                   
                $this->turId = $row["Id"];
                $this->turDataInicio = $row["DataInicio"];
                $this->turCurso = new Curso();
                $this->turCurso->crsId = $row["IdCurso"];
                $this->turCurso->carregarDados();

/***************CARREGA OS DIAS DA SEMANA DA TURMA*/
//                $dias = AcessoDados::listar("SELECT Id, IdDiaSemana, HoraInicio, HoraTermino FROM tbTurma_has_DiaSemana WHERE IdTurma = ".$this->turId);
                  $dias = AcessoDados::listar("SELECT DISTINCT 1 as Id, IdDiaSemana,TIME_FORMAT(HoraInicio, '%h:%i') as HoraInicio,TIME_FORMAT(HoraTermino, '%h:%i') as HoraTermino FROM tbTurma_has_DiaSemana WHERE IdTurma = ".$this->turId);

                if($dias && $dias->num_rows > 0){
                    while($rowdias = $dias->fetch_assoc()){
                        $dia = new TurmaHasDiaSemana();
                        $dia->thdId = $rowdias["Id"];
                        $dia->thdHoraInicio = $rowdias["HoraInicio"];
                        $dia->thdHoraTermino = $rowdias["HoraTermino"];
                        $dia->thdDiaSemana = new DiaSemana();
                        $dia->thdDiaSemana->disId = $rowdias["IdDiaSemana"];
                        $dia->thdDiaSemana->carregarDados();
                        $dia->thdTurma = $this;
                        $this->turHasDiaSemana[] = $dia;      
                    }
                }

/***************CARREGA OS PROFESSORES DA TURMA*/
                $professores = AcessoDados::listar("SELECT pht.IdProfessor, pht.Tipo FROM tbProfessor_has_Turma pht WHERE pht.IdTurma = ".$this->turId." ORDER BY pht.Tipo DESC");
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
    }
?>