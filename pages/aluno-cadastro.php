<?php 
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'aluno.php';
    include_once 'professor.php';
    include_once 'secretaria.php';
    include_once 'utils.php';

    $pessoa = null;
    if(isset($_GET['tipo'])){
    	if($_GET['tipo'] == SHA1(EPerfil::Aluno)){
    		$pessoa = new Aluno();
    	}elseif($_GET['tipo'] == SHA1(EPerfil::Professor)){
    		$pessoa = new Professor();
    	}else if($_GET['tipo'] == SHA1(EPerfil::Secretaria)){
    		$pessoa = new Secretaria();
    	}
    }    


	$end1 = new Endereco();
	$end2 = new Endereco();
	
	$estados = Estado::listar();
	$cidades1;
	$cidades2;

	if(isset($_GET['id'])){
		$pessoa->pesId = $_GET['id'];
	}else if(isset($_POST['id'])){
		$pessoa->pesId = $_POST['id'];
	}

	$pessoa->carregarDados();

	
	if(count($pessoa->getEnderecos()) == 1){
		$end1 = $pessoa->getEnderecos()[0];
		$cidades1 = Cidade::listarPorEstado($end1->endCidade->cidEstado->estId);
	}
	if(count($pessoa->getEnderecos()) == 2){
		$end1 = $pessoa->getEnderecos()[0];
		$end2 = $pessoa->getEnderecos()[1];
		$cidades1 = Cidade::listarPorEstado($end1->endCidade->cidEstado->estId);
		$cidades2 = Cidade::listarPorEstado($end2->endCidade->cidEstado->estId);
	}
	
	$qtdEnd = count($pessoa->getEnderecos());
	$qtdTel = count($pessoa->getTelefones());
	
	$isNew = $pessoa->pesId > 0;

