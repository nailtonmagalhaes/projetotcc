<?php 
    include_once "permissao-secretaria.php";
    include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'turma.php';

    $turma = new Turma();
    $cursos = Curso::listar();
    $professor = new Professor();
    $dias = DiaSemana::listar();
    $professores = $professor->listar();

	if(isset($_GET['id'])){
        $turma->turId = $_GET['id'];
		$turma->getDados();
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
    <head>
        <script type="text/javascript" src="../js/js-validacao-generica.js"></script>
        <script type="text/javascript" src="../js/turma/turma.js"></script>
        <!--<script type="text/javascript" src="../js/utils.js"></script>-->
    </head>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-header">'.($turma->turId > 0 ? "Alteração" : "Cadastro").'</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        '.($turma->turId > 0 ? "Alterar Turma" : "Cadastrar Turma").'
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" id="formcadastrar" action="turma-salvar.php" method="post">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="turId" id="turId" value="'.($turma->turId > 0 ? $turma->turId : null).'">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="turDataInicio">Data Início</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control obrigatorio datepicker data" name="turDataInicio" id="turDataInicio" value="'.$turma->turDataInicioFormatada().'"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                        <span class="msg-turDataInicio"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="turCurso">Curso</label>
                                        <select class="form-control obrigatorio" name="turCurso" id="turCurso" style="color: gray;">
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
                                        <select class="form-control obrigatorio" name="turProfessorPrincipal" id="turProfessorPrincipal" style="color: gray;">
                                            <option value="">Selecione um professor</option>';
                                            try{
//                                                var_dump($turma->turProfessorHasTurma[0]->phtProfessor->pesId);
                                                if ($professores && $professores->num_rows > 0) {
                                                    foreach($professores as $key => $prof1 ){
                                                        $idp1 = $prof1["Id"];
                                                        $nomep1 = $prof1["Nome"];
//                                                        echo '<pre>';
//                                                        var_dump($idp1 == $turma->turProfessorHasTurma[0]->phtProfessor->pesId);
//                                                        $turma->turProfessorHasTurma[0]->phtProfessor->pesId
                                                        echo '<option value="'.$idp1.'"'.'>'.$nomep1.'</option>';   
                                                    }   
//                                                    die;
                                                }
                                            } catch (Exception $e) {
                                                echo $e->getMessage();
                                            }
                                        echo '</select>
                                        <span class="msg-turProfessorPrincipal"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="turProfessorApoio">Professor Apoio</label>
                                        <select class="form-control obrigatorio" name="turProfessorApoio" id="turProfessorApoio" style="color: gray;">
                                            <option value="">Selecione um professor</option>';
                                            try{
                                                if ($professores && $professores->num_rows > 0) {
                                                    foreach($professores as $key => $prof2){
                                                        $idp2 = $prof2["Id"];
                                                        $nomep2 = $prof2["Nome"];
                                                        echo '<option value="'.$idp2.'"'.'>'.$nomep2.'</option>';   
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
                                                <tbody>';
                                                    
                                                    foreach($turma->turHasDiaSemana as $dia){

                                                    }
                                                echo '</tbody>
                                            </table>
                                        </div>
                                    </div> 
                                    <div class="form-group">                                   
                                        <button type="button" class="btn btn-primary" id="botao-salvar">
                                            <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                                        </button>
                                        <button type="reset" class="btn btn-default">
                                            <span class="glyphicon glyphicon-erase"> Limpar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    ';
                     
    $dados_dia;
    $dados_inic;
    $dados_term;

    foreach($turma->turHasDiaSemana as $dia){
        $dados_dia[]['disId'] = $dia->thdDiaSemana->disId;
        $dados_inic[]['HoraInicio'] = $dia->thdHoraInicio;
        $dados_term[]['HoraTermino'] = $dia->thdHoraTermino;
    }
    if($turma->turId > 0){ ?>
        <script>  
            $(document).ready(function(){
                var arr1 = <?php echo json_encode($dados_dia); ?>;
                var arr2 = <?php echo json_encode($dados_inic); ?>;
                var arr3 = <?php echo json_encode($dados_term); ?>;
                
                $('#turProfessorPrincipal').val(<?php echo $turma->turProfessorHasTurma[1]->phtProfessor->pesId ?>)
                $('#turProfessorApoio').val(<?php echo $turma->turProfessorHasTurma[0]->phtProfessor->pesId ?>)
                
                preencheCampos(arr1,arr2,arr3);
                
                if(!arr1){
                    adicionarLinha('tbhorarios');
                }
            });    
        </script>
    <?php }
?>


