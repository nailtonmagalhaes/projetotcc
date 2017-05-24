<?php	
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'aluno.php';
    $aluno = new Aluno();

	if(isset($_GET["id"])){
		$aluno->pesId = $_GET["id"];
	}elseif (isset($_POST["id"])) {
		$aluno->pesId = $_POST["id"];
	}

	$aluno->carregarDados();
?>
		
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
                    Detalhes do Aluno
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        	<form action="aluno-excluir.php" method="post">
                        		<input type="text" name="id" id="idaluno" <?php echo 'value="'.$aluno->pesId.'"';?>>
                        	</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
	$('button[name="btn-excluir-aluno"]').on('click', function (e) {
        e.preventDefault();
        
        var id = document.getElementById("idaluno").value;

        swal({
			  title: "Deseja realmente excluir o aluno?",
			  text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Excluir",
			  cancelButtonText: "Cancelar",
			  closeOnConfirm: false
			},
			function(){
				$.post("aluno-excluir.php", {id:id}, function(data){
                    if(data){
                        swal("Aluno excluído com sucesso!","","success");
                        window.setTimeout("location.href='../pages/aluno-listar.php'", 1000);
                    }else{
                        swal("Error",data,"warning");
                    }
                });
			});
    });
</script>
