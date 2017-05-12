<?php 
	include_once "menu.php";
    include_once 'includes.php';

    $turma = new Turma();
    $cursos = Curso::listar();
    $professor = new Professor();
    $dias = DiaSemana::listar();
    $professores = $professor->listar();

	if(isset($_GET['id'])){
        $turma->turId = $_GET['id'];
		$turma->carregarDados();
	}

/*
    echo "<br>------------------------------------------------------------------- fetch_assoc: ".print_r($professores->fetch_assoc());
    echo "<br>------------------------------------------------------------------- no fetch_assoc: ".print_r($professores);

    foreach($turma->turProfessorHasTurma as $p){
        echo "</br>-------------------------------------------------------------- PROFESSOR: ".$p->phtProfessor->pesNome;  
        echo "</br>-------------------------------------------------------------- TIPO: ".$p->phtTipoDescricao();  
    }

    print_r($professores);

    foreach($professores as $p1){
        echo "</br>--------------------------------------------------------------COMBO PROFESSOR: ".$p1["Nome"];  
        echo "</br>--------------------------------------------------------------COMBO ID: ".($p1["Id"]);  
    }
*/
    echo '    
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">'.($turma->turId > 0 ? "Alteração" : "Cadastro").'</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        '.($turma->turId > 0 ? "Alterar Turma" : "Cadastrar Turma").'
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <form role="form" id="formcadastrar" action="turma-salvar.php" method="post">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control campos" name="turId" id="turId" value="'.($turma->turId > 0 ? $turma->turId : null).'">
                                    </div>
                                    <div class="form-group">
                                        <label for="turDataInicio">Data Início</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control obrigatorio datepicker campos" name="turDataInicio" id="turDataInicio" value="'.$turma->turDataInicioFormatada().'"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                        <span class="msg-turDataInicio"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="turCurso">Curso</label>
                                        <select class="form-control obrigatorio campos" name="turCurso" id="turCurso" style="color: gray;">
                                            <option value="">Selecione um curso</option>';
                                            try{
                                                if ($cursos && $cursos->num_rows > 0) {
                                                    while($row = $cursos->fetch_assoc()){
                                                        $idc = $row["Id"];
                                                        $desc = $row["Descricao"];
                                                        echo '<option value="'.$idc.'"'.($idc == $turma->turCurso->crsId ? "selected" : null).'>'.$desc.'</option>';   
                                                    }   
                                                }
                                            } catch (Exception $e) {
                                                echo $e->getMessage();
                                            }
                                        echo '</select>
                                        <span class="msg-turCurso"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="turProfessorPrincipal">Professor Principal</label>
                                        <select class="form-control obrigatorio campos" name="turProfessorPrincipal" id="turProfessorPrincipal" style="color: gray;">
                                            <option value="">Selecione um professor</option>';
                                            try{
                                                if ($professores && $professores->num_rows > 0) {
                                                    foreach($professores as $prof1){
                                                        $idp1 = $prof1["Id"];
                                                        $nomep1 = $prof1["Nome"];
                                                        echo '<option value="'.$idp1.'"'.($idp1 == $turma->turProfessorHasTurma->phtProfessor->pesId ? "selected" : null).'>'.$nomep1.'</option>';   
                                                    }   
                                                }
                                            } catch (Exception $e) {
                                                echo $e->getMessage();
                                            }
                                        echo '</select>
                                        <span class="msg-turProfessorPrincipal"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="turProfessorApoio">Professor Apoio</label>
                                        <select class="form-control obrigatorio campos" name="turProfessorApoio" id="turProfessorApoio" style="color: gray;">
                                            <option value="">Selecione um professor</option>';
                                            try{
                                                if ($professores && $professores->num_rows > 0) {
                                                    foreach($professores as $prof2){
                                                        $idp2 = $prof2["Id"];
                                                        $nomep2 = $prof2["Nome"];
                                                        echo '<option value="'.$idp2.'"'.($idp2 == $turma->turProfessorApoio->pesId ? "selected" : null).'>'.$nomep2.'</option>';   
                                                    }   
                                                }
                                            } catch (Exception $e) {
                                                echo $e->getMessage();
                                            }
                                        echo '</select>
                                        <span class="msg-turProfessorApoio"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="text-align: center;">
                                                <label>Dias e Horários</label>
                                            </div>
                                            <div style="padding: 3px">
                                                <button type="button" onClick="adicionarLinha(\'tbhorarios\')" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-plus"></span> Adicionar
                                                </button>
                                            </div>
                                            <table class="table table-striped" id="tbhorarios" name="tbhorarios">
                                                <thead>
                                                    <tr>
                                                        <th>Dia da Semana</th>
                                                        <th>Hora Início</th>
                                                        <th>Hora Término</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control horario obrigatorio" name="diasemana_1" id="diasemana_1">
                                                                <option value="">Selecione um dia da semana</option>';
                                                                if($dias && $dias->num_rows > 0){
                                                                    foreach($dias as $dia){
                                                                        echo '<option value="'.$dia["Id"].'">'.utf8_encode($dia["Dia"]).'</option>';
                                                                    }
                                                                }
                                                            echo '</select>
                                                            <span class="msg-diasemana_1"></span>
                                                        </td>
                                                        <td>
                                                            <div class="input-group clockpicker">
                                                                <input type="text" name="horainicio_1" id="horainicio_1" class="form-control hora obrigatorio" value="">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>                                                            
                                                            <span class="msg-horainicio_1"></span>
                                                        </td>
                                                        <td>
                                                            <div class="input-group clockpicker">
                                                                <input type="text" name="horatermino_1" id="horatermino_1" class="form-control hora obrigatorio" value="">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>
                                                            <span class="msg-horatermino_1"></span>
                                                        </td>
                                                        <td>
                                                            <button type="button" onClick="removerLinha(this, \'tbhorarios\')" class="btn btn-danger">
                                                                <span class="glyphicon glyphicon-remove"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                                    
                                    <button type="button" class="btn btn-primary" id="botao-salvar">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                                    </button>
                                    <button type="reset" class="btn btn-default">
                                        <span class="glyphicon glyphicon-erase"> Limpar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
?>

<script type="text/javascript" src="../js/js-validacao-generica.js"></script>
<script type="text/javascript" src="../js/turma/turma.js"></script>


<script>    

    
</script>


