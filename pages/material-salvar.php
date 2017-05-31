<?php
	
    include_once 'material.php';
    include_once '../conf/acesso-dados.php';
    
 ?>
<!--Alert Top Cheio de Viadagem mais e Top--> 
<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">  

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
			<?php
                            $link = '';
                            
                            if(isset($_FILES["arquivo"]["name"])&&$_FILES["arquivo"]["name"]!=""){
                                // Pasta onde o arquivo vai ser salvo
                                $_UP['pasta'] = '../uploads/';
                                // Tamanho máximo do arquivo (em Bytes)
                                $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
                                // Array com as extensões permitidas
                                $_UP['extensoes'] = array('pdf');
                                // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
                                $_UP['renomeia'] = false;
                                // Array com os tipos de erros de upload do PHP
                                $_UP['erros'][0] = 'Não houve erro';
                                $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
                                $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
                                $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
                                $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
//                                echo '<pre>';
                                $link = $_FILES["arquivo"]["name"];
//                                var_dump($_UP['pasta']);
//                                var_dump($_FILES["arquivo"]["name"]);die;
                                // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
                                if ($_FILES['arquivo']['error'] != 0) {
                                  die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
                                  exit; // Para a execução do script
                                }
                                // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
                                // Faz a verificação da extensão do arquivo
                                $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
                                if (array_search($extensao, $_UP['extensoes']) === false) {
                                  echo "Por favor, envie arquivos com a seguinte extensão: pdf";
                                  exit;
                                }
                                // Faz a verificação do tamanho do arquivo
                                if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
                                  echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
                                  exit;
                                }
                                // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
                                // Primeiro verifica se deve trocar o nome do arquivo
                                if ($_UP['renomeia'] == true) {
                                  // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                                  $nome_final = md5(time()).'.jpg';
                                } else {
                                  // Mantém o nome original do arquivo
                                  $nome_final = $_FILES['arquivo']['name'];
                                }

                                // Depois verifica se é possível mover o arquivo para a pasta escolhida
                                if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
                                  // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
//                                  echo "Upload efetuado com sucesso!";
//                                  echo '<a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
                                } else {
                                  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                                  echo "Não foi possível enviar o arquivo, tente novamente";
                                }
                            }
//                                $link = '';
                                /* INFORMAÇES DO UPLOAD */
                                
                                
//                                var_dump($link);
//                                die;
				/* VERIFICO SE HOUVE UM POST */
				if(count($_POST) > 0) {
					$material = new Material();

					if(isset($_POST["matId"])){
						$material->matId = $_POST["matId"];
					}						

					if(isset($_POST["matDescricao"])){
						$material->matDescricao = $_POST["matDescricao"];
					}						

					if(isset($_POST["matAno"])){
						$material->matAno = $_POST["matAno"];
					}						

					if(empty($material->matDescricao) || empty($material->matAno)){
						header('location: ../pages/material-cadastro.php?id='.$material->matId.'&descricao='.$material->matDescricao);
						die;
					}	
//                                        var_dump($link);die;
                                        if(isset($_FILES["arquivo"]["name"])){
                                            $material->matLink = $link;
                                        }
                                        
					try{ 				 			

						if($material->salvarDados()){
							?>
							<script>
								swal("Dados salvos com sucesso!", "", "success");
								window.setTimeout("location.href='../pages/material-listar.php'",2000);
							</script>
							<?php
						}else{
							header('location: ../pages/material-cadastro.php?id='.$material->matId.'&descricao='.$material->matDescricao);
						}
					}catch(Exception $e){
						echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
					}	 
				}
			?>
        </div>
    </div>
</div>

