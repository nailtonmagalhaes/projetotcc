//Função que mostra ou oculta a div de segundo endereço
function mostrarEnderecoSecundario(elm){
    var valor = elm.checked;
    var comp = document.getElementById("pnenderecosecundario");
    if(valor){
        comp.style.display = 'block';
        $("#pnenderecosecundario input, #pnenderecosecundario select").each(function(idx, elm){
            $(elm).addClass("obrigatorio");
        });
    }else{
        comp.style.display = 'none';
        $("#pnenderecosecundario input, select").each(function(idx, elm){
            $(elm).removeClass("obrigatorio");
        });
    }
};


$(document).ready(function(){

    // Função que será acionada quando o campo CEP do endereço 1 perder o foco
    $('#alnCep_1').blur(function(){
        return carregaCep($(this), $('#alnLogradouro_1'), $("#alnCidade_1"), $("#alnEstado_1"),$('#alnBairro_1'), $('#alnNumeroCasa_1'));
    })
    
    // Função que será acionada quando o campo CEP do endereço 2 perder o foco
    $('#alnCep_2').blur(function(){
        return carregaCep($(this), $('#alnLogradouro_2'), $("#alnCidade_2"), $("#alnEstado_2"),$('#alnBairro_2'), $('#alnNumeroCasa_2'));
    })

    function carregaCep(cpcep, cplog, cpcid, cpest, cpbair, cpnum){
        if(!isCEP(cpcep.val())) return;
        
        /* Configura a requisição AJAX */
        $.ajax({
            url : 'consultar_cep.php', /* URL que será chamada */ 
            type : 'POST', /* Tipo da requisição */ 
            data: 'cep=' + cpcep.val().replace(/\D/g, ''), /* dado que será enviado via POST */
            dataType: 'json', /* Tipo de transmissão */
            success: function(data){
                if(data.sucesso >= 1){
                    cplog.val(data.rua.toUpperCase());
                    cpbair.val(data.bairro.toUpperCase());

                    $(cpest[0].options).each(function(){
                        var estCorrente = $(this).attr("estado");
                        var selecionar = estCorrente != null && estCorrente.toUpperCase() == data.estado.toUpperCase();
                        $(this).prop("selected", selecionar);
                    });

                    var estadoSelecionado = cpest.val(); 
                    
                    carregaCidade(cpcid, estadoSelecionado, data.cidade);

                    cpnum.focus();
                }else{
                    var cxmsg = document.querySelector('msg-'+cpest.attr('name'));
                    if(cxmsg != null){
                        caixa_msg.innerHTML = "CEP não encontrado";
                        caixa_msg.style.display = "block";
                        caixa_msg.style.color = "#D2691E";
                    }
                }
            },
            error: function(dataerror){
                var cxmsg = document.querySelector('msg-'+cpest.attr('name'));
                if(cxmsg != null){
                    caixa_msg.innerHTML = "CEP não encontrado";
                    caixa_msg.style.display = "block";
                    caixa_msg.style.color = "#D2691E";
                }
            },
            beforeSend: function() {//A propriedade “beforeSend” será acionada antes de rodar o ajax
                
            },
            complete: function() {//A propriedade “complete” será acionada quando a requisição estiver completa. 

            }
        });   
        return false;   
    };

    $('.input-group.date').datepicker({
        format: "dd/mm/yyyy",
        endDate: '0',
        language: "pt-BR",
        autoclose: true,
        clearBtn: true,
        todayHighlight: true,
        calendarWeeks: true,
    });

    //Evento que será disparado sempre que um campo do tipo "select" for alterado.
    //Caso o value do campo serja zero ou vazio, a fonte será alterada para cinza, utilizado para primeiro item do campo.
    $("select").change(function(){
        var campo = $(this);
        if(campo.val() == "" || campo.val() == "0"){
            campo.css("color", "gray");
        }else{
            campo.css("color", "#000");
        }
    });

    $('.slctipotel').change(function(){
        var tipoSelecionado = $(this).val();
        var campo = $(this).parent().parent().find("input");
        campo.val('');
        campo.attr('maxlength','0').removeClass("obrigatorio");
        switch(tipoSelecionado){
            case "1":
            case "3":
                campo.attr('maxlength','14').removeClass("celular").addClass("telefone").addClass("obrigatorio").on('keyup', function(){ keyuptelefone($(this)); });
                break;
            case "2":
                campo.attr('maxlength','15').removeClass("telefone").addClass("celular").addClass("obrigatorio").on('keyup', function(){ keyupcelular($(this)); });
                break;
        }
    });        

    
    //Quando o estado do endereço 1 for alterado
    $('#alnEstado_1').change(function(){
        carregaCidade($('#alnCidade_1'), $(this).val());
    });
    
    //Quando o estado do endereço 2 for alterado
    $("select[name=alnEstado_2]").change(function(){
        carregaCidade($('#alnCidade_2'), $(this).val());
    });
    
    //Função que carrega as cidades do estado selecionado, caso seja passada uma cidade porametro, a mesma será selecionada na combo
    function carregaCidade(cmbCidade, est, cidadeSelecionar = null){
        cmbCidade.html('<option value="">Carregando cidades...</option>');
        var options = '<option value="">Selecione uma cidade</option>'; 
        if(est) {
            $.getJSON('cidade-consulta.php?estado=',{estado: est}, function(cidades){     

                $.each(cidades, function(i, obj){
                    options += '<option value="' + obj.cidId + '" cidade="'+obj.cidNome+'" '+(cidadeSelecionar != null && cidadeSelecionar.toUpperCase() == obj.cidNome.toUpperCase() ? "selected" : null)+'>' + obj.cidNome + '</option>';
                })            	
                cmbCidade.html(options);
            });
        }else{
            cmbCidade.html(options);
        }
    }
});