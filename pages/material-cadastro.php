<?php 
	include_once "menu.php";
    include_once 'material.php';
    include_once '../conf/acesso-dados.php';

    $material = new Material();

	if(isset($_GET['id'])){
		$material->matId = $_GET['id'];
	}else if(isset($_POST['id'])){
		$material->matId = $_POST['id'];
	}

	$material->carregarDados();
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo !empty($material->matId) ? "Alteração" : "Cadastro";?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo !empty($material->matId) ? "Alterar Material" : "Cadastrar Material";?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
					       <form role="form" id="formcadastrar" action="material-salvar.php" method="post">
					            <div class="form-group">
					                <input type="hidden" class="form-control" name="matId" id="matId" value="<?php echo $material->matId; ?>">
					            </div>
					            <div class="form-group">
					                <label for="matDescricao">Descrição</label>
					                <input type="text" class="form-control obrigatorio" name="matDescricao" id="matDescricao" placeholder="Informe a descrição do material" value="<?php echo $material->matDescricao; ?>">
					                <span class='msg-matDescricao'></span>
					            </div>
					            <div class="form-group">
					                <label for="matAno">Ano</label>
					                <input type="text" class="form-control obrigatorio" name="matAno" id="matAno" placeholder="Informe o ano do material" value="<?php echo $material->matAno; ?>">
					                <span class='msg-matAno'></span>
					            </div>
                                <button type="submit" class="btn btn-primary" id="botao-salvar">Salvar</button>
                                <button type="reset" class="btn btn-default">Limpar</button>
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
    $('#matAno').datepicker({
        autoclose: true,
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        language: "pt-BR",
        startDate: '-10',
        endDate: new Date(),
    });
</script>