<?php 
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'curso.php';
 ?>
  
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cursos</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabela de Cursos
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
                                <th>Duração(horas)</th>
                                <th>Situação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                try{
                                    $curso = new Curso();
                                    $resultado = $curso->listar();
                                    if ($resultado && $resultado->num_rows > 0) {
                                        while($row = $resultado->fetch_assoc()){                                                                                                                      
                                            $id = $row["Id"];
                                            $descricao = $row["Descricao"];
                                            $duracao = $row["Duracao"];
                                            $situacao = $row["Situacao"];
                        				echo
                                        '<tr class="odd gradeX">
                                            <td class="idcurso">'.$id.'</td>
                                            <td class="nomecurso">'.$descricao.'</td>
                                            <td>'.$duracao.'</td>
                                            <td>'.$situacao.'</td>
                                            <td>
                                                <button class="btn btn-default info" type="button" title="Detalhes" onclick="javascript: location.href=\'curso-detalhes.php?id='.$id.'\';"><i class="glyphicon glyphicon-file" title="Detalhes"></i></button>
                                                &nbsp; 

                                                <button class="btn btn-primary edit" type="button" title="Editar" onclick="javascript: location.href=\'curso-cadastro.php?id='.$id.'&descricao='.$descricao.'\';"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                                &nbsp; 

                                                <button class="btn btn-danger delete" type="button" name="btn-excluir-curso" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
                                            </td>
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


    $('button[name="btn-excluir-curso"]').on('click', function (e) {
        
        e.preventDefault();

        //var $form = $(this).closest('form');
        var id =  $(this).parent().siblings('.idcurso').text();
        var nomecurso =  $(this).parent().siblings('.nomecurso').text();
        swal({
              title: "Deseja excluir o curso '"+ nomecurso +"'?",
              text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Excluir",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false
            },
            function(){
                $.post("curso-excluir.php", {id:id}, function(data){
                    if(data){
                        swal("Curso excluído com sucesso!","","success");
                        window.setTimeout("location.href='../pages/curso-listar.php'",2000);
                    }else{
                        swal("Error","","warning");
                    }
                    // if(data.error)
                    // {
                    //     swal(data, "", "warning");
                    // }else{
                    //     swal(data, "", "success");
                    //     window.setTimeout("location.href='../pages/curso-listar.php'",2000);
                    // }
                });
            });
    });

</script>
