<?php
    include_once '../conf/acesso-dados.php';
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
						$tel3 = new Telefone();

					    if(isset($_POST["alnId"])){
							$aluno->pesId = $_POST["alnId"];
						}
						if(isset($_POST["alnNome"])){
							$aluno->pesNome = addslashes($_POST["alnNome"]);
						}
						if(isset($_POST["alnCpf"])){
							$aluno->pesCpf = Mascaras::removeMascara($_POST["alnCpf"]);
						}
						if(isset($_POST["alnRg"])){
							$aluno->pesRg = Mascaras::removeMascara($_POST["alnRg"]);
						}
						if(isset($_POST["alnSenha"])){
							$aluno->pesSenha = sha1(addslashes($_POST["alnSenha"]));
						}
						if(isset($_POST["alnSexo"])){
							$aluno->pesSexo = $_POST["alnSexo"];
						}
						if(isset($_POST["alnDataNascimento"])){
							$aluno->pesDataNascimento = date("Y-m-d", strtotime(str_replace('/','-', $_POST["alnDataNascimento"])));
						}
						/*CONTATOS*/
						if(isset($_POST["tipotelefone1"]) && $_POST["tipotelefone1"] != null && $_POST["tipotelefone1"] != ''){
							$tel1->telId = $_POST["idtel1"];
							$tel1->telTipo = $_POST["tipotelefone1"];
							$tel1->telNumero = Mascaras::removeMascara($_POST["numerotelefone1"]);
							$aluno->pesTelefones[] = $tel1;
						}
						if(isset($_POST["tipotelefone2"]) && $_POST["tipotelefone2"] != null && $_POST["tipotelefone2"] != ''){
							$tel2->telId = $_POST["idtel2"];
							$tel2->telTipo = $_POST["tipotelefone2"];
							$tel2->telNumero = Mascaras::removeMascara($_POST["numerotelefone2"]);
							$aluno->pesTelefones[] = $tel2;
						}
						if(isset($_POST["tipotelefone3"]) && $_POST["tipotelefone3"] != null && $_POST["tipotelefone3"] != ''){		
							$tel3->telId = $_POST["idtel3"];					 
							$tel3->telTipo = $_POST["tipotelefone3"];
							$tel3->telNumero = Mascaras::removeMascara($_POST["numerotelefone3"]);
							$aluno->pesTelefones[] = $tel3;
						}
						/*ENDEREÇO PRINCIPAL*/
						if(isset($_POST["alnIdEndereco1"])){
							$end1->endId = $_POST["alnIdEndereco1"];
						}
						if(isset($_POST["alnCep_1"])){
							$end1->endCep = Mascaras::removeMascara($_POST["alnCep_1"]);
						}
						if(isset($_POST["alnCidade_1"])){
							$end1->endCidade = new Cidade();
							$end1->endCidade->cidId = $_POST["alnCidade_1"];
						}
						if(isset($_POST["alnLogradouro_1"])){
							$end1->endLogradouro = addslashes($_POST["alnLogradouro_1"]);
						}
						if(isset($_POST["alnBairro_1"])){
							$end1->endBairro = addslashes($_POST["alnBairro_1"]);
						}
						if(isset($_POST["alnNumeroCasa_1"])){
							$end1->endNumero = $_POST["alnNumeroCasa_1"];
						}
						if(isset($_POST["alnComplemento_1"])){
							$end1->endComplemento = addslashes($_POST["alnComplemento_1"]);
						}

						$aluno->addEndereco($end1);

						if(isset($_POST["alnSegundoEndereco"])){
							$end2 = new Endereco();
							if(isset($_POST["alnIdEndereco2"])){
								$end2->endId = addslashes($_POST["alnIdEndereco2"]);
							}
							if(isset($_POST["alnCep_2"])){
								$end2->endCep = Mascaras::removeMascara($_POST["alnCep_2"]);
							}
							if(isset($_POST["alnCidade_2"])){
								$end2->endCidade = new Cidade();
								$end2->endCidade->cidId = $_POST["alnCidade_2"];
							}
							if(isset($_POST["alnLogradouro_2"])){
								$end2->endLogradouro = addslashes($_POST["alnLogradouro_2"]);
							}
							if(isset($_POST["alnBairro_2"])){
								$end2->endBairro = addslashes($_POST["alnBairro_2"]);
							}
							if(isset($_POST["alnNumero_2"])){
								$end2->endNumero = $_POST["alnNumero_2"];
							}
							if(isset($_POST["alnComplemento_2"])){
								$end2->endComplemento = addslashes($_POST["alnComplemento_2"]);
							}
							$aluno->addEndereco($end2);
						}						
						if(empty($aluno->pesNome) || empty($aluno->pesCpf)){
							header('location: ..\pages\aluno-cadastro.php?id='.$aluno->pesId);
							die;
						}
						echo "<pre>";
						var_dump($aluno);
						
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
