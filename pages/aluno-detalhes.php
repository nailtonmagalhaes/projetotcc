<?php	
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'aluno.php';
    include_once 'utils.php';
    $aluno = new Aluno();

	if(isset($_GET["id"])){
		$aluno->pesId = $_GET["id"];
	}elseif (isset($_POST["id"])) {
		$aluno->pesId = $_POST["id"];
	}

	$aluno->carregarDados();
?>

<style type="text/css">
    label {
        display: inline-block;
        text-align: right;
        width: 150px;
    }
</style>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">Detalhes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label>Detalhes do Aluno</label>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        	<form action="aluno-excluir.php" method="post">
                                <div class="form-group">
                            		<input type="hidden" name="id" id="idaluno" value="<?php echo $aluno->pesId;?>">
                                    <fieldset>
                                        <legend>Dados Pessoais</legend>
                                        <div>
                                            <label>Nome:&nbsp;</label><span><?php echo $aluno->pesNome;?></span>
                                        </div>
                                        <div>
                                            <label>CPF:&nbsp;</label><span><?php echo Mascaras::geraMascara($aluno->pesCpf, '###.###.###-##');?></span>
                                        </div>
                                        <div>
                                            <label>RG:&nbsp;</label><span><?php echo Mascaras::geraMascara($aluno->pesRg, '##.###.###-#');?></span>
                                        </div>
                                        <div>
                                            <label>Sexo:&nbsp;</label><span><?php echo $aluno->pesSexo == 0 ? "Feminino" : "Masculino";?></span>
                                        </div>
                                        <div>
                                            <label>Data de Nascimento:&nbsp;</label><span><?php echo $aluno->dataNascimentoFormatada();?></span>
                                        </div>
                                        <div>
                                            <label>Situação:&nbsp;</label><span><?php echo $aluno->situacaoDescricao();?></span>
                                        </div>
                                    </fieldset>
                                    
                                    <!--CONTATOS-->
                                    <?php
                                        if(count($aluno->pesTelefones)>0){ ?>
                                            <fieldset>
                                                <legend>Contatos</legend>
                                                <?php foreach ($aluno->pesTelefones as $telefone) {
                                                    ?>
                                                    <div>
                                                        <label>Número:&nbsp;</label><span><?php echo Mascaras::geraMascara($telefone->telNumero, "(##) #####-####");?></span>&nbsp;<label>Tipo:&nbsp;</label><span><?php echo $telefone->tipoDescricao();?></span>
                                                    </div>
                                                    <?php
                                                } ?>
                                            </fieldset>
                                            <?php 
                                        }
                                    ?>
                                    <!--ENDEREÇOS-->
                                    <?php
                                        if(count($aluno->pesEnderecos) > 0){ ?>
                                            <fieldset>
                                                <legend>Endereços</legend>
                                                <?php foreach ($aluno->pesEnderecos as $endereco) {
                                                    ?>
                                                    <div>
                                                        <label>CEP:&nbsp;</label><span><?php echo Mascaras::geraMascara($endereco->endCep, '##.###-###');?></span>
                                                    </div>
                                                    <div>
                                                        <label>Endereço:&nbsp;</label><span><?php echo utf8_encode($endereco->endLogradouro);?></span>&nbsp;<label>Número:&nbsp;</label><span><?php echo $endereco->endNumero;?></span>
                                                    </div>
                                                    <div>
                                                        <label>Complemento:&nbsp;</label><span><?php echo utf8_encode($endereco->endComplemento);?></span>
                                                    </div>
                                                    <div>
                                                        <label>Bairro:&nbsp;</label><span><?php echo utf8_encode($endereco->endBairro);?></span>
                                                    </div>
                                                    <div>
                                                        <label>Cidade:&nbsp;</label><span><?php echo utf8_encode($endereco->endCidade->cidNome);?></span>
                                                    </div>
                                                    <div>
                                                        <label>Estado:&nbsp;</label><span><?php echo utf8_encode($endereco->endCidade->cidEstado->estNome);?></span>
                                                    </div>
                                                    <?php
                                                } ?>
                                            </fieldset>
                                            <?php
                                        }                                        
                                    ?>
                                    
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
	$('button[name="btn-excluir-aluno"]').on('click', function (e) {
        e.preventDefault();
        
        var id = document.getElementById("idaluno").value;

        swal({
			  title: "Deseja realmente excluir o aluno?",
			  text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Excluir",
			  cancelButtonText: "Cancelar",
			  closeOnConfirm: false
			},
			function(){
				$.post("aluno-excluir.php", {id:id}, function(data){
                    if(data){
                        swal("Aluno excluído com sucesso!","","success");
                        window.setTimeout("location.href='../pages/aluno-listar.php'", 1000);
                    }else{
                        swal("Error",data,"warning");
                    }
                });
			});
    });
</script>
