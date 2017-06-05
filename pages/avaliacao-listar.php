<?php
    include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'avaliacao.php';

    $ava = new Avaliacao();
    $resultado = $ava->listar();
?>
  
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Avaliações</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabela de Avaliações
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Aluno</th>
                                <th>Matrícula</th>
                                <th>Curso</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                try{
                                    if ($resultado && $resultado->num_rows > 0) {
                                        while($row = $resultado->fetch_assoc()){?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $row['Data'];?></td>
                                                <td><?php echo $row['Tipo'];?></td>
                                                <td><?php echo $row['Aluno'];?></td>
                                                <td><?php echo $row['Matricula'];?></td>
                                                <td><?php echo $row['Curso'];?></td>
                                                <td>
                                                    <button class="btn btn-default info" type="button" title="Detalhes" onclick="javascript: location.href='avaliacao-detalhes.php?id=<?php echo $row['Id']?>;"><i class="glyphicon glyphicon-file" title="Detalhes"></i></button>
                                                  
                                                    <?php if(EPerfil::Secretaria == $_SESSION['perfil']){ ?>
                                                        &nbsp; <button class="btn btn-primary edit" type="button" title="Editar" onclick="javascript: location.href='avaliacao-cadastro.php?id=<?php echo $row['Id']?>';"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                                    <?php } ?>
                                                </td>
                                        </tr>
                                        <?php } 
                                    }
                                } catch (Exception $e) {
                                    echo $e->getMessage();
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

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