echo '
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">'.($isNew ? "Alteração" : "Cadastro").'</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading text-center">'
		  		.($isNew ? "Editar " : "Cadastrar ").$pessoa->perfilDescricao().'
				</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
					       <form role="form" id="formcadastrar" action="aluno-salvar.php" method="post">
					       		<div class="panel panel-default">
						            <div class="panel-heading">
	                           			<label>Dados Pessoais</label>
	                        		</div>
						            <div class="form-group">
						                <input type="hidden" class="form-control" name="pesPerfil" id="pesPerfil" value="'.$pessoa->pesPerfil.'">
						            </div>
						            <div class="form-group">
						                <input type="hidden" class="form-control" name="alnId" id="alnId" value="'.$pessoa->pesId.'">
						            </div>
						            <div class="form-group">
						                <label class="control-label" for="alnNome">Nome</label>
						                <input type="text" class="form-control obrigatorio" name="alnNome" id="alnNome" placeholder="Nome" value="'.$pessoa->pesNome.'">
						                <span class="msg-alnNome"></span>
						            </div>
						            <div class="form-group">
						                <label class="control-label" for="alnCpf">CPF</label>
						                <input type="text" class="form-control obrigatorio cpf" name="alnCpf" id="alnCpf" placeholder="CPF" value="'.Mascaras::geraMascara($pessoa->pesCpf, "###.###.###-##").'">
						                <span class="msg-alnCpf"></span>
						            </div>
						            <div class="form-group">
						                <label class="control-label" for="alnSenha">Senha de Acesso Ao Portal</label>
						                <input type="password" class="form-control obrigatorio" name="alnSenha" id="alnSenha" placeholder="Senha" value="'.$pessoa->pesSenha.'">
						                <span class="msg-alnSenha"></span>
						            </div>
						            <div class="form-group">
						            	<label class="control-label" for="alnRg">RG</label>
						            	<input type="text" class="form-control obrigatorio rg" name="alnRg" id="alnRg" placeholder="RG" value="'.Mascaras::geraMascara($pessoa->pesRg, "##.###.###-#").'">
						            	<span class="msg-alnRg"></span>
						            </div>
						            <div class="form-group">
                                        <label class="control-label" for="alnSexo">Sexo</label>
                                        <label class="radio-inline">
	                                        <input type="radio" name="alnSexo" id="alnSexoMasculino" value="1"'.($pessoa->pesSexo == ESexo::Masculino || $pessoa->pesSexo == null || $pessoa->pesSexo == ""  ? "checked" : null).'/>Masculino
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="alnSexo" id="alnSexoFeminino" value="2"'.($pessoa->pesSexo == 2 ? "checked" : null).'/>Feminino
                                         </label>
	                                </div>
									<div class="form-group">
                                        <label class="control-label" for="alnDataNascimento">Data Nascimento</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control obrigatorio datepicker data" name="alnDataNascimento" id="alnDataNascimento" value="'.$pessoa->dataNascimentoFormatada().'"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                        <span class="msg-alnDataNascimento"></span>
                                    </div>
                                	<div class="form-group"'.($pessoa->pesId > 0 ? null : "hidden").'>
                                		<label class="control-label" for="alnSituacao">Situação</label>
                                        <label class="radio-inline">
	                                        <input type="radio" name="alnSituacao" id="alnSituacaoAtivo" value="1"'.($pessoa->pesAtivo == 1 ? "checked" : null).'/>Ativo
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="alnSituacao" id="alnSituacaoInativo" value="0"'.($pessoa->pesAtivo == 0 ? "checked" : null).'/>Inativo
                                         </label>
                                	</div>
                                </div>
								<div class="panel panel-default">
									<div class="panel-heading">
	                           			<label>Contato</label>
	                        		</div>
									<div class="form-group">
										<table class="table" id="tbhorarios" name="tbhorarios">
											<thead>
												<tr>
													<th>Tipo</th>
													<th>Número</th>
												</tr>
											</thead>
											<tbody>';
												for ($i = 0; $i < 3; $i++) {
													$i2 = $i+1;
													$numeroTel = "";
													$tipoTel = ETipoTelefone::none;
													$idTel = 0;
													if($qtdTel >= $i2){
														$numeroTel = Mascaras::geraMascaraTelefone($pessoa->getTelefones()[$i]->telNumero);
														$tipoTel = $pessoa->getTelefones()[$i]->telTipo;
														$idTel = $pessoa->getTelefones()[$i]->telId;
													}
												?>													
													<tr>
														<td hidden>
															<input type="hidden" class="form-control" name="idtel<?php echo $i2; ?>" id="idtel<?php echo $i2; ?>" value="<?php echo $idTel;?>">
														</td>
														<td>
															<select class="form-control slctipotel" name="tipotelefone<?php echo $i2; ?>">
																<option value="">Selecione um tipo de contato</option>
																<option value="<?php echo ETipoTelefone::residencial.'"'.($tipoTel == ETipoTelefone::residencial ? 'selected' : null); ?>>Residencial</option>
																<option value="<?php echo ETipoTelefone::celular.'"'.($tipoTel == ETipoTelefone::celular ? 'selected' : null); ?>>Celular</option>
																<option value="<?php echo ETipoTelefone::comercial.'"'.($tipoTel == ETipoTelefone::comercial ? 'selected' : null); ?>>Comercial</option>
															</select>
														</td>
														<td class="tdnumero">
															<input type="text" class="form-control" name="numerotelefone<?php echo $i2;?>" value="<?php echo $numeroTel;?>">
															<span class="msg-numerotelefone<?php echo $i2;?>"></span>
														</td>
													</tr>
												<?php }
											echo '</tbody>
										</table>
						            </div>
								</div>
								<div class="panel panel-default">
						            <div class="panel-heading">
	                           			<label>Endereço Principal</label>
	                        		</div>
									<div class="form-group">
						                <input type="hidden" class="form-control" name="alnIdEndereco1" id="alnIdEndereco1" value="'.$end1->endId.'">
						            </div>
						            <div class="form-group">
						            	<label class="control-label" for="alnCep_1">Cep</label>
						            	<input type="text"  class="form-control cep obrigatorio" name="alnCep_1" id="alnCep_1" placeholder="00.000-000" value="'.Mascaras::geraMascara($end1->endCep, "##.###-###").'">
						            	<span class="msg-alnCep_1"></span>
						            </div>
								    <div class="form-group">
								        <label class="control-label" for="alnEstado_1">Estado</label>
								        <select class="form-control obrigatorio" name="alnEstado_1" id="alnEstado_1" style="color: gray;">
								            <option value="" selected>Selecione um estado</option>';
								                try{
								                    if ($estados && $estados->num_rows > 0) {
								                        while($row = $estados->fetch_assoc()){
								                            echo '<option value="'.$row["Id"].'" estado="'.$row["Sigla"].'" '.($qtdEnd >= 1 && $row["Id"] == $pessoa->pesEnderecos[0]->endCidade->cidEstado->estId ? "selected" : null).'>'.utf8_encode($row["Nome"]).'</option>';
								                        }
								                    }
								                } catch (Exception $e) {
								                    echo $e->getMessage();
								                }
								        echo '</select>
								        <span class="msg-alnEstado_1"></span>
								    </div>
									<div class="form-group">
								        <label class="control-label" for="alnCidade_1">Cidade</label>
								        <select class="form-control cidade obrigatorio" name="alnCidade_1" id="alnCidade_1" style="color: gray;">
								            <option value="">Selecione uma cidade</option>';
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
						            	<label class="control-label" for="alnLogradouro_1">Logradouro</label>
						            	<input type="text" class="form-control obrigatorio" name="alnLogradouro_1" id="alnLogradouro_1" placeholder="Logradouro" value="'.$end1->endLogradouro.'">
						            	<span class="msg-alnLogradouro_1"></span>
						            </div>
						            <div class="form-group">
						            	<label class="control-label" for="alnBairro_1">Bairro</label>
						            	<input type="text" class="form-control obrigatorio" name="alnBairro_1" id="alnBairro_1" placeholder="Bairro" value="'.$end1->endBairro.'">
						            	<span class="msg-alnBairro_1"></span>
						            </div>
						            <div class="form-group">
						            	<label class="control-label" for="alnNumeroCasa_1">Numero</label>
						            	<input type="number" class="form-control obrigatorio" name="alnNumeroCasa_1" id="alnNumeroCasa_1" placeholder="Numero " value="'.$end1->endNumero.'">
						            	<span class="msg-alnNumeroCasa_1"></span>
						            </div>
						            <div class="form-group">
						            	<label class="control-label" for="alnComplemento_1">Complemento</label>
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

					            <div class="panel panel-default" '.($qtdEnd < 2 ? "hidden" : null).' id="pnenderecosecundario">
						            <div class="panel-heading">
	                           			<label>Endereço Secundário</label>
	                        		</div>									
									<div class="form-group">
						                <input type="hidden" class="form-control" name="alnIdEndereco2" id="alnIdEndereco1" value="'.$end2->endId.'">
						            </div>
                                   	<div class="form-group">
                                        <label class="control-label" for="alnCep_2">CEP</label>
                                        <input type="text" class="form-control cep" name="alnCep_2" id="alnCep_2" placeholder="Cep" value="'.Mascaras::geraMascara($end2->endCep, "##.###-###").'">
                                        <span class="msg-alnCep_2"></span>
                                    </div>
								    <div class="form-group">
								        <label class="control-label" for="alnEstado_2">Estado</label>
								        <select class="form-control" name="alnEstado_2" id="alnEstado_2" style="color: gray;">
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
								        <label class="control-label" for="alnCidade_2">Cidade</label>
								        <select class="form-control cidade" name="alnCidade_2" id="alnCidade_2" style="color: gray;">
								            <option value="">Selecione uma cidade</option>';
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
                                        <label class="control-label" for="alnLogradouro_2">Logradouro</label>
                                        <input type="text" class="form-control" name="alnLogradouro_2" id="alnLogradouro_2" placeholder="Logradouro" value="'.$end2->endLogradouro.'">
                                        <span class="msg-alnLogradouro_2"></span>
                                    </div>
                                   	<div class="form-group">
                                        <label class="control-label" for="alnBairro_2">Bairro</label>
                                        <input type="text" class="form-control" name="alnBairro_2" id="alnBairro_2" placeholder="Bairro" value="'.$end2->endBairro.'">
                                        <span class="msg-alnBairro_2"></span>
                                    </div>
                                   	<div class="form-group">
                                        <label class="control-label" for="alnNumero_2">Número</label>
                                        <input type="number" class="form-control" name="alnNumero_2" id="alnNumero_2" placeholder="Numero" value="'.$end2->endNumero.'">
                                        <span class="msg-alnNumero_2"></span>
                                    </div>
                                   	<div class="form-group">
                                        <label class="control-label" for="alnComplemento_2">Complemento</label>
                                        <input type="text" class="form-control" name="alnComplemento_2" id="alnComplemento_2" placeholder="Complemento" value="'.$end2->endComplemento.'">
                                        <span class="msg-alnComplemento_2"></span>
                                    </div>
                                </div>
                                <div class="form-group">
	                                <button type="submit" id="botao-salvar" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
	                                <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-erase"></span> Limpar</button>
	                            </div>
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
    
</script>

<script type="text/javascript" src="../js/js-validacao-generica.js"></script>
<script type="text/javascript" src="../js/aluno/aluno.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>