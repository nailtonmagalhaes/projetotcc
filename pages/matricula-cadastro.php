<?php 
    include_once "menu.php";
    include_once 'matricula.php';
    include_once '../conf/acesso-dados.php';

    $matricula = new Material();

	if(isset($_GET['id'])){
		$matricula->matId = $_GET['id'];
	}else if(isset($_POST['id'])){
		$matricula->matId = $_POST['id'];
	}

	$matricula->carregarDados();
        
        $aluno = new Aluno();
        
        $aluno = $aluno->listar();
        
        $turma = new Turma();
        
        $turma = $turma->listar();
//        var_dump($turma->fetch_all());die;
        
    
?>
<head>
    <style>
       .ui-autocomplete {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        float: left;
        display: none;
        min-width: 160px;   
        padding: 4px 0;
        margin: 0 0 10px 25px;
        list-style: none;
        background-color: #ffffff;
        border-color: #ccc;
        border-color: rgba(0, 0, 0, 0.2);
        border-style: solid;
        border-width: 1px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
        *border-right-width: 2px;
        *border-bottom-width: 2px;
    }
    
    ul.ui-autocomplete.ui-menu{width:400px}
    ul.ui-autocomplete.ui-menu li:first-child a{
        color:blue;
    }

    .ui-menu-item > a.ui-corner-all {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;
        text-decoration: none;
    }

    .ui-state-hover, .ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
    }
    </style>
    <script type="text/javascript" src="../js/js-validacao-generica.js"></script>
</head>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header"><?php echo !empty($matricula->matId) ? "Alteração" : "Cadastro";?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <?php echo !empty($matricula->matId) ? "Alterar Material" : "Matricular Aluno";?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
					       <form role="form" id="formcadastrar" action="matricula-salvar.php" method="post" enctype="multipart/form-data">
					            <div class="form-group">
					                <input type="hidden" class="form-control" name="matId" id="matId" value="<?php echo $matricula->matId; ?>">
					            </div>
					           
                                                    <div class="form-group">
                                                        <label class="control-label" for="matAluno">Aluno</label>
                                                        <select class="form-control obrigatorio" name="matAluno" id="matAluno" style="color: gray;">
                                                            <option value="">Selecione um Aluno</option>';
                                                            <?php
                                                            try{
                                                                if ($aluno && $aluno->num_rows > 0) {
                                                                    foreach($aluno as $alu1){
                                                                        $ida1 = $alu1["Id"];
                                                                        $nomea1 = $alu1["Nome"];
                                                                        echo '<option value="'.$ida1.'"'.($ida1 == $matricula->matId ? "selected" : null).'>'.$nomea1.'</option>';   
                                                                    }   
                                                                }
                                                            } catch (Exception $e) {
                                                                echo $e->getMessage();
                                                            }
                                                                
                                                            ?>
                                                        </select>
                                                        <span class="msg-matAluno"></span>
                                                    </div>
                                                   
                                                   <div class="form-group">
                                                        <label class="control-label" for="matTurma">Turma</label>
                                                            <input class="form-control" type="text" name="matTurma" id="matTurma" value="" placeholder="Selecione uma turma">
                                                            <input style="visibility: hidden;" name="idmatTurma" type="text" id="idmatTurma" value="">
                                                        <span class="msg-matTurma"></span>
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
<script>

$('#matTurma').autocomplete({
	source: function(request, response){
//            console.log(busca.term)
            $.ajax({
                        url : 'turma_autocomplete.php', /* URL que será chamada */ 
                        type : 'POST', /* Tipo da requisição */ 
                        data: 'term='+request.term , /* dado que será enviado via POST */
                        dataType: 'json', /* Tipo de transmissão */
                        success: function(data){
//                            for(var i=0;i<data.length;i++){
//                                console.log(data[i])
//                            }

                               response(data);
                        }
            })
        },
        select: function(event,ui){
//            console.log(ui.item.id);
            $('#idmatTurma').val(ui.item.id);
        }
})

</script>


