<?php 
	include_once "menu.php";
    include_once 'includes.php';
 ?>

    
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Professor</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabela de Professor
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>RG</th>
                                <th>Data de nascimento</th>
                                <th>Perfil</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                try{
                                    $resultado = listar("SELECT * FROM tbPessoa WHERE Situacao = 1 AND Perfil = 2");
                                    if ($resultado && $resultado->num_rows > 0) {
                                        while($row = $resultado->fetch_assoc()){                                                                                                                      
                                            $id = $row["Id"];
                                            $nome = $row["Nome"];
                                            $cpf = $row["Cpf"];
                                            $rg = $row["Rg"];
                                            $sexo = $row["Sexo"];
                                            $senha = $row["Senha"];
                                            $data_nasc = $row["DataNascimento"];
                                            $perfil = $row["Perfil"];
                                            $situacao = $row["Situacao"];
                                            
//                                            echo '<pre>';
//                                            var_dump("SELECT * FROM tbEndereco WHERE id = {$id}");die;
                                            
//                                            $resultadoCidade = listar("SELECT GROUP_CONCAT(Nome) as cidades FROM tbcidade");
//                                            $resultadoCidade = $resultadoCidade->fetch_assoc();
//                                            $resultadoEndereco = $resultadoEndereco->fetch_row();
//                                            
//                                            echo '<pre>';
//                                            var_dump($resultadoCidade['cidades']);die;
                                            
                                          
                                    ?>
                                        <tr class="odd gradeX">
                                            <td> <?php echo $id; ?> </td>
                                            <td> <?php echo $nome; ?> </td>
                                            <td> <?php echo $cpf; ?> </td>
                                            <td> <?php echo $rg; ?> </td>
                                            <td> <?php echo $data_nasc; ?> </td>
                                            <td> <?php echo $perfil; ?> </td>
<!--                                            <td> <?php echo $situacao; ?> </td>-->
                                            <td>
                                                <form action=<?php echo "\"professor-excluir.php\" method=\"post\">"; ?>
                                                    <?php 
                                                        echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\">";
                                                        echo "<button class=\"btn btn-default info\" type=\"button\" title=\"Detalhes\" onclick=\"javascript: location.href='professor-detalhes.php?id=".$id."';\"><i class=\"glyphicon glyphicon-file\" title=\"Detalhes\"></i></button>"; 
                                                        echo "<button class=\"btn btn-primary edit\" type=\"button\" title=\"Editar\" onclick=\"javascript: location.href='professor-cadastro.php?id=".$id."&nome=".$nome."&cpf=".$cpf."&rg=".$rg."&cpf=".$cpf."&perfil=".$perfil."&sexo=".$sexo."&senha=".$senha."&DataNascimento=".$data_nasc."&situacao=".$situacao."';\"><i class=\"glyphicon glyphicon-edit\" title=\"Editar\"></i></button>"; 
                                                        echo "<button class=\"btn btn-danger delete\" type=\"submit\" name=\"remove_levels\" title=\"Excluir\"><i class=\"glyphicon glyphicon-trash\" title=\"Excluir\"></i></button>"; 
                                                    ?> 
                                                </form>
                                            </td>
                                        </tr>
                                		 <?php 
                                        } 
                                    }
                                } catch (Exception $e) {
                                    echo $e->getMessage();
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>            
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
	$(document).ready(function() {
	    $('#dataTables-example').DataTable({
	        responsive: true,
            "language":{
               "url":"../js/Portuguese-Brasil.json"
            }
	    });
	});

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