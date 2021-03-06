<?php
    if($curso == null){
        header('location: ../pages/index.php');
    }
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
                                                &nbsp;'; 
                                                if(EPerfil::Secretaria == $_SESSION['perfil']){
                                                    echo '<button class="btn btn-primary edit" type="button" title="Editar" onclick="javascript: location.href=\'curso-cadastro.php?id='.$id.'&descricao='.$descricao.'\';"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                                    &nbsp;';
                                                    if($row['Ativo'] == 0){
                                                        echo '<button class="btn btn-success" type="button" name="btn-ativar-curso" title="Ativar"><i class="glyphicon glyphicon-check" title="Ativar"></i></button>';
                                                    }else{
                                                        echo '<button class="btn btn-danger delete" type="button" name="btn-excluir-curso" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>';
                                                    }
                                                }
                                            echo '</td>
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
                    if (data && data.success) {
                        swal(data.message,"","success");
                        window.setTimeout("location.href='../pages/curso-listar-ativos.php'",1000);
                    }else{
                        swal(data.message,"","warning");
                    }
                });
            });
    });

    $('button[name="btn-ativar-curso"]').on('click', function (e) {

        e.preventDefault();

        //var $form = $(this).closest('form');
        var id = $(this).parent().siblings('.idcurso').text();
        var nomecurso = $(this).parent().siblings('.nomecurso').text();



        swal({
            title: "Deseja reativar o curso '" + nomecurso + "'?",
            text: "Clique em Ativar para confirmar ou em Cancelar para cancelar!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "green",
            confirmButtonText: "Ativar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false
        },
            function () {
                $.post("curso-ativar.php", { id: id }, function (data) {
                    if (data && data.success) {
                        swal(data.message, "", "success");
                        window.setTimeout("location.href='../pages/curso-listar-ativos.php'", 1000);
                    } else {
                        swal(data.message, "", "warning");
                    }
                });
            });
    });

</script>
