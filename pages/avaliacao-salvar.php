<?php
include_once '../conf/acesso-dados.php';
include_once 'avaliacao.php';
include_once 'matricula.php';
try
{
	if(count($_POST)>0){
        $av = new Avaliacao();

        if(isset($_POST['avaId'])){
            $av->avaId = $_POST['avaId'];
        }
        if(isset($_POST['avaMatricula'])){
            $av->avaMatricula = new Matricula();
            $av->avaMatricula->matId = $_POST['avaMatricula'];
        }
        if(isset($_POST['avaData'])){
            $av->avaData = date("Y-m-d", strtotime(str_replace('/','-', $_POST["avaData"])));
        }
        if(isset($_POST['avaTipo'])){
            $av->avaTipo = $_POST['avaTipo'];
        }
        if(isset($_POST['avaAtivo'])){
            $av->avaAtivo = $_POST['avaAtivo'];
        }
        if($av->salvarDados()){
        include_once 'menu.php'; ?>
            <script>
                swal("Dados salvos com sucesso", "", "success");
                window.setTimeout("location.href='../pages/avaliacao-listar.php'", 1000);
            </script>
        <?php }else{?>
            <script>
                swal("Não foi possível salvar os dados da avaliação.", "", "warning");
                window.setTimeout("location.href='../pages/avaliacao-listar.php'", 1000);
            </script>
        <?php }
    }
}
catch (Exception $e)
{ ?>
    <script>
        swal("Não foi possível salvar os dados da avaliação.<?php echo '\n'.$e->getMessage();?>", "", "warning");
        window.setTimeout("location.href='../pages/avaliacao-listar.php'", 1000);
    </script>
<?php }


?>


