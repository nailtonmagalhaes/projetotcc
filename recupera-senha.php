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
            <h1 class="page-header">Recuperação de Senha</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Recuperação de Senha
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
					       <form role="form" id="formcadastrar" action="autentica.php" method="post">
					            <div class="form-group">
					                <label class="control-label" for="email">E-mail</label>
					                <input type="email" class="form-control obrigatorio email" name="email" id="email" placeholder="Informe o e-mail" value="">
					                <span class='msg-email'></span>
					            </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="botao-salvar">Enviar</button>
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