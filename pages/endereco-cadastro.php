    <?php 
        //header('Content-type: text/html; charset=ISO-8859-1'); 
	include_once "menu.php";
    include_once 'includes.php';
    ?>

    <div class="form-group">
        <label for="cep">CEP</label>
        <input type="text" class="form-control" name="cep" id="cep" placeholder="Cep">
        <span class='msg-cep'></span>
    </div>
    <div class="form-group">
        <label for="slestado">Estado</label>
        <select class="form-control obrigatorio" name="slestado" id="slestado" style="color: gray;">
            <option value="">Selecione um estado</option>
            <?php 
            header('Content-type: text/html; charset=ISO-8859-1');
                try{
                    $resultado = listar("SELECT Id, Sigla, Nome FROM tbEstado ORDER BY Nome");
                    if ($resultado && $resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()){
                            echo $row["Nome"];
                            echo '<option value="'.$row["Id"].'">'.$row["Sigla"].'</option>';                            
                            //echo '<option value="'.$row["Id"].'">'.$row["Nome"].'</option>';
                        } 
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            ?>
        </select>
        <span class='msg-slestado'></span>
    </div>
	<div class="form-group">
        <label for="slcidade">Cidade</label>
        <select class="form-control cidade" name="slcidade" id="slcidade" style="color: gray;">
            <option value="0">Selecione uma cidade</option>
        </select>
        <span class='msg-slcidade'></span>
    </div>
   	<div class="form-group">
        <label for="alnLogradouro_2">Logradouro</label>
        <input type="text" class="form-control" name="alnLogradouro" id="alnLogradouro_2" placeholder="Logradouro" value="<?php echo $logradouro; ?>">
        <span class='msg-erro msg-alnLogradouro'></span>
    </div>
   	<div class="form-group">
        <label for="albBairro_2">Bairro</label>
        <input type="text" class="form-control" name="alnBairro" id="alnBairro_2" placeholder="Bairro" value="<?php echo $bairro; ?>">
        <span class='msg-erro msg-duracao'></span>
    </div>
   	<div class="form-group">
        <label for="alnNumero_2">Número</label>
        <input type="number" class="form-control" name="alnNumero" id="alnNumero_2" placeholder="Numero" value="<?php echo $numero; ?>">
        <span class='msg-erro msg-alnNumero'></span>
    </div>
   	<div class="form-group">
        <label for="alnComplemento_2">Complemento</label>
        <input type="text" class="form-control" name="alnComplemento" id="alnComplemento_2" placeholder="Complemento" value="<?php echo $complemento; ?>">
        <span class='msg-erro msg-alnComplemento'></span>
    </div>
    <div id="mensagem">
            
    </div>

<script type="text/javascript">
    $(document).ready(function(){

        
        //Funcionou
        $("select[name=slestado]").change(function(){
            var campo = $(this);
            $("select[name=slcidade]").html('<option value="0">Carregando cidades...</option>');
            if(campo.val() == "" || campo.val() == "0"){
                campo.css("color", "gray");
            }else{
                campo.css("color", "#000");
            }

            $.post("cidade-consulta.php", {estado:campo.val()}, function(valor){
                var primeiroItem = '<option value="">Selecione uma cidade</option>';
                var htmlCombo = primeiroItem + valor;
                $("select[name=slcidade]").html(htmlCombo);
            });
        });

        $("select[class=cidade]").change(function(){
            var campo = $(this);
            if(campo.val() == "" || campo.val() == "0"){
                campo.css("color", "gray");
            }else{
                campo.css("color", "#000");
            }
        });
        

        /*
        $('#slestado').change(function(){
            if($(this).val()) {
                $.getJSON('consulta-cidade.php?estado=',{estado: $(this).val(), ajax: 'true'}, function(j){
                    var options = '<option value=""></option>'; 
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].Id + '">' + j[i].Nome + '</option>';
                    } 
                });
            } else {
                $('#slcidade').html('<option value="">-- Escolha um estado --</option>');
            }
        });
        */

        /*$('#slestado').change(function(e){
            var estado = $('#slestado').val();
            $('#mensagem').html('<span class="mensagem">Aguarde, carregando ...</span>');  
            var url = 'consulta-cidade.php?estado=' + estado;

            $.getJSON(url, function (dados){
                
                if (dados.length > 0){  
                    var option = '<option>Selecione a Cidade</option>';
                    $.each(dados, function(i, obj){
                        option += '<option>'+obj.nome+'</option>';
                    })
                    $('#mensagem').html('<span class="mensagem">Total de cidades encontradas.: '+dados.length+'</span>');
                }else{
                    Reset();
                    $('#mensagem').html('<span class="mensagem">Não foram encontradas cidades para esse estado!</span>');  
                }
                $('#slcidade').html(option).show();
            })
        })

        function Reset(){
            $('#slestado').empty().append('<option>Carregar Estados</option>>');
            $('#slcidade').empty().append('<option>Carregar Cidades</option>');
        }*/
    });
</script> 
