function adicionarLinha(tableID, turmaExistente) {

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var nomeiddiasemana = 'diasemana_' + rowCount;
    
    $.getJSON('diasemana-consulta.php', function(dias){
        var optionsDias = '<select class="form-control horario" idhasdia="0" name="'+nomeiddiasemana+'" id="'+nomeiddiasemana+'">'+
                                '<option value="">Selecione um dia da semana</option>';
        $.each(dias, function(i, obj){
            optionsDias += '<option value="' + obj.disId + '">' + obj.disDia + '</option>';
        })
        optionsDias += '</select><span class="msg-'+nomeiddiasemana+'"></span>';
        cell1.innerHTML = optionsDias;

        $('#'+nomeiddiasemana).addClass("obrigatorio").blur(function(){ validaCampo($(this)); });
    });

    var nomeidhorainicio = 'horainicio_' + rowCount;
    var cellhorainiciohtml = '<div class="input-group clockpicker">'+
                                    '<input type="text" name="'+ nomeidhorainicio +'" id="'+nomeidhorainicio+'" class="form-control hora obrigatorio" value="">'+
                                    '<span class="input-group-addon">'+
                                        '<span class="glyphicon glyphicon-time"></span>'+
                                    '</span>'+
                                '</div>'+
                                '<span class="msg-'+nomeidhorainicio+'"></span>';
    var cell2 = row.insertCell(1);
    cell2.innerHTML = cellhorainiciohtml;

    var nomeidhoratermino = 'horatermino_' + rowCount;
    var cellhoraterminohtml = '<div class="input-group clockpicker">'+
                                    '<input type="text" name="'+ nomeidhoratermino +'" id="'+nomeidhoratermino+'" class="form-control hora obrigatorio" value="">'+
                                    '<span class="input-group-addon">'+
                                        '<span class="glyphicon glyphicon-time"></span>'+
                                    '</span>'+
                                '</div>'+
                                '<span class="msg-'+nomeidhoratermino+'"></span>';
    var cell3 = row.insertCell(2);        
    cell3.innerHTML = cellhoraterminohtml;
    if (!turmaExistente) {
        var cellbotaohtml = '<button type="button" onClick="removerLinha(this, \'tbhorarios\')" class="btn btn-danger">' +
                                '<span class="glyphicon glyphicon-remove"></span>' +
                            '</button>';

        var cell4 = row.insertCell(3);
        cell4.innerHTML = cellbotaohtml;

        configuraCampoHora('.clockpicker');
    }
}

function removerLinha(botao, tableID) {
    swal({
            title: "Deseja realmente remover a linha?",
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

function configuraCampoHora(classecampo){
    $(classecampo).clockpicker({
        autoclose: true,
        align: 'top',
        placement: 'left',
    });

    $(".hora").attr('maxlength','5').keyup(function(){
        keyuphora($(this));
    }).blur(function(){
        validaCampo($(this));
    });
}

function setSalvar(){
    $("#botao-salvar").on('click', function(){
        var validar = true;
        if(validar){
            var contErros = 0;

            $("input, select").each(function(idx, elm){
                if(!validaCampo(elm)){
                    contErros++;
                }
            });

            if(contErros > 0){ return false;}    
        }

        var objeto = {
            Id: $("#turId").val(),
            Curso: $("#turCurso").val(),
            DataInicio: $("#turDataInicio").val(),
            ProfessorPrincipal: $("#turProfessorPrincipal").val(),
            ProfessorApoio: $("#turProfessorApoio").val(),
            Datas:[]
        }

        $('.horario').each(function(idx, elm){
            var numero = $(elm).attr('id').split("_")[1]

            var objData = {
                DiaSemana: $('#diasemana_' + numero).val(),
                HoraInicio: $('#horainicio_' + numero).val(),
                HoraTermino: $('#horatermino_' + numero).val(),
                IdHasDia: $(elm).attr('idhasdia'),
            };

            objeto.Datas.push(objData);
        })


        $.ajax({
            type: "POST",
            url: "turma-salvar.php",
            data: objeto,
            cache: false,
            success: function(data){
                if(data != null && data.success){
                    swal("Turma salva com sucesso!","","success");
                    window.setTimeout("location.href='../pages/turma-listar.php'", 1000);
                }else{
                    swal(data.message,"","error");
                }
            },
            error: function(result){
                    swal("Ocorreu um erro ao salvar a turma.");
            },
            fail: function(result){
                console.log(result);
            },
        });
    });
}

function preencheCampos(dias,horainicio,horatermino){

    for(var i = 0; i<dias.length; i++){
            adicionarLinhaRecuperada('tbhorarios',dias[i]['disDia'],horainicio[i]['HoraInicio'],horatermino[i]['HoraTermino']);
        
    }    
}

function adicionarLinhaRecuperada(tableID,dia,horainicio,horatermino) {
    
    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var nomeiddiasemana = 'diasemana_' + rowCount;
    cell1.innerHTML = '<input type="text" disabled name="' + nomeiddiasemana + '" id="' + nomeiddiasemana + '" class="form-control" value="' + dia + '">';
    

    var nomeidhorainicio = 'horainicio_' + rowCount;
    var cell2 = row.insertCell(1);
    cell2.innerHTML = '<input type="text" disabled name="' + nomeidhorainicio + '" id="' + nomeidhorainicio + '" class="form-control" value="' + horainicio + '">';

    var nomeidhoratermino = 'horatermino_' + rowCount;
    var cell3 = row.insertCell(2);        
    cell3.innerHTML = '<input type="text" disabled name="' + nomeidhoratermino + '" id="' + nomeidhoratermino + '" class="form-control" value="' + horatermino + '">';
}

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
    
    setSalvar()
    
});