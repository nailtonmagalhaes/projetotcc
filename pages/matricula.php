<?php
    include_once 'valida-sessao.php';
    include_once 'turma.php';
    include_once 'aluno.php';
    
    class Matricula{
        public $matId;
        public $matAluno;
        public $matTurma;
        public $matNumero;
        public $matAtivo;
        public $matAvaliacoes; /*Avaliacao*/

        public function __construct(){
            $this->matId = 0;
            $this->matAluno = null;
            $this->matTurma = null;
            $this->matNumero = 0;
            $this->matAtivo = 1;
            $this->matAvaliacoes = array();
        }

        public function listar(){
			return AcessoDados::listar("SELECT
                                                        mat.Id as IdMatricula
                                                        ,tma.Id as IdTurma
                                                        ,cur.Descricao as Curso
                                                        ,DATE_FORMAT( tma.DataInicio , '%d/%m/%Y' ) as DataInicio
                                                        ,pes.Nome
                                                       ,(CASE WHEN COALESCE(mat.Ativo, 1) = 1 THEN 'Ativo' ELSE 'Inativo' END) as Situacao
                                                    FROM
                                                        tbMatricula mat
                                                        INNER JOIN tbPessoa pes ON(pes.Id = mat.IdAluno)
                                                        INNER JOIN tbTurma tma ON(tma.Id = mat.IdTurma)
                                                        INNER JOIN tbCurso cur ON(cur.Id = tma.IdCurso)
                                                    ORDER BY
                                                            mat.Id ASC");
        }

        public function listarPorTurma($idTurma){

        }

        public static function carregarCombo(){
            try
            {
            	return AcessoDados::listar("SELECT m.Id, concat(a.Nome, ' | ', c.Descricao, ' | ', m.NumeroMatricula) AS Descricao FROM tbMatricula m
                                            INNER JOIN tbPessoa a ON a.Id = m.IdAluno
                                            INNER JOIN tbTurma t ON t.Id = m.IdTurma
                                            INNER JOIN tbCurso c ON c.Id = t.IdCurso");
            }
            catch (Exception $e)
            {
                throw new Exception("Erro ao listar as matriculas.\n{$e->getMessage()}");
            }            
        }

        public function carregarDados(){

        }

        public function salvarDados(){
               
                AcessoDados::abreTransacao();
                        
                $sucesso = false;

                try{
                    if($this->matId > 0){
                        $sucesso = AcessoDados::alterar("UPDATE tbMatricula SET IdAluno = '".$this->matAluno."', IdTurma = ".$this->matTurma.", NumeroMatricula = '".$this->matNumero."' WHERE Id = ".$this->matId);
                    }else{
//                                    var_dump("INSERT INTO tbMaterial (Descricao, Ano, Link, Ativo) VALUES ('".$this->matDescricao."', ".$this->matAno.", '".$this->matLink."', ".$this->matAtivo.")");die;
                        $sucesso = AcessoDados::inserir("INSERT INTO tbMatricula (IdAluno,IdTurma,NumeroMatricula,Ativo) VALUES ('".$this->matAluno."', ".$this->matTurma.", '".$this->matNumero."', ".$this->matAtivo.")");

                        if($sucesso>0){
                            $sucesso = true;
                        }
                    }
                    AcessoDados::confirmaTransacao();

                    return $sucesso;

                } catch (Exception $exc) {
    //                echo $exc->getTraceAsString();
                    throw new Exception("Ocorreu um erro ao salvar os dados.\n".$exc->getMessage());
                }
                
        }

        public function excluirLogicamente(){
                AcessoDados::abreTransacao();

                $sucesso = false;

                try{

                    $sucesso = AcessoDados::alterar("UPDATE tbMatricula SET Ativo = 0 WHERE Id = ".$this->matId);

                     AcessoDados::confirmaTransacao();

                     return $sucesso;

                } catch (Exception $ex) {

                    throw new Exception("Ocorreu um erro ao salvar os dados.\n".$ex->getMessage());

                }
        }

        public function excluirFisicamente(){
            
        }
    }
?>