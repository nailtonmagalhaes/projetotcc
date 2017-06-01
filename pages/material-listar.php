<?php 
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'material.php';
 ?>
  
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Material</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabela de Materiais
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><center>Código</center></th>
                                <th><center>Descrição</center></th>
                                <th><center>Ano</center></th>
                                <th><center>Link</center></th>
                                <th><center>Situação</center></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                try{
                                    $materiais = Material::listar();

                                    if ($materiais && $materiais->num_rows > 0) {
                                        while($row = $materiais->fetch_assoc()){                                                                                                                      
                                            $id = $row["Id"];
                                            $descricao = $row["Descricao"];
                                            $ano = $row["Ano"];
                                            $situacao = $row["Situacao"];
                                            $link = $row["Link"];
                        				echo '
                                        <tr class="odd gradeX">
                                            <td class="idmaterial"><center>'.$id.'</center></td>
                                            <td class="descricao">'.$descricao.'</td>
                                            <td><center>'.$ano.'</center></center></td>
                                            <td><center>'.$link.'<a href="../uploads/'.$link.'"> Abrir arquivo </a>'.'</center></td>
                                            <td><center>'.$situacao.'</center></td>
                                            <td><center>';
                                            if(EPerfil::Professor == $_SESSION['perfil'] || EPerfil::Secretaria == $_SESSION['perfil']){
                                                echo '<div hidden>
                                                    <button class="btn btn-default info" type="button" title="Detalhes" onclick="location.href=\'material-detalhes.php?id='.$id.'\'"><i class="glyphicon glyphicon-file" title="Detalhes"></i></button>
                                                    &nbsp; 
                                                </div>
                                                
                                                <button class="btn btn-primary edit" type="button" title="Editar" onclick="location.href=\'material-cadastro.php?id='.$id.'\'"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                                &nbsp;
                                                
                                                <button class="btn btn-danger delete" type="submit" name="btn-excluir-material" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>';
                                            }
                                            echo '</center></td>
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
            },
	    });
	});

    $('button[name="btn-excluir-material"]').on('click', function (e) {

        e.preventDefault();

        var id =  $(this).parent().parent().siblings('.idmaterial').text();
        var nomematerial =  $(this).parent().parent().siblings('.descricao').text();
        swal({
              title: "Deseja excluir o material '"+ nomematerial +"'?",
              text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Excluir",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false
            },
            function(){
                $.post("material-excluir.php", {id:id}, function(data){
//                    console.log(data);
                    if(data && data.success){
                        swal(data.message,"","success");
                        window.setTimeout("location.href='../pages/material-listar.php'", 1000);
                    }else{
                        swal(data.message, "","warning");
                    }
                });
            }
        );
    });

</script>