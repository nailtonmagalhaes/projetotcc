 <?php 
	
    include_once '../conf/acesso-dados.php';
    include_once 'aluno.php';
    include_once 'professor.php';
    include_once 'secretaria.php';
    include_once 'utils.php';

    $pessoa = null;
    $lista = null;
    if(isset($_GET['tipo'])){
        if($_GET['tipo'] == SHA1(EPerfil::Aluno)){
            $pessoa = new Aluno();
        }elseif($_GET['tipo'] == SHA1(EPerfil::Professor)){
            $pessoa = new Professor();
        }else if($_GET['tipo'] == SHA1(EPerfil::Secretaria)){
            $pessoa = new Secretaria();
        }
    }

    if($pessoa){
        include_once "menu.php";
        $lista = $pessoa->listar();
    }else{
        header('location: index.php');
    }
 ?>
    
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header"><?php echo $pessoa->perfilDescricaoPlural();?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Tabela de <?php echo $pessoa->perfilDescricaoPlural();?>
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
                                <th>Sexo</th>
                                <th>Situação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = $lista->fetch_assoc()){ ?>
                                    <tr>
                                        <td class="idpessoa"><?php echo $row['Id'];?></td>
                                        <td class="nome"><?php echo $row['Nome'];?></td>
                                        <td><?php echo $row['Cpf'];?></td>
                                        <td><?php echo $row['Rg'];?></td>
                                        <td><?php echo $row['SexoDescricao'];?></td>
                                        <td><?php echo $row['SituacaoDescricao'];?></td>
                                        <td>
                                            <SHA1 class="btn btn-default info" type="button" title="Detalhes" onclick="location.href='aluno-detalhes.php?id=<?php echo $row['Id'].'&tipo='.SHA1($row['Perfil']);?>'"><i class="glyphicon glyphicon-file" title="Detalhes"></i></SHA1>
                                            &nbsp; 
                                            
                                            <button class="btn btn-primary edit" type="button" title="Editar" onclick="location.href='aluno-cadastro.php?id=<?php echo $row['Id'].'&tipo='.SHA1($row['Perfil']);?>'"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
                                            &nbsp; 

                                            <button class="btn btn-danger delete" type="submit" name="btn-excluir-pessoa" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
                                        </td>
                                    </tr>
                                <?php }
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

    $('button[name="btn-excluir-pessoa"]').on('click', function (e) {

        e.preventDefault();

        var id =  $(this).parent().siblings('.idpessoa').text();
        var nome =  $(this).parent().siblings('.nome').text();
        swal({
              title: "Deseja excluir o registro '"+ nome +"' com código '"+id+"'?",
              text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Excluir",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false
            },
            function(){
                $.post("pessoa-excluir.php", {id:id}, function(data){
                    if(data){
                        swal("Registro excluído com sucesso!","","success");
                        window.setTimeout("location.href='../pages/aluno-listar.php'", 2000);
                    }else{
                        swal("Error",data,"warning");
                    }
                });
            }
        );
    });
</script>
