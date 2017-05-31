<?php 
	include_once "menu.php";
    include_once 'material.php';
    include_once '../conf/acesso-dados.php';

    $material = new Material();

	if(isset($_REQUEST["id"])){
		$material->matId = $_GET['id'];
	}
        else if(isset($_POST['id'])){
		$material->matId = $_POST['id'];
	}
//        var_dump($_REQUEST["id"]);die;

	$material->carregarDados();
//        var_dump($material);die;
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header"><?php echo !empty($material->matId) ? "Alteração" : "Cadastro";?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <?php echo !empty($material->matId) ? "Alterar Material" : "Cadastrar Material";?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
					       <form role="form" id="formcadastrar" action="material-salvar.php" method="post" enctype="multipart/form-data">
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
                                                    <div class="form-group">
                                                        <label>Arquivo Atual</label>
                                                        <?php if($material->matId)
                                                        {
                                                             echo "<iframe style=\"cursor: hand;\" src=\"../uploads/{$material->matLink}\" width=\"550\" height=\"780\" style=\"border: none;\"></iframe>";
                                                        }
                                                        
//                                                        var_dump($material);
                                                        ?>
                                                        
                                                        
                                                        <label>Alterar Arquivo</label>
                                                        <input type="file" name="arquivo" id="arquivo" value="<?php echo $material->matLink; ?>">
                                                    </div>
                                                    
					            <div class="form-group">
	                                <button type="submit" class="btn btn-primary" id="botao-salvar"><span class="glyphicon glyphicon-floppy-disk" ></span> Salvar</button>
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
    $('#matAno').datepicker({
        autoclose: true,
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        language: "pt-BR",
        startDate: '-10',
        endDate: new Date(),
    });
    var evento_click;
    
    $('#botao-salvar').click(function(e){
        evento_click = e;
        comprova_extensao($('#formcadastrar'),$('#arquivo').val())
        if(($('#arquivo').val()).lenght==0){
            e.preventDefault();
        }
    })
    
    
    function comprova_extensao(formulario, arquivo) { 
        extensoes_permitidas = new Array(".pdf"); 
        meuerro = ""; 
        if (!arquivo) { 
           //Se não tenho arquivo, é porque não se selecionou um arquivo no formulário. 
             meuerro = "Não foi selecionado nenhum arquivo"; 
        }else{ 
           //recupero a extensão deste nome de arquivo 
           extensao = (arquivo.substring(arquivo.lastIndexOf("."))).toLowerCase(); 
           //alert (extensao); 
           //comprovo se a extensão está entre as permitidas 
           permitida = false; 
           for (var i = 0; i < extensoes_permitidas.length; i++) { 
              if (extensoes_permitidas[i] == extensao) { 
              permitida = true; 
              break; 
              } 
           } 
           if (!permitida) { 
              meuerro = "Verifique a extensão do arquivo. \nSó se podem subir arquivos com a extenção: " + extensoes_permitidas.join(); 
              evento_click.preventDefault();
             }else{ 
                     //submeto! 
//              alert ("Tudo correto. Vou submeter o formulário."); 
              formulario.submit(); 
              return 1; 
             } 
        } 
        //se estou aqui é porque não se pode submeter 
        swal(
            'Oops...',
            meuerro,
            'error'
          )
//        alert (meuerro); 
        return 0; 
     } 
</script>