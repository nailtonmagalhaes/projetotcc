<?php 
	include_once "menu.php";
    include_once 'aluno.php';

    $aluno = new Aluno();
	$end1 = new Endereco();
	$end2 = new Endereco();
	$telefone = new Telefone();
	
	$estados = Estado::listar();
	$cidades1;
	$cidades2;

	if(isset($_GET['id'])){
		$aluno->pesId = $_GET['id'];
	}else if(isset($_POST['id'])){
		$aluno->pesId = $_POST['id'];
	}

	$aluno->carregarDados();
	$telefone->carregarDados();

	
	if(count($aluno->getEnderecos()) == 1){
		$end1 = $aluno->getEnderecos()[0];
		$cidades1 = Cidade::listarPorEstado($end1->endCidade->cidEstado->estId);
	}
	if(count($aluno->getEnderecos()) == 2){
		$end1 = $aluno->getEnderecos()[0];
		$end2 = $aluno->getEnderecos()[1];
		$cidades1 = Cidade::listarPorEstado($end1->endCidade->cidEstado->estId);
		$cidades2 = Cidade::listarPorEstado($end2->endCidade->cidEstado->estId);
	}
	
	$qtdEnd = count($aluno->getEnderecos());
//	$qtdTel = count($telefone->getTelefone());
	
	$isNew = $aluno->pesId > 0;

echo '
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">'.($isNew ? "Alteração" : "Cadastro").'</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">'
		  		.($isNew ? "Editar Aluno" : "Cadastrar Aluno").'
				</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
					       <form role="form" id="formcadastrar" action="aluno-salvar.php" method="post">
					       		<div class="panel panel-default">
						            <div class="panel-heading">
	                           			<label>Dados Pessoais</label>
	                        		</div>
						            <div class="form-group">
						                <input type="hidden" class="form-control" name="alnId" id="alnId" value="'.$aluno->pesId.'">
						            </div>
						            <div class="form-group">
						                <label for="alnNome">Nome</label>
						                <input type="text" class="form-control obrigatorio" name="alnNome" id="alnNome" placeholder="Nome" value="'.$aluno->pesNome.'">
						                <span class="msg-alnNome"></span>
						            </div>
						            <div class="form-group">
						                <label for="alnCpf">CPF</label>
						                <input type="text" class="form-control obrigatorio cpf" name="alnCpf" id="alnCpf" placeholder="CPF" value="'.Mascaras::geraMascara($aluno->pesCpf, "###.###.###-##").'">
						                <span class="msg-alnCpf"></span>
						            </div>
						            <div class="form-group">
						                <label for="alnCpf">Senha de Acesso Ao Portal</label>
						                <input type="password" class="form-control obrigatorio" name="alnSenha" id="alnSenha" placeholder="Senha" value="'.$aluno->pesSenha.'">
						                <span class="msg-alnSenha"></span>
						            </div>
						            <div class="form-group">
						            	<label for="alnRg">RG</label>
						            	<input type="text" class="form-control obrigatorio rg" name="alnRg" id="alnRg" placeholder="RG" value="'.Mascaras::geraMascara($aluno->pesRg, "##.###.###-#").'">
						            	<span class="msg-alnRg"></span>
						            </div>
						            <div class="form-group">
                                        <label for="alnSexo">Sexo</label>
                                        <label class="radio-inline">
	                                        <input type="radio" name="alnSexo" id="alnSexoMasculino" value="1"'.($aluno->pesSexo == 1 ? "checked" : null).'/>Masculino
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="alnSexo" id="alnSexoFeminino" value="2"'.($aluno->pesSexo == 2 ? "checked" : null).'/>Feminino
                                         </label>
	                                </div>
	                                <div class="form-group">
						            	<label for="alnDataNascimento">Data Nascimento</label>
						            	<input type="text" class="form-control datepicker" name="alnDataNascimento" id="alnDataNascimento" placeholder="Data Nascimento" value="'.date('d/m/Y', strtotime($aluno->pesDataNascimento)).'">
						            	<span class="msg-alnDataNascimento"></span>
						            </div>
									<div class="form-group">
						            	<label for="alnCelular">Celular</label>
						            	<input type="text" class="form-control celular" name="alnCelular1" id="alnCelular" placeholder="Telefone Celular" value="'.Mascaras::geraMascara($telefone->telNumero,"(##)#####.####").'">
						            	<span class="msg-alnTelefone"></span>
						            </div>
					            	<div class="form-group">
                                        <label for="alnPerfil">Perfil</label>
                                    	<select class="form-control" name="alnPerfil" id="alnPerfil">
                                    		<option value="'.EPerfil::Aluno.'" '.(EPerfil::Aluno == $aluno->pesPerfil ? "selected" : null).'>Aluno</option>
											<option value="'.EPerfil::Professor.'" '.(EPerfil::Professor == $aluno->pesPerfil ? "selected" : null).'>Professor</option>
											<option value="'.EPerfil::Secretaria.'" '.(EPerfil::Secretaria == $aluno->pesPerfil ? "selected" : null).'>Secretaria</option>
									    </select>
									    <span class="msg-alnPerfil"></span>
                                	</div>
                                	<div class="form-group"'.($aluno->pesId > 0 ? null : "hidden").'>
                                		<label for="alnSituacao">Situação</label>
                                        <label class="radio-inline">
	                                        <input type="radio" name="alnSituacao" id="alnSituacaoAtivo" value="1"'.($aluno->pesAtivo == 1 ? "checked" : null).'/>Ativo
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="alnSituacao" id="alnSituacaoInativo" value="0"'.($aluno->pesAtivo == 0 ? "checked" : null).'/>Inativo
                                         </label>
                                	</div>
                                </div>
                                 <div class="panel panel-default">
						            <div class="panel-heading">
	                           			<label>Endereço Principal</label>
	                        		</div>
						            <div class="form-group">
						            	<label for="alnCep_1">Cep</label>
						            	<input type="text"  class="form-control" name="alnCep_1" id="alnCep_1" placeholder="00.000-000" value="'.Mascaras::geraMascara($end1->endCep, "##.###-###").'">
						            	<span class="msg-alnCep_1"></span>
						            </div>
								    <div class="form-group">
								        <label for="alnEstado_1">Estado</label>
								        <select class="form-control obrigatorio" name="alnEstado_1" id="alnEstado_1" style="color: gray;">
								            <option value="" selected>Selecione um estado</option>';
								                try{
								                    if ($estados && $estados->num_rows > 0) {
								                        while($row = $estados->fetch_assoc()){
								                            echo '<option value="'.$row["Id"].'" estado="'.$row["Sigla"].'" '.($qtdEnd >= 1 && $row["Id"] == $aluno->pesEnderecos[0]->endCidade->cidEstado->estId ? "selected" : null).'>'.utf8_encode($row["Nome"]).'</option>';
								                        }
								                    }
								                } catch (Exception $e) {
								                    echo $e->getMessage();
								                }
								        echo '</select>
								        <span class="msg-alnEstado_1"></span>
								    </div>
									<div class="form-group">
								        <label for="alnCidade_1">Cidade</label>
								        <select class="form-control cidade" name="alnCidade_1" id="alnCidade_1" style="color: gray;">
								            <option value="0">Selecione uma cidade</option>';
											if($qtdEnd >= 1 ){
												if($cidades1->num_rows > 0){
													while($cid1 = $cidades1->fetch_assoc()){
														echo '<option value="'.$cid1["Id"].'" '.($cid1["Id"] == $end1->endCidade->cidId ? "selected" : null).'>'.utf8_encode($cid1["Nome"]).'</option>';
													}
												}
											}
								        echo '</select>
								        <span class="msg-alnCidade_1"></span>
								    </div>
	                                <div class="form-group">
						            	<label for="alnLogradouro_1">Logradouro</label>
						            	<input type="text" class="form-control" name="alnLogradouro_1" id="alnLogradouro_1" placeholder="Logradouro" value="'.$end1->endLogradouro.'">
						            	<span class="msg-alnLogradouro_1"></span>
						            </div>
						            <div class="form-group">
						            	<label for="alnBairro_1">Bairro</label>
						            	<input type="text" class="form-control" name="alnBairro_1" id="alnBairro_1" placeholder="Bairro" value="'.$end1->endBairro.'">
						            	<span class="msg-alnBairro_1"></span>
						            </div>
						            <div class="form-group">
						            	<label for="alnNumeroCasa_1">Numero</label>
						            	<input type="number" class="form-control" name="alnNumeroCasa_1" id="alnNumeroCasa_1" placeholder="Numero " value="'.$end1->endNumero.'">
						            	<span class="msg-alnNumeroCasa_1"></span>
						            </div>
						            <div class="form-group">
						            	<label for="alnComplemento_1">Complemento</label>
						            	<input type="tet" class="form-control" name="alnComplemento_1" id="alnComplemento_1" placeholder="Complemento" value="'.$end1->endComplemento.'">
						            	<span class="msg-alnComplemento_1"></span>
						            </div>
					            </div>

					             <div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="alnSegundoEndereco" onChange="mostrarEnderecoSecundario(this)"'.($qtdEnd > 1 ? "checked" : null).'>Endereço adicional
										</label>
									</div>
					            </div>

					            <div class="panel panel-default" '.($qtdEnd < 2 ? "hidden" : null).' id="chkenderecosecundario">
						            <div class="panel-heading">
	                           			<label>Endereço Secundário</label>
	                        		</div>
                                   	<div class="form-group">
                                        <label for="alnCep_2">CEP</label>
                                        <input type="text" class="form-control" name="alnCep_2" id="alnCep_2" placeholder="Cep" value="'.Mascaras::geraMascara($end2->endCep, "##.###-###").'">
                                        <span class="msg-alnCep_2"></span>
                                    </div>
								    <div class="form-group">
								        <label for="alnEstado_2">Estado</label>
								        <select class="form-control obrigatorio" name="alnEstado_2" id="alnEstado_2" style="color: gray;">
								            <option value="" selected >Selecione um estado</option>';
								                try{
								                    if ($estados && $estados->num_rows > 0) {
								                        foreach($estados as $est){															
								                            echo '<option value="'.$est["Id"].'" estado="'.utf8_encode($est["Sigla"]).'" '.($qtdEnd >= 2 && $est["Id"] == $end2->endCidade->cidEstado->estId ? "selected" : null).'>'.utf8_encode($est["Nome"]).'</option>';
								                        }
								                    }
								                } catch (Exception $e) {
								                    echo $e->getMessage();
								                }
								        echo '</select>
								        <span class="msg-alnEstado_2"></span>
								    </div>
									<div class="form-group">
								        <label for="alnCidade_2">Cidade</label>
								        <select class="form-control cidade" name="alnCidade_2" id="alnCidade_2" style="color: gray;">
								            <option value="0">Selecione uma cidade</option>';
											if($qtdEnd >= 2 ){
												if($cidades2->num_rows > 0){
													while($cid2 = $cidades2->fetch_assoc()){
														echo '<option value="'.$cid2["Id"].'" '.($cid2["Id"] == $end2->endCidade->cidId ? "selected" : null).'>'.utf8_encode($cid2["Nome"]).'</option>';
													}
												}
											}
								        echo '</select>
								        <span class="msg-alnCidade_2"></span>
								    </div>
                                   	<div class="form-group">
                                        <label for="alnLogradouro_2">Logradouro</label>
                                        <input type="text" class="form-control" name="alnLogradouro_2" id="alnLogradouro_2" placeholder="Logradouro" value="'.$end2->endLogradouro.'">
                                        <span class="msg-alnLogradouro_2"></span>
                                    </div>
                                   	<div class="form-group">
                                        <label for="alnBairro_2">Bairro</label>
                                        <input type="text" class="form-control" name="alnBairro_2" id="alnBairro_2" placeholder="Bairro" value="'.$end2->endBairro.'">
                                        <span class="msg-alnBairro_2"></span>
                                    </div>
                                   	<div class="form-group">
                                        <label for="alnNumero_2">Número</label>
                                        <input type="number" class="form-control" name="alnNumero_2" id="alnNumero_2" placeholder="Numero" value="'.$end2->endNumero.'">
                                        <span class="msg-alnNumero_2"></span>
                                    </div>
                                   	<div class="form-group">
                                        <label for="alnComplemento_2">Complemento</label>
                                        <input type="text" class="form-control" name="alnComplemento_2" id="alnComplemento_2" placeholder="Complemento" value="'.$end2->endComplemento.'">
                                        <span class="msg-alnComplemento_2"></span>
                                    </div>
                                </div>
                                <button type="submit" id="botao-salvar" class="btn btn-primary">Salvar</button>
                                <button type="reset" class="btn btn-default">Limpar</button>
					        </form>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>';
?>


<script>
	
        
    //Função que mostra ou oculta a div de segundo endereço
    function mostrarEnderecoSecundario(elm){
    	var valor = elm.checked;
    	var comp = document.getElementById("chkenderecosecundario");
    	if(valor){
    		comp.style.display = 'block';
    	}else{
    		comp.style.display = 'none';
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
			if(cpcep.val() == null || cpcep.val() == "" || cpcep.val().replace(/\D/g, '').length < 8) return;
			
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

		$(".datepicker").datepicker({
			format: "dd/mm/yyyy",
			language: "pt-BR",
			orientation: "bottom",
			todayHighlight: true,
			autoclose: true,
			endDate: '-30',
			calendarWeeks: true,
			clearBtn: true,
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
</script>

<script type="text/javascript" src="../js/js-validacao-generica.js"></script>


