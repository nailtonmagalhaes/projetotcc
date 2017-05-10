<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<?php include '..\pages\menu.php';?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
	        <?php
	        	try{
			        require_once 'database.php';
			        
			        $insert = insere("INSERT INTO `tbestado` (`Id`, `Nome`, `Sigla`) VALUES (NULL, 'teste', 'ts');");
			        if($insert == true){
			            echo 'inserido';
			        }
		    	} catch (Exception $e) {
		    		echo $e->getMessage();
		    	}
	        ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>