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
                                                        <select class="form-control obrigatorio" name="matTurma" id="matTurma" style="color: gray;">
                                                            <option value="">Selecione uma Turma</option>';
                                                            <?php
                                                            try{
                                                                if ($turma && $turma->num_rows > 0) {
                                                                    foreach($turma as $tur1){
//                                                                        echo '<pre>';
//                                                                        var_dump($alu1);
                                                                        $idt1 = $tur1["Id"];
                                                                        $nomet1 = "Curso: ".$tur1["Curso"]." - Início: ".$tur1["DataInicioFormatada"]." - Professor: ".$tur1["Nome"]." - Dias: ".$tur1["Dias"];
                                                                        echo '<option class="select_texto" value="'.$idt1.'"'.($idt1 == $matricula->matTurma ? "selected" : null).'>'.$nomet1.'</option>';   
                                                                    }   
                                                                }
                                                            } catch (Exception $e) {
                                                                echo $e->getMessage();
                                                            }
                                                                
                                                            ?>
                                                        </select>
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