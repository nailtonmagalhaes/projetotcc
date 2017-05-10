
<?php
	include_once "menu.php";
    include_once 'curso.php';

	$curso = new Curso();

	if(isset($_GET["id"])){
		$curso->crsId = $_GET["id"];
	}else if(isset($_POST["id"])){
		$curso->crsId = $_POST["id"];
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
	                    Detalhes do Curso
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-6">';
	                        	if($curso->carregarDados()){
	                        		echo '
                        			<form action="curso-excluir.php" method="post">
                        				<input type="hidden" id="idcurso" name="id" value="'.$curso->crsId.'">
                        				<div class="form-group">
                        					<label>Descrição:</label> <span>'.$curso->crsDescricao.'</span></br>
                        				</div>
						       			<div class="form-group">
                        					<label>Duração:</label> <span>'.$curso->crsDuracao.'</span></br>
                        				</div>
						       			<div class="form-group">
                        					<label>Curso:</label> <span>'.$curso->crsDescricao.'</span></br>
                        				</div>	                        				
		                                <button class="btn btn-primary edit" type="button" title="Editar" onclick="javascript: location.href=\'curso-cadastro.php?id='.$curso->crsId.'\';"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>
		                                <button class="btn btn-danger delete" type="submit" name="btn-excluir-curso" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>
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
	$('button[name="btn-excluir-curso"]').on('click', function (e) {
        e.preventDefault();
        
        var id = document.getElementById("idcurso").value;

        swal({
			  title: "Deseja realmente excluir o curso?",
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
                        window.setTimeout("location.href='../pages/curso-listar.php'", 2000);
                    }else{
                        swal("Error",data,"warning");
                    }
                });
			});
    });
</script>

