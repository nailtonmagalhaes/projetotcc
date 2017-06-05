<?php
include_once 'valida-sessao.php';
include_once 'tipo-avaliacao.php';

class Avaliacao{
    public $avaId;
    public $avaMatricula;       /*Matricula*/
    public $avaData;
    public $avaTipo;            /*ETipoAvaliacao*/
    public $avaAtivo;

    public function __construct(){
        $this->avaId = 0;
        $this->avaMatricula = null;
        $this->avaData = null;
        $this->avaTipo = ETipoAvaliacao::Normal;
        $this->avaAtivo = 1;
    }

    public function dataFormatada(){
        if(empty($this->avaData)){
            return "";
        }else{
            return date('d/m/Y', strtotime($this->avaData));
        }
    }

    public function listar(){
        try
        {
        	return AcessoDados::listar("SELECT a.Id, a.IdMatricula, date_format(a.DataAvaliacao, '%d/%m/%Y') AS Data, CASE WHEN a.Tipo = 2 THEN 'Exame' ELSE 'Normal' END AS Tipo, a.Ativo, CASE WHEN COALESCE(a.Ativo, 1) = 1 THEN 'Ativo' ELSE 'Inativo' END Situacao,
										p.Nome AS Aluno, m.NumeroMatricula AS Matricula,
                                        c.Descricao AS Curso
                                        FROM tbAvaliacao a
                                        INNER JOIN tbMatricula m ON m.Id = a.IdMatricula
                                        INNER JOIN tbPessoa p ON p.Id = m.IdAluno
                                        INNER JOIN tbTurma t ON t.Id = m.IdTurma
                                        INNER JOIN tbCurso c ON c.Id = t.IdCurso
                                        ORDER BY a.DataAvaliacao");
        }
        catch (Exception $e)
        {
            throw new Exception("Erro ao listar as avaliações.\n{$e->getMessage()}");
        }        
    }

    public function listarPorMatricula($idMatricula){
        try
        {
        	return AcessoDados::listar("SELECT Id, IdMatricula, DataAvaliacao, Tipo, Ativo, CASE WHEN COALESCE(Ativo, 1) = 1 THEN 'Ativo' ELSE 'Inativo' END Situacao 
                                        FROM tbAvaliacao WHERE IdMatricula = {$this->avaMatricula->matId} ORDER BY DataAvaliacao");
        }
        catch (Exception $e)
        {
            throw new Exception("Erro ao listar as avaliações.\n{$e->getMessage()}");
        }
    }

    public function carregarDados(){
        try
        {
        	$resultado = AcessoDados::listar("SELECT Id, IdMatricula, DataAvaliacao, Tipo, Ativo FROM tbAvaliacao WHERE Id = {$this->avaId}");
            if($resultado && $resultado->num_rows > 0){
                $row = $resultado->fetch_assoc();
                $this->avaAtivo = $row['Ativo'];
                $this->avaData = $row['DataAvaliacao'];
                $this->avaTipo = $row['Tipo'];
                $this->avaMatricula = new Matricula();
                $this->avaMatricula->matId = $row['IdMatricula'];
                $this->avaMatricula->carregarDados();
                return true;
            }
            return false;
        }
        catch (Exception $e)
        {
            throw new Exception("Erro ao carregar os dados.\n{$e->getMessage()}");
        }
        
    }

    public function salvarDados(){
        try
        {
            AcessoDados::abreTransacao();
        	if($this->avaId > 0){
                AcessoDados::inserir("UPDATE tbAvaliacao SET IdMatricula = {$this->avaMatricula->matId}, DataAvaliacao = '{$this->avaData}', Tipo = {$this->avaTipo}, Ativo = {$this->avaAtivo} WHERE Id = {$this->avaId}");
            }else{
                AcessoDados::alterar("INSERT INTO tbAvaliacao(IdMatricula, DataAvaliacao, Tipo, Ativo) VALUES ({$this->avaMatricula->matId}, '{$this->avaData}', {$this->avaTipo}, 1)"); 
            }
            AcessoDados::confirmaTransacao();
            return true;
        }
        catch (Exception $e)
        {
            throw new Exception("Erro ao salvar os dados da avaliação.\n".$e->getMessage());
        }
    }
    
    public function excluirLogicamente(){
        try
        {
        	AcessoDados::abreTransacao();
            AcessoDados::alterar("UPDATE tbAvaliacao SET Ativo = 0 WHERE Id = {$this->avaId}");
            AcessoDados::confirmaTransacao();
            return true;
        }
        catch (Exception $e)
        {
            throw new Exception("Erro ao inativar a avaliação.\n{$e->getMessage()}");
        }        
    }

    public function excluirFisicamente(){
        
    }
}

?>