<?php 
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'curso.php';

    $curso = new Curso();

	if(isset($_GET['id'])){
		$curso->crsId = $_GET['id'];
	}else if(isset($_POST['id'])){
		$curso->crsId = $_POST['id'];
	}

	$curso->carregarDados();
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header"><?php echo !empty($curso->crsId) ? "Alteração" : "Cadastro";?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <?php echo !empty($curso->crsId) ? "Alterar Curso" : "Cadastrar Curso";?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
					       <form role="form" id="formcadastrar" action="curso-salvar.php" method="post">
					            <div class="form-group">
					                <input type="hidden" class="form-control" name="crsId" id="crsId" value="<?php echo $curso->crsId; ?>">
					            </div>
					            <div class="form-group">
					                <label class="control-label" for="crsDescricao">Descrição</label>
					                <input type="text" class="form-control obrigatorio" name="crsDescricao" id="crsDescricao" placeholder="Informe a descrição do curso" value="<?php echo $curso->crsDescricao; ?>">
					                <span class='msg-crsDescricao'></span>
					            </div>
					            <div class="form-group">
					                <label class="control-label" for="crsDuracao">Duração (horas)</label>
					                <input type="number" class="form-control obrigatorio" name="crsDuracao" id="crsDuracao" placeholder="Informe a duração do curso em horas" value="<?php echo $curso->crsDuracao; ?>">
					                <span class='msg-crsDuracao'></span>
					            </div>
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
