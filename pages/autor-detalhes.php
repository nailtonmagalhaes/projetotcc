<?php 
include_once "autor.php";
include_once "menu.php";
include_once '../conf/acesso-dados.php';

$autor = new Autor();
if(isset($_GET["id"])){
		$autor->autId = $_GET["id"];
	}else if(isset($_POST["id"])){
		$autor->autId = $_POST["id"];
	}


echo '
 	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Detalhes</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <!-- /.row -->
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Detalhes do Autor
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-6">';
	                        	if($autor->carregarDados()){
	                        		echo '
                        			<form action="autor-excluir.php" method="post">
                        				<input type="hidden" id="idautor" name="id" value="'.$autor->autId.'">
                                        <div class="form-group">
                        					<label>Nome:</label> <span>'.$autor->autNome.'</span></br>
                        				</div>
                        				<div class="form-group">
                        					<label>Descrição:</label> <span>'.$autor->autDescricao.'</span></br>
                        				</div>
		                                <button class="btn btn-primary edit" type="button" title="Editar" onclick="javascript: location.href=\'autor-cadastro.php?id='.$autor->autId.'\';"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
		                                <button class="btn btn-danger delete" type="submit" name="btn-excluir-autor" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
                        			</form>';
	                        	}
					        	echo '
					        </div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>';
?>

<script>
	$('button[name="btn-excluir-autor"]').on('click', function (e) {
        e.preventDefault();
        
        var id = document.getElementById("idautor").value;

        swal({
			  title: "Deseja realmente excluir o autor?",
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
                        window.setTimeout("location.href='../pages/autor-listar.php'", 1000);
                    }else{
                        swal("Error",data,"warning");
                    }
                });
			});
    });
</script>






?>