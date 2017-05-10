<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<?php include '..\pages\menu.php';?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
	        <?php 
				echo "iniciando conexao.........................................<br />";
				$db = open_database(); 
				
				if ($db) {
					echo '<h1>Banco de Dados Conectado!</h1>';
					close_database($db);
				} else {
					echo '<h1>ERRO: Não foi possível Conectar!</h1>';
				}
			?>		
            <form action="..\pages\index.php">
				<button type="submit" class="btn btn-default">&laquo;Voltar para Início</button>
			</form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>