<?php 
	include_once "menu.php";
    include_once 'includes.php';

        $id = "";                                                                 
        $nome = "";
        $cpf = "";
        $rg = "";
        $sexo = "";
        $senha = "";
        $data_nasc = "";
        $enderecos = "";
        $responsaveis = "";
        $cidades = "";
        $situacao = "";
        
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	if(isset($_GET['nome'])){
		$nome = $_GET['nome'];
	}
	if(isset($_GET['cpf'])){
		$cpf = $_GET['cpf'];
	}
        if(isset($_GET['rg'])){
		$rg = $_GET['rg'];
	}
        if(isset($_GET['sexo'])){
		$sexo = $_GET['sexo'];
	}
        if(isset($_GET['senha'])){
		$senha = $_GET['senha'];
	}
        if(isset($_GET['DataNascimento'])){
		$data_nasc = $_GET['DataNascimento'];
                $date = new DateTime($data_nasc);
                $data_nasc = $date->format('Y-m-d');
	}
        
        if(isset($_GET['situacao'])){
            $situacao = $_GET['situacao'];
        }
        
        if(isset($_GET['enderecos'])){
		$enderecos = $_GET['enderecos'];
	}
        if(isset($_GET['responsaveis'])){
		$responsaveis = $_GET['responsaveis'];
	}
        
        if(isset($_GET['cidades'])){
		$cidades = $_GET['cidades'];
	}
?>

