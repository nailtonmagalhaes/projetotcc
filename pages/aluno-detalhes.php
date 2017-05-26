<?php
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
    if($pessoa && isset($_GET['id'])){
        include_once "menu.php";
        $pessoa->pesId = $_GET['id'];
        $pessoa->carregarDados();
    }else{
        header('location: index.php');
    }
?>

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
                        	<form action="pessoa-excluir.php" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="idaluno" value="<?php echo $pessoa->pesId;?>">
                            		<input type="hidden" name="id" id="nomealuno" value="<?php echo $pessoa->pesNome;?>">
                                    
                                    <!-- DADOS PESSOAIS -->
                                    <fieldset>
                                        <legend>Dados Pessoais</legend>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nome</th>
                                                            <th>CPF</th>
                                                            <th>RG</th>
                                                            <th>Sexo</th>
                                                            <th>Data Nasc.</th>
                                                            <th>Situação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span><?php echo $pessoa->pesNome;?></span>
                                                            </td>
                                                            <td>
                                                                <span><?php echo Mascaras::geraMascara($pessoa->pesCpf, '###.###.###-##');?></span>
                                                            </td>
                                                            <td>
                                                                <span><?php echo Mascaras::geraMascara($pessoa->pesRg, '##.###.###-#');?></span>
                                                            </td>
                                                            <td>
                                                                <span><?php echo $pessoa->pesSexo == 0 ? "Feminino" : "Masculino";?></span>
                                                            </td>
                                                            <td>
                                                                <span><?php echo $pessoa->dataNascimentoFormatada();?></span>
                                                            </td>
                                                            <td>
                                                                <span><?php echo $pessoa->situacaoDescricao();?></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <!--CONTATOS-->
                                    <?php
                                        if(count($pessoa->pesTelefones)>0){ ?>
                                                                                            
                                            <fieldset>
                                                <legend>Contatos</legend>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Número</th>
                                                                    <th>Tipo</th>
                                                                </tr>
                                                            </thead>
                                                            <?php foreach ($pessoa->pesTelefones as $telefone) {
                                                                ?>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <span><?php echo Mascaras::geraMascaraTelefone($telefone->telNumero);?></span>
                                                                            </td>
                                                                            <td>
                                                                                <span><?php echo $telefone->tipoDescricao();?></span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                <?php
                                                            } ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <?php 
                                        }
                                    ?>

                                    <!--ENDEREÇOS-->
                                    <?php
                                        if(count($pessoa->pesEnderecos) > 0){ ?>
                                            <fieldset>
                                                <legend>Endereços</legend>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>CEP</th>
                                                                    <th>Endereço</th>
                                                                    <th>Nº</th>
                                                                    <th>Complemento</th>
                                                                    <th>Bairro</th>
                                                                    <th>Cidade</th>
                                                                    <th>Estado</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($pessoa->pesEnderecos as $endereco) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <span><?php echo Mascaras::geraMascara($endereco->endCep, '##.###-###');?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?php echo utf8_encode($endereco->endLogradouro);?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?php echo $endereco->endNumero;?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?php echo utf8_encode($endereco->endComplemento);?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?php echo utf8_encode($endereco->endBairro);?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?php echo utf8_encode($endereco->endCidade->cidNome);?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span><?php echo utf8_encode($endereco->endCidade->cidEstado->estNome);?></span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            <?php
                                                        } ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <?php
                                        }                                        
                                    ?>                                    
                                </div>
                                <div class="form-group col-lg-12">
                                    <button class="btn btn-primary edit" type="button" title="Editar" onclick="javascript: location.href='aluno-cadastro.php?id=<?php echo $pessoa->pesId."&";?>tipo=<?php echo SHA1($pessoa->pesPerfil); ?>';"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                    <button class="btn btn-danger delete" type="submit" name="btn-excluir-aluno" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
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
        var nome = document.getElementById("nomealuno").value;

        swal({
			  title: "Deseja realmente excluir o aluno "+nome+"?",
			  text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Excluir",
			  cancelButtonText: "Cancelar",
			  closeOnConfirm: false
			},
			function(){
				$.post("pessoa-excluir.php", {id:id}, function(data){
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
