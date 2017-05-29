<?php 
	include_once "menu.php";
    include_once "../conf/acesso-dados.php";
    include_once "autor.php";

    $autor = new autor();

	if(isset($_GET['id'])){
		$autor->autId = $_GET['id'];
	}else if(isset($_POST['id'])){
		$autor->autId = $_POST['id'];
	}

	$autor->carregarDados();
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header"><?php echo !empty($autor->autId) ? "Alteração" : "Cadastro";?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <?php echo !empty($autor->autId) ? "Alterar Autor" : "Cadastrar Autor";?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
					       <form role="form" id="formcadastrar" action="autor-salvar.php" method="post">
					            <div class="form-group">
					                <input type="hidden" class="form-control" name="autId" id="autId" value="<?php echo $autor->autId; ?>">
					            </div>
					            <div class="form-group">
					                <label class="control-label" for="autNome">Nome</label>
					                <input type="text" class="form-control obrigatorio" name="autNome" id="autNome" placeholder="Informe o Nome do Autor" value="<?php echo $autor->autNome; ?>">
					                <span class='msg-crsDescricao'></span>
					            </div>
					            <div class="form-group">
					                <label class="control-label" for="autDescricao">Descrição</label>
					                <textarea class="form-control obrigatorio" rows="3" name="autDescricao" id="autDescricao" placeholder="Informe a Descricao do Autor" value="<?php echo $autor->autDescricao; ?>"></textarea>
					                <span class='msg-crsDescricao'></span>
					            </div>
					            <?php 
					            '<div class="form-group"'.($autor->autId > 0 ? null : "hidden").'>
                                		<label class="control-label" for="alnSituacao">Situação</label>
                                        <label class="radio-inline">
	                                        <input type="radio" name="alnSituacao" id="alnSituacaoAtivo" value="1"'.($autor->autAtivo == 1 ? "checked" : null).'/>Ativo
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input type="radio" name="alnSituacao" id="alnSituacaoInativo" value="0"'.($autor->autAtivo == 0 ? "checked" : null).'/>Inativo
                                         </label>
                                </div>'
                                ?>
                                
					            <div class="form-group">
	                                <button type="submit" class="btn btn-primary" id="botao-salvar"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
	                                <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-erase"></span> Limpar</button>
                              	</div>
					        </form>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="../js/js-validacao-generica.js"></script>

<script>

	//$(document).ready(function($) {
	//	cursocadastrar.Init();
	//});
	$(document).ready(function($) {
		//$("#crsDuracao").number();
	});
</script>