<style type="text/css">
	.msg-erro{ color: #D2691E; }
</style>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if(!empty($id)) echo "Alteração"; else echo "Cadastro";?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if(!empty($id)) echo "Alterar Professor"; else echo "Cadastrar Professor";?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
					       <form role="form" id="formcadastrarprof" action="professor-salvar.php" method="post">
					            <div class="form-group">
					                <input type="hidden" class="form-control" name="profId" id="profId" value="<?php if(!empty($id)) echo $id; ?>">
					            </div>
					            <div class="form-group">
					                <label for="profNome">Nome</label>
					                <input type="text" class="form-control" name="profNome" id="profNome" placeholder="Informe o nome do professor" value="<?php if(!empty($nome)) echo $nome; ?>">
					                <span class='msg-erro msg-descricao'></span>
					            </div>
                                                   <div class="form-group">
					                <label for="profDataNascimento">Data de Nascimento</label>
					                <input type="date" class="form-control" name="profDataNascimento" id="profDataNascimento" placeholder="Informe data de nascimento do professor" value="<?php if(!empty($data_nasc)) echo $data_nasc; ?>">
					                <span class='msg-erro msg-descricao'></span>
					            </div>
					            <div class="form-group">
					                <label for="profCpf">CPF</label>
                                                        <input type="text" class="form-control" name="profCpf" id="profCpf" placeholder="Informe o CPF do professor" value="<?php if(!empty($cpf)) echo $cpf; ?>">
					                <span class='msg-erro msg-duracao'></span>
					            </div>
                                                   <div class="form-group">
					                <label for="profRg">RG</label>
                                                        <input type="text" class="form-control" name="profRg" id="profRg" placeholder="Informe o RG do professor" value="<?php if(!empty($rg)) echo $rg; ?>">
					                <span class='msg-erro msg-duracao'></span>
					            </div>
                                                   <div class="form-group">
					                <label for="profRg">Sexo</label>
                                                        <input type="text" class="form-control" name="profSexo" id="profSexo" placeholder="Informe o sexo do professor" value="<?php if(!empty($sexo)) echo $sexo; ?>">
					                <span class='msg-erro msg-duracao'></span>
					            </div>
                                                   <div class="form-group">
					                <label for="profSenha">Senha</label>
                                                        <input type="text" class="form-control" name="profSenha" id="profSenha" placeholder="Informe o Senha do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
					                <span class='msg-erro msg-duracao'></span>
					            </div>
                                                   <div class="form-group">
                                                        <label>Situação</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="profSituacao" id="profSituacao" value="1" <?php echo $situacao == 1 ? "checked" : null; ?>/> Ativo
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="profSituacao"  value="0" <?php echo $situacao == 0 ? "checked" : null; ?>/> Inativo
                                                        </label>
                                                    </div>
                                                   <fieldset id="fieldsetEndereco">
                                                       <legend>Endereço</legend>
                                                       <div class="panel panel-default">
                                                           <div class="panel-heading">
                                                               Principal
                                                           </div>
                                                           <div class="panel-body">
                                                            <div class="form-group">
                                                                <label for="profCep_1">CEP</label>
                                                                <input type="text" class="form-control" name="profCep_1" id="profCep_1" placeholder="Informe o complemento do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                                <span class='msg-erro msg-duracao'></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="profCidade_1">Cidade</label>
                                                                <input type="text" class="form-control" id="profCidade_1" placeholder="Informe a cidade do professor">
                                                                <span class='msg-erro msg-duracao'></span>
                                                            </div>
                                                           <div class="form-group">
                                                                <label for="profLogradouro_1">Logradouro</label>
                                                                <input type="text" class="form-control" name="profLogradouro_1" id="profLogradouro_1" placeholder="Informe o logradouro do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                                <span class='msg-erro msg-duracao'></span>
                                                            </div>
                                                           <div class="form-group">
                                                                <label for="profBairro_1">Bairro</label>
                                                                <input type="text" class="form-control" name="profBairro_1" id="profBairro_1" placeholder="Informe o bairro do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                                <span class='msg-erro msg-duracao'></span>
                                                            </div>
                                                           <div class="form-group">
                                                                <label for="profNúmero_1">Número</label>
                                                                <input type="text" class="form-control" name="profNúmero_1" id="profNúmero_1" placeholder="Informe o número do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                                <span class='msg-erro msg-duracao'></span>
                                                            </div>
                                                           <div class="form-group">
                                                                <label for="profComplemento_1">Complemento</label>
                                                                <input type="text" class="form-control" name="profComplemento_1" id="profComplemento_1" placeholder="Informe o complemento do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                                <span class='msg-erro msg-duracao'></span>
                                                            </div>
                                                           
                                                        </div>
                                                       </div>
                                                       
                                                       
                                                       <div class="panel panel-default">
                                                           <div class="panel-heading">
                                                               Secundario
                                                           </div>
                                                           <div class="panel-body">
                                                       <div class="form-group">
                                                            <label for="profCep_2">CEP</label>
                                                            <input type="text" class="form-control" name="profCep_2" id="profCep_2" placeholder="Informe o CEP do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                            <span class='msg-erro msg-duracao'></span>
                                                        </div>
                                                       <div class="form-group">
                                                            <label for="profCidade_2">Cidade</label>
                                                            <input type="text" class="form-control" id="profCidade_2" placeholder="Informe a cidade do professor">
                                                            <span class='msg-erro msg-duracao'></span>
                                                        </div>
                                                       <div class="form-group">
                                                            <label for="profLogradouro_2">Logradouro</label>
                                                            <input type="text" class="form-control" name="profLogradouro_2" id="profLogradouro_2" placeholder="Informe o logradouro do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                            <span class='msg-erro msg-duracao'></span>
                                                        </div>
                                                       <div class="form-group">
                                                            <label for="profBairro_2">Bairro</label>
                                                            <input type="text" class="form-control" name="profBairro_2" id="profBairro_2" placeholder="Informe o bairro do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                            <span class='msg-erro msg-duracao'></span>
                                                        </div>
                                                       <div class="form-group">
                                                            <label for="profNumero_2">Número</label>
                                                            <input type="text" class="form-control" name="profNumero_2" id="profNumero_2" placeholder="Informe o número do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                            <span class='msg-erro msg-duracao'></span>
                                                        </div>
                                                       <div class="form-group">
                                                            <label for="profComplemento_2">Complemento</label>
                                                            <input type="text" class="form-control" name="profComplemento_2" id="profComplemento_2" placeholder="Informe o complemento do professor" value="<?php if(!empty($senha)) echo $senha; ?>">
                                                            <span class='msg-erro msg-duracao'></span>
                                                        </div>
                                                       
                                                   </div>
                                                       </div>
                                                   
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                    <button type="reset" class="btn btn-default">Limpar</button>
					        </form>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--<script type="text/javascript" src="../js/curso/curso-valida.js"></script>-->
<!--<script src="../js/curso/cadastrar.js" type="text/javascript"></script>-->
<script>
//	$(document).ready(function($) {
//		cursocadastrar.Init();
//	});
        
        $('#profRg').mask('99.999.999.999-99');
        $('#profCpf').mask('999.999.999-99');
        $('#profCep_1').mask('99999-999');
        $('#profCep_2').mask('99999-999');
        
//        console.log(<?=json_encode($cidades)?>.split(","));
        
        var availableTags = <?=json_encode($cidades)?>.split(",");
        
        $( "#profCidade_1" ).autocomplete({
            source: availableTags
        });
        
        //CEP
        
        $('#profCep_1').blur(function(){
            console.log(1)
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_cep.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'cep=' + $('#profCep_1').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#profLogradouro_1').val(data.rua);
                        $('#profBairro_1').val(data.bairro);
                        $('#profCidade_1').val(data.cidade);
//                        $('#estado').val(data.estado);
 
                        $('#profNúmero_1').focus();
                    }
                }
           });   
        return false;    
        })
        
        $('#profCep_2').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_cep.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'cep=' + $('#profCep_2').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#profLogradouro_2').val(data.rua);
                        $('#profBairro_2').val(data.bairro);
                        $('#profCidade_2').val(data.cidade);
//                        $('#estado').val(data.estado);
 
                        $('#profNúmero_2').focus();
                    }
                }
           });   
        return false;    
        })
</script>




