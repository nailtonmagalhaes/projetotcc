<?php //include_once 'menu.php'; 
    include_once 'aluno.php';
    include_once 'utils.php';
 ?>
<!--Alert Top Cheio de Viadagem mais e Top--> 
<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">  


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
				<?php
					/* VERIFICO SE HOUVE UM POST */
					if(count($_POST) > 0) {
					    $aluno = new Aluno();
						$end1 = new Endereco();
						$tel1 = new Telefone();
						$tel2 = new Telefone();

					    if(isset($_POST["alnId"])){
							$aluno->pesId = $_POST["alnId"];
						}
						if(isset($_POST["alnNome"])){
							$aluno->pesNome = $_POST["alnNome"];
						}
						if(isset($_POST["alnCpf"])){
							$aluno->pesCpf = Mascaras::removeMascara($_POST["alnCpf"]);
						}
						if(isset($_POST["alnRg"])){
							$aluno->pesRg = Mascaras::removeMascara($_POST["alnRg"]);
						}
						if(isset($_POST["alnSenha"])){
							$aluno->pesSenha = sha1($_POST["alnSenha"]);
						}
						if(isset($_POST["alnSexo"])){
							$aluno->pesSexo = $_POST["alnSexo"];
						}
						if(isset($_POST["alnDataNascimento"])){
							$aluno->pesDataNascimento = date("Y-m-d", strtotime(str_replace('/','-', $_POST["alnDataNascimento"])));
						}
						if(isset($_POST["alnPerfil"])){
							$aluno->pesPerfil = $_POST["alnPerfil"];
						}

						if(isset($_POST["alnCep_1"])){
							$end1->endCep = Mascaras::removeMascara($_POST["alnCep_1"]);
						}
						if(isset($_POST["alnCidade_1"])){
							$end1->endCidade = new Cidade();
							$end1->endCidade->cidId = $_POST["alnCidade_1"];
						}
						if(isset($_POST["alnLogradouro_1"])){
							$end1->endLogradouro = $_POST["alnLogradouro_1"];
						}
						if(isset($_POST["alnBairro_1"])){
							$end1->endBairro = $_POST["alnBairro_1"];
						}
						if(isset($_POST["alnNumeroCasa_1"])){
							$end1->endNumero = $_POST["alnNumeroCasa_1"];
						}
						if(isset($_POST["alnComplemento_1"])){
							$end1->endComplemento = $_POST["alnComplemento_1"];
						}

						$aluno->addEndereco($end1);

						if(isset($_POST["alnSegundoEndereco"])){
							$end2 = new Endereco();
							if(isset($_POST["alnCep_2"])){
								$end2->endCep = Mascaras::removeMascara($_POST["alnCep_2"]);
							}
							if(isset($_POST["alnCidade_2"])){
								$end2->endCidade = new Cidade();
								$end2->endCidade->cidId = $_POST["alnCidade_2"];
							}
							if(isset($_POST["alnLogradouro_2"])){
								$end2->endLogradouro = $_POST["alnLogradouro_2"];
							}
							if(isset($_POST["alnBairro_2"])){
								$end2->endBairro = $_POST["alnBairro_2"];
							}
							if(isset($_POST["alnNumero_2"])){
								$end2->endNumero = $_POST["alnNumero_2"];
							}
							if(isset($_POST["alnComplemento_2"])){
								$end2->endComplemento = $_POST["alnComplemento_2"];
							}
							$aluno->addEndereco($end2);
						}
						//print_r($aluno);
						
						if(empty($aluno->pesNome) || empty($aluno->pesCpf)){
							header('location: ..\pages\aluno-cadastro.php?id='.$aluno->pesId);
							die;
						}

				    	try{ 	
				            $insert = $aluno->salvarDados();
			
				            if($insert){
			            		?>
				            	<script>
				            		swal("Dados salvos com sucesso", "", "success");
				            		window.setTimeout("location.href='../pages/aluno-listar.php'",1000);
				            	</script>
            					<?php
            				}else{
            					header('location: ..\pages\aluno-cadastro.php?id='.$aluno->pesId);
            				}
			            }catch(Exception $e){
							echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
						}	 
					}
				?>
        </div>
    </div>
</div>
