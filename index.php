<?php
	session_start();
	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema MNP</title>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">Login</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Login de Usuário
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
					       <form role="form" id="formcadastrar" action="autentica.php" method="post">
					            <div class="form-group">
					                <label class="control-label" for="cpf">CPF</label>
					                <input type="text" class="form-control cpf obrigatorio" name="cpf" id="cpf" placeholder="Informe o CPF" value="">
					                <span class='msg-cpf'></span>
					            </div>
					            <div class="form-group">
					                <label class="control-label" for="senha">Senha</label>
					                <input type="password" class="form-control obrigatorio" name="senha" id="senha" placeholder="Informe a senha" value="">
					                <span class='msg-senha'></span>
					            </div>
					            <div class="form-group">
					            	<button type="submit" class="btn btn-success" id="botao-salvar"><span class="glyphicon glyphicon-ok"> Entrar</button>
                                	<a href="recupera-senha.php">Esqueci minha senha</a>
					            </div>                                
					        </form>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/js-validacao-generica.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
</body>
</html>