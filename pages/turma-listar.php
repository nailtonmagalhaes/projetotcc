<?php 
	include_once "menu.php";
	include_once "turma.php";
    include_once '../conf/acesso-dados.php';
 ?>
  
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Turma</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabela de Turmas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><center>Código</center></th>
                                <th><center>Curso</center></th>
                                <th><center>Duração (horas)</center></th>
                                <th><center>Data Início</center></th>
                                <th><center>Situação</center></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                try{
                                    $turmas = Turma::listar();

                                    if ($turmas && $turmas->num_rows > 0) {
                                        while($row = $turmas->fetch_assoc()){                                                                                                                      
                                            $id = $row["Id"];
                                            $dataInicio = $row["DataInicioFormatada"];
                                            $curso = $row["Curso"];
                                            $situacao = $row["Situacao"];
                                            $duracao = $row["Duracao"];
                        				echo '
                                        <tr class="odd gradeX">
                                            <td class="idturma"><center>'.$id.'</center></td>
                                            <td class="curso">'.$curso.'</td>
                                            <td><center>'.$duracao.'</center></center></td>
                                            <td><center>'.$dataInicio.'</center></td>
                                            <td><center>'.$situacao.'</center></td>
                                            <td><center>
                                                <button class="btn btn-default info" type="button" title="Detalhes" onclick="location.href=\'turma-detalhes.php?id='.$id.'\'"><i class="glyphicon glyphicon-file" title="Detalhes"></i></button>
                                                &nbsp; 
                                                
                                                <button class="btn btn-primary edit" type="button" title="Editar" onclick="location.href=\'turma-cadastro.php?id='.$id.'\'"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                                &nbsp; 

                                                <button class="btn btn-danger delete" type="submit" name="btn-excluir-turma" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
                                            </center></td>
                                        </tr>';
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
            },
	    });
	});

    $('button[name="btn-excluir-turma"]').on('click', function (e) {

        e.preventDefault();

        var id =  $(this).parent().parent().siblings('.idturma').text();
        var nomecurso =  $(this).parent().parent().siblings('.curso').text();
        swal({
              title: "Deseja excluir a turma do curso '"+ nomecurso +"'?",
              text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Excluir",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false
            },
            function(){
                $.post("turma-excluir.php", {id:id}, function(data){
                    if(data){
                        swal("Turma excluída com sucesso!","","success");
                        window.setTimeout("location.href='../pages/turma-listar.php'", 2000);
                    }else{
                        swal("Error",data,"warning");
                    }
                });
            }
        );
    });

</script>