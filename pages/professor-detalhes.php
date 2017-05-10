<?php
	include_once "menu.php";
    include_once 'includes.php';

	if(count($_GET) > 0 && $_GET['id'] <> ""){
            $sql = "SELECT * FROM tbPessoa WHERE Id = ".$_GET['id'];

            $resultado = listar($sql);

            $id;
            $nome;
            $cpf;
            $rg;
            $sexo;
            $senha;
            $data_nasc;
            $perfil;

             if($resultado){
                while($row = $resultado->fetch_assoc()){                                                                                                                      
                    $id = $row["Id"];
                    $nome = $row["Nome"];
                    $cpf = $row["Cpf"];
                    $rg = $row["Rg"];
                    $sexo = $row["Sexo"];
                    $senha = $row["Senha"];
                    $data_nasc = $row["DataNascimento"];
                    $perfil = $row["Perfil"];
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
                                        Detalhes do Professor
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                                   <form action=<?php echo "\"curso-excluir.php\" method=\"post\">"; ?>
                                                                            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
                                                                        <div class="form-group">
                                                                            <label>Código: <?php echo isset($id) ? $id : ''; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Nome: <?php echo isset($nome) ? $nome : ''; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>CPF: <?php echo isset($cpf) ? $cpf : ''; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>RG: <?php echo isset($rg) ? $rg : ''; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Sexo: <?php echo isset($sexo) ? $sexo : ''; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Senha: <?php echo isset($senha) ? $senha : ''; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Data de Nascimento: <?php echo isset($senha) ? $senha : ''; ?></label>
                                                                        </div>
                                                    <button class="btn btn-primary edit" type="button" title="Editar" <?php echo "onclick=\"javascript: location.href='professor-cadastro.php?id=".$id."&nome=".$nome."&cpf=".$cpf."&rg=".$rg."&cpf=".$cpf."&perfil=".$perfil."&sexo=".$sexo."&senha=".$senha."&DataNascimento=".$data_nasc."'";?>"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
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