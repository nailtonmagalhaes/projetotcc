<?php
	include_once "menu.php";
    include_once '../conf/acesso-dados.php';
    include_once 'turma.php';

	$turma = new Turma();

	if(isset($_GET["id"])){
		$turma->turId = $_GET["id"];
	}elseif (isset($_POST["id"])) {
		$turma->turId = $_POST["id"];
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
	                    Detalhes da Turma
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-12">';
                        		if($turma->carregarDados()){
									//echo "<pre>";
									//var_dump($turma);
						       		echo '
						       		<form action="turma-excluir.php" method="post">
							       		<input type="hidden" name="id" id="idturma" value="'.$turma->turId.'">
							       		<div class="form-group">
								       		<label>Data de Início:</label> <span>'.date("d/m/Y", strtotime($turma->turDataInicio)).'</span></br>
								       	</div>
							       		<div class="form-group">
								       		<label>Curso:</label> <span>'.$turma->turCurso->crsDescricao.'</span></br>
								       	</div>
							       		<div class="form-group">
								       		<label>Duração:</label> <span>'.$turma->turCurso->crsDuracao.' horas</span></br>
							       		</div>';
										if($turma->turProfessorHasTurma[0]->phtTipo == ETipoProfessor::Principal){
											echo '<div class="form-group">
													<label>Professor Principal:</label> <span>'.$turma->turProfessorHasTurma[0]->phtProfessor->pesNome.'</span></br>
												</div>
												<div class="form-group">
													<label>Professor Apoio:</label> <span>'.$turma->turProfessorHasTurma[1]->phtProfessor->pesNome.'</span></br>
												</div>';
										}else{
											echo '<div class="form-group">
													<label>Professor Principal:</label> <span>'.$turma->turProfessorHasTurma[1]->phtProfessor->pesNome.'</span></br>
												</div>
												<div class="form-group">
													<label>Professor Apoio:</label> <span>'.$turma->turProfessorHasTurma[0]->phtProfessor->pesNome.'</span></br>
												</div>';
										}
										echo '<div class="panel panel-default col-lg-6"'.(count($turma->turHasDiaSemana) > 0 ? null : "hidden" ).'>
											<div class="panel-heading" style="text-align: center;">
												<label>Dias / Horários</label>
											</div>
											<div class="form-group">										
												<table class="table table-striped" id="tbhorarios" name="tbhorarios">
													<thead>
														<tr>
															<th>Dia da Semana</th>
															<th class="center">Hora Início</th>
															<th class="center">Hora Término</th>
														</tr>
													</thead>
													<tbody>';
													foreach($turma->turHasDiaSemana as $diasemana){
														echo'<tr>
															<td>
																<span>'.utf8_encode($diasemana->thdDiaSemana->disDia).'</span>
															</td>
															<td class="center">
																<span>'.$diasemana->horaInicioFormatada().'</span>
															</td>
															<td class="center">
																<span>'.$diasemana->horaTerminoFormatada().'</span>
															</td>
														</tr>';}
													echo'</tbody>
												</table>
											</div>	
										</div>';
                                            if(EPerfil::Secretaria == $_SESSION['perfil']){
										        echo '<div class="form-group col-lg-12">
											        <button class="btn btn-primary edit" disabled type="button" title="Editar" onclick="javascript: location.href=\'turma-cadastro.php?id='.$turma->turId.'\';"><i class="glyphicon glyphicon-edit" title="Editar"></i></button>';
                                                if($turma->turAtivo == 0){
                                                    echo '&nbsp; <button class="btn btn-success" type="button" name="btn-ativar-turma" title="Ativar"><i class="glyphicon glyphicon-check" title="Ativar"></i></button>';
                                                }else{
											        echo '&nbsp; <button class="btn btn-danger" type="button" name="btn-excluir-turma" title="Excluir"><i class="glyphicon glyphicon-trash" title="Excluir"></i></button>';
                                                }
                                            }
										    echo '</div>
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
	$('button[name="btn-excluir-turma"]').on('click', function (e) {
        e.preventDefault();
        
        var id = document.getElementById("idturma").value;

        swal({
            title: "Deseja realmente excluir a turma?",
            text: "Clique em Excluir para confirmar ou em Cancelar para cancelar!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Excluir",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false
        },
			function () {
			    $.post("turma-excluir.php", { id: id }, function (data) {
			        if (data && data.success) {
			            swal(data.message, "", "success");
			            window.setTimeout("location.href='../pages/turma-listar.php'", 2000);
			        } else {
			            swal(data.message, "", "warning");
			        }
			    });
			});
	});

	$('button[name="btn-ativar-turma"]').on('click', function (e) {

	    e.preventDefault();

	    var id = document.getElementById("idturma").value;

	    swal({
	        title: "Deseja reativar a turma?",
	        text: "Clique em Ativar para confirmar ou em Cancelar para cancelar!",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "green",
	        confirmButtonText: "Ativar",
	        cancelButtonText: "Cancelar",
	        closeOnConfirm: false
	    },
        function () {
            $.post("turma-ativar.php", { id: id }, function (data) {
                if (data && data.success) {
                    swal(data.message, "", "success");
                    window.setTimeout("location.href='../pages/turma-listar.php'", 1000);
                } else {
                    swal(data.message, "", "warning");
                }
            });
        });
	});
</script>