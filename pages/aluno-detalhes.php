<?php
	include_once "menu.php";
    include_once 'includes.php';

	if(count($_GET) > 0 && $_GET['id'] <> ""){
		//$sql = "SELECT * FROM tbPessoa p inner join tbEndereco e  on p.id = e.idpessoa  WHERE p.Id = ".$_GET['id'];
		$sql = "SELECT * From tbPessoa where id =".$_GET['id'];
		 $resultado = listar($sql);
		 $id;
		 $nome;
		 $cpf;
		 $rg;
		 $sexo;
		 $datanasc;
		 $perfil;
		 $situcao;
		 $endereco;
		 echo "resultado";

		 if($resultado){
		 	while($row = $resultado->fetch_assoc()){                                                                                                                      
                $id = $row["Id"];
                $nome = $row["Nome"];
                $cpf = $row["Cpf"];
                $rg = $row["Rg"];
                $sexo = $row["Sexo"];
                $datanasc = $row["DataNascimento"];
                $perfil = $row["Perfil"];
                $situacao = $row["Situacao"];
                
                
		 	}
		 	?>
		 	<div id="page-wrapper">
			    <div class="row">
			        <div class="col-lg-12">
			            <h1 class="page-header">Detalhes</h1>
			        </div>
			        <!-- /.col-lg-12 -->
			    </div>
			    <!-- /.row -->
			    <div class="row">
			        <div class="col-lg-12">
			            <div class="panel panel-default">
			                <div class="panel-heading">
			                    Detalhes do Aluno
			                </div>
			                <div class="panel-body">
			                    <div class="row">
			                        <div class="col-lg-6">
								       <form action=<?php echo "\"aluno-excluir.php\" method=\"post\">"; ?>
								       		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
								            <div class="form-group">
								                <label>Código: <?php echo isset($id) ? $id : ''; ?></label>
								            </div>
								            <div class="form-group">
								                <label> Nome: <?php echo isset($nome) ? $nome : ''; ?></label>
								            </div>
								            <div class="form-group">
								                <label>CPF: <?php echo isset($cpf) ? $cpf : ''; ?></label>
								            </div>
								            <div class="form-group">
								                <label>RG: <?php echo isset($rg) ? $rg : ''; ?></label>
								            </div>
								            <div class="form-group">
								            	<label>Sexo: <?php if ($sexo == "1") {
								            		echo "Masculino";}
								            		else{
								            		echo "Feminino";}
								            	 ?></label>
								            </div>
								            <div class="form-group">
								            	<label> Situação: <?php if ($situacao == "1") {
								            		echo("Ativo");
								            	}else{
								            	     echo "Inativo";								            		
								            	}
								            	 ?>
								            		
								            	</label>
								            </div>
			                                <button class="btn btn-primary edit" type="button" title="Editar" <?php echo "onclick=\"javascript: location.href='aluno-cadastro.php?id=".$id."&nome=".$nome."&cpf=".$cpf."&Situacao=".$situacao."'";?>"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
			                                <button class="btn btn-danger delete" type="submit" name="remove_levels" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
								        </form>
							        </div>
							    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
		}
	}
?>

<script>
	$('button[name="remove_levels"]').on('click', function (e) {
        var $form = $(this).closest('form');
        e.preventDefault();
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
          .one('click', '#btn-confirmar-exclusao', function (e) {
              $form.trigger('submit');
          });
    });
</script>

<?php include_once "../pages/modal-confirmar-exclusao.php";