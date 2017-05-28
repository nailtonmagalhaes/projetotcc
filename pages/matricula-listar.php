<?php 
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once './matricula.php';
 ?>
  
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Matricula</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabela de Matrículas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><center>Código</center></th>
                                <th><center>Curso</center></th>
                                <th><center>Aluno</center></th>
                                <th><center>Data de Início da Turma</center></th>
                                <th><center>Situação</center></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                try{
                                    $materiais = Matricula::listar();

                                    if ($materiais && $materiais->num_rows > 0) {
                                        while($row = $materiais->fetch_assoc()){                                                                                                                      
                                            $id = $row["IdMatricula"];
                                            $idturma = $row["IdTurma"];
                                            $curso = $row["Curso"];
                                            $datainicio = $row["DataInicio"];
                                            $nome = $row["Nome"];
                                            $situacao = $row["Situacao"];
                        				echo '
                                        <tr class="odd gradeX">
                                            <td class="idmatricula"><center>'.$id.'</center></td>
                                            <td class="curso">'.$curso.'</td>
                                            <td class="nome"><center>'.$nome.'</center></center></td>
                                            <td><center>'.$datainicio.'</center></td>
                                            <td><center>'.$situacao.'</center></td>
                                            <td><center>
                                                <div hidden>
                                                    <button class="btn btn-default info" type="button" title="Detalhes" onclick="location.href=\'matricula-detalhes.php?id='.$id.'\'"><i class="glyphicon glyphicon-file" title="Detalhes"></i></button>
                                                    &nbsp; 
                                                </div>
                                                
                                                <button class="btn btn-primary edit" type="button" title="Editar" onclick="location.href=\'matricula-cadastro.php?id='.$id.'\'"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                                &nbsp;
                                                
                                                <button class="btn btn-danger delete" type="submit" name="btn-excluir-matricula" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
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

    $('button[name="btn-excluir-matricula"]').on('click', function (e) {

        e.preventDefault();

        var id =  $(this).parent().parent().siblings('.idmatricula').text();
        var nomematricula =  $(this).parent().parent().siblings('.nome').text();
        var nomecurso =  $(this).parent().parent().siblings('.curso').text();
        swal({
              title: "Deseja excluir a matricula de "+nomematricula+" no curso "+nomecurso+"?",
              text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Excluir",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false
            },
            function(){
                $.post("matricula-excluir.php", {id:id}, function(data){
                    console.log(data);
                    if(data){
                        swal("Matricula excluída com sucesso!","","success");
//                        window.setTimeout("location.href='../pages/matricula-listar.php'", 1000);
                    }else{
                        swal("Error",data,"warning");
                    }
                });
            }
        );
    });

</script>