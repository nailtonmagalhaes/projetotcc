<?php   
	include_once "menu.php";
    include_once "../conf/acesso-dados.php";
    include_once "autor.php";
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Autor</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabela de Autor
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Descrição</th>                                
                                <th>Situação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                try{
                                    $autor = new Autor();
                                    $resultado = $autor->listar();
                                    if ($resultado && $resultado->num_rows > 0) {
                                        while($row = $resultado->fetch_assoc()){                                                                                                                      
                                            $id = $row["Id"];
                                            $nome=$row["Nome"];
                                            $descricao = $row["Descricao"];                                            
                                            $situacao = $row["Situacao"];
                        				echo
                                        '<tr class="odd gradeX">
                                            <td class="idautor">'.$id.'</td>
                                            <td class="nomeautor">'.$nome.'</td>
                                            <td>'.$descricao.'</td>
                                            <td>'.$situacao.'</td>
                                            <td>
                                                <button class="btn btn-default info" type="button" title="Detalhes" onclick="javascript: location.href=\'autor-detalhes.php?id='.$id.'\';"><i class="glyphicon glyphicon-file" title="Detalhes"></i></button>
                                                &nbsp; 

                                                <button class="btn btn-primary edit" type="button" title="Editar" onclick="javascript: location.href=\'autor-cadastro.php?id='.$id.'&nome='.$nome.'&descricao='.$descricao.'\';"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                                &nbsp; 

                                                <button class="btn btn-danger delete" type="button" name="btn-excluir-autor" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
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


    $('button[name="btn-excluir-autor"]').on('click', function (e) {
        
        e.preventDefault();

        //var $form = $(this).closest('form');
        var id =  $(this).parent().siblings('.idautor').text();
        var nomeautor =  $(this).parent().siblings('.nomeautor').text();

       

        swal({
              title: "Deseja excluir o autor '"+ nomeautor +"'?",
              text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Excluir",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false
            },
            function(){
                $.post("autor-excluir.php", {id:id}, function(data){
                    if(data){
                        swal("Autor excluído com sucesso!","","success");
                        window.setTimeout("location.href='../pages/autor-listar.php'",1000);
                    }else{
                        swal("Error","","warning");
                    }
                });
            });
    });

</script>
