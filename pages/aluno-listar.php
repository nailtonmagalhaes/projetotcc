 <?php 
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'aluno.php';
    include_once 'utils.php';
 ?>

    
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Alunos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabela de Alunos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>RG</th>
                                        <th>Sexo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody> 
                                        <?php 
                                                try{
                                                    $a = new Aluno();
                                                    $resultado = $a->listar();
                                                    if ($resultado !=  null) {
                                                    if ($resultado->num_rows > 0) {
                                                    while($row = $resultado->fetch_assoc())
                                                        {
                                                            $id = $row["Id"];                                                                 
                                                            $nome = $row["Nome"];
                                                            $cpf = $row["Cpf"];
                                                            $rg = $row["Rg"];
                                                            $sexo = $row["Sexo"];
                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td> <?php echo $nome; ?></td>
                                                            <td> <?php echo mask($cpf,'###.###.###-##'); ?></td>
                                                            <td> <?php echo mask($rg,'##.###.###-#'); ?></td>
                                                            <td> <?php if ($sexo == 1) {
                                                                echo "Masculino";}
                                                                else
                                                                 {
                                                                    echo "Feminino";
                                                                     # code...
                                                                 } ?></td>
                                                                <td>
                                                <form action=<?php echo "\"aluno-excluir.php\" method=\"post\">"; ?>
                                                    <?php 
                                                        echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\">";
                                                        echo "<button class=\"btn btn-default info\" type=\"button\" title=\"Detalhes\" onclick=\"javascript: location.href='aluno-detalhes.php?id=".$id."';\"><i class=\"glyphicon glyphicon-file\" title=\"Detalhes\"></i></button>&nbsp;"; 
                                                        echo "<button class=\"btn btn-primary edit\" type=\"button\" title=\"Editar\" onclick=\"javascript: location.href='aluno-cadastro.php?id=".$id."&nome=".$nome."&cpf=".$cpf."&rg=".$rg."&sexo=".$sexo."';\"><i class=\"glyphicon glyphicon-edit\" title=\"Editar\"></i></button>&nbsp;"; 
                                                        echo "<button class=\"btn btn-danger delete\" type=\"submit\" name=\"remove_levels\" title=\"Excluir\"><i class=\"glyphicon glyphicon-trash\" title=\"Excluir\"></i></button>&nbsp;"; 
                                                    ?> 
                                                </form>
                                            </td>
                                                        </tr>
                                                 <?php 
                                                        } 
                                                                                 }}elseif ($resultado == null) { ?>
                                                                                     <h1><?php echo("Nao Existe Alunos Cadastrados ");?></h1>
                                                                                     
                                                                                     <script>
                                                                                     sweetAlert("Oops...", "Nao Existe Alunos Cadastrados", "error");
                                                                                     </script><?php
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

    </div>
    <!-- /#wrapper -->

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
    </script>

</body>

</html>
