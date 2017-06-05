<?php
include_once "permissao-secretaria.php";
include_once "menu.php";
include_once '../conf/acesso-dados.php';
include_once 'matricula.php';
include_once 'avaliacao.php';

$av = new Avaliacao();

if(isset($_GET['id'])){
    $av->avaId = $_GET['id'];
}else if(isset($_POST['id'])){
    $av->avaId = $_POST['id'];
}

$av->carregarDados();

$matriculas = Matricula::carregarCombo();

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header"><?php echo !empty($av->avaId) ? "Alteração" : "Cadastro";?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <?php echo !empty($av->avaId) ? "Alterar Avaliação" : "Cadastrar Avaliação";?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" id="formcadastrar" action="avaliacao-salvar.php" method="post">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="avaId" id="avaId" value="<?php echo $av->avaId; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="avaMatricula">Matrícula</label>
                                    <select class="form-control obrigatorio" name="avaMatricula" id="avaMatricula" style="color: gray;">
                                        <option value="">Selecione uma matrícula</option>
                                        <?php try{
                                                  if ($matriculas && $matriculas->num_rows > 0) {
                                                      while($row = $matriculas->fetch_assoc()){
                                                          $idc = $row["Id"];
                                                          $desc = $row["Descricao"];
                                                          echo '<option value="'.$idc.'"'.($idc == $av->avaMatricula->matId ? "selected" : null).'>'.$desc.'</option>';   
                                                      }   
                                                  }
                                              }
                                              catch (Exception $e) {
                                                  echo $e->getMessage();
                                              }
                                        ?>
                                    </select>
                                    <span class="msg-avaMatricula"></span>
                                </div>                                
                                <div class="form-group">
                                    <label class="control-label" for="avaData">Data da Avaliação</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control obrigatorio datepicker data" name="avaData" id="avaData" value="<?php echo $av->dataFormatada();?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                    <span class="msg-avaData"></span>
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
$(document).ready(function(){

    $('.input-group.date').datepicker({
        format: "dd/mm/yyyy",
        startDate: '0',
        language: "pt-BR",
        autoclose: true,
        clearBtn: true,
        todayHighlight: true,
        calendarWeeks: true,
    });    
});
</script>