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
    include_once 'aluno-listar.php';
 ?>