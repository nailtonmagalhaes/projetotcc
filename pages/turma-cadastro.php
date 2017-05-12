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
                                        <input type="hidden" class="form-control enviarpost" name="turId" id="turId" value="'.($turma->turId > 0 ? $turma->turId : null).'">
                                    </div>
                                    <div class="form-group">
                                        <label for="turDataInicio">Data Início</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control obrigatorio datepicker enviarpost" name="turDataInicio" id="turDataInicio" value="'.$turma->turDataInicioFormatada().'"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                        <span class="msg-turDataInicio"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="turCurso">Curso</label>
                                        <select class="form-control obrigatorio enviarpost" name="turCurso" id="turCurso" style="color: gray;">
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
                                        <select class="form-control obrigatorio enviarpost" name="turProfessorPrincipal" id="turProfessorPrincipal" style="color: gray;">
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
                                        <select class="form-control obrigatorio enviarpost" name="turProfessorApoio" id="turProfessorApoio" style="color: gray;">
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
                                                            <select class="form-control horario" name="diasemana[]" id="diasemanaid_1">
                                                                <option value="">Selecione um dia da semana</option>';
                                                                if($dias && $dias->num_rows > 0){
                                                                    foreach($dias as $dia){
                                                                        echo '<option value="'.$dia["Id"].'">'.utf8_encode($dia["Dia"]).'</option>';
                                                                    }
                                                                }
                                                            echo '</select>
                                                        </td>
                                                        <td>
                                                            <div class="input-group clockpicker">
                                                                <input type="text" name="hora[]" id="horainicioid_1" class="form-control hora" value="">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group clockpicker">
                                                                <input type="text" name="hora[]" id="horaterminoid_1" class="form-control hora" value="">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-time"></span>
                                                                </span>
                                                            </div>
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


<script>    

    function adicionarLinha(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        
        $.getJSON('diasemana-consulta.php', function(dias){
            var optionsDias = '<select class="form-control horario" name="diasemana[]" id="diasemanaid_'+rowCount+'">'+
                                    '<option value="">Selecione um dia da semana</option>';
            $.each(dias, function(i, obj){
                optionsDias += '<option value="' + obj.disId + '">' + obj.disDia + '</option>';
            })
            optionsDias += '</select>';
            cell1.innerHTML = optionsDias;
        });

        var cellhorainiciohtml = '<div class="input-group clockpicker">'+
                                    '<input type="text" name="hora[]" id="horainicioid_'+rowCount+'" class="form-control hora " value="">'+
                                    '<span class="input-group-addon">'+
                                        '<span class="glyphicon glyphicon-time"></span>'+
                                    '</span>'+
                                '</div>';

        var cellhoraterminohtml = '<div class="input-group clockpicker">'+
                                        '<input type="text" name="hora[]" id="horaterminoid_'+rowCount+'" class="form-control hora " value="">'+
                                        '<span class="input-group-addon">'+
                                            '<span class="glyphicon glyphicon-time"></span>'+
                                        '</span>'+
                                    '</div>';
        var cell2 = row.insertCell(1);
        cell2.innerHTML = cellhorainiciohtml;
        var cell3 = row.insertCell(2);        
        cell3.innerHTML = cellhoraterminohtml;

        var cellbotaohtml = '<button type="button" onClick="removerLinha(this, \'tbhorarios\')" class="btn btn-danger">'+
                                '<span class="glyphicon glyphicon-remove"></span>'+
                            '</button>';  

        var cell4 = row.insertCell(3);
        cell4.innerHTML = cellbotaohtml;   

        configuraCampoHora('.clockpicker');
    }

    function removerLinha(botao, tableID) {
        swal({
			  title: "Deseja realmente excluir a linha?",
			  text: "Clique em Sim para confirmar ou em Não para cancelar!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Sim",
			  cancelButtonText: "Não",
			  closeOnConfirm: true
        },
        function(){
                try {                 /*td*/     /*tr*/
                var row = botao.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }catch(e) {
                alert(e);
            }
        });      
    }

    function definirMascaraHora(campo){
        var conteudo = campo.val();
        conteudo = conteudo.replace(/\D/g,"");					 //Remove tudo o que não é dígito
        conteudo = conteudo.replace(/(\d)(\d{2})$/,"$1:$2");    //Coloca barra entre o segundo e o terceiro dígitos
        campo.val(conteudo);
    }

    function configuraCampoHora(classecampo){
        $(classecampo).clockpicker({
            autoclose: true,
            align: 'top',
            placement: 'left',
        });

        $(".hora").keyup(function(){
            definirMascaraHora($(this));
            $(this).attr('maxlength','5');
        });
    }

    $("#botao-salvar").on('click', function(){

        var campos ='';
        var outroscampos = '';

        $('.enviarpost').each(function(idx, elm){
            outroscampos += '&'+$(elm).attr('name') +'&'+$(elm).val();
        })
        

        $('.horario').each(function(idx,elm){

            var numero = $(elm).attr('id').split("_")[1]

            console.log(numero)

            //campos += 'LL&diasemanaid_'+numero+'='+$('#diasemanaid_'+numero).val()+'&horainicioid_'+numero+'='+$('#horainicioid_'+numero).val()+'&horaterminoid_'+numero+'='+$('#horaterminoid_'+numero).val()
            campos += 'LL'+$('#diasemanaid_'+numero).val()+'&'+$('#horainicioid_'+numero).val()+'&'+$('#horaterminoid_'+numero).val();

        })

        console.log(campos)

        $.post("turma-salvar.php", {campos:campos, outroscampos:outroscampos}, function(data){
            if(data){
                swal("Curso excluído com sucesso!","","success");
                window.setTimeout("location.href='../pages/curso-listar.php'", 2000);
            }else{
                swal("Error",data,"warning");
            }
        });      
    });
    
    $(document).ready(function(){

        configuraCampoHora('.clockpicker');        

        $("select").change(function(){
            var campo = $(this);
            if(campo.val() == "" || campo.val() == "0"){
                campo.css("color", "gray");
            }else{
                campo.css("color", "#000");
            }
        });

        $('.input-group.date').datepicker({
            format: "dd/mm/yyyy",
            startDate: '0',
            language: "pt-BR",
            autoclose: true,
            clearBtn: true,
            todayHighlight: true,
            calendarWeeks: true,
        });
    });
</script>


