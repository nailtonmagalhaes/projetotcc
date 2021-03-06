<?php
    include_once 'permissao-secretaria.php';
    include_once '../conf/acesso-dados.php';
    include_once 'aluno.php';
    include_once 'professor.php';
    include_once 'secretaria.php';
    include_once 'utils.php';
 ?>

<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">  

<?php
	try{
		/* VERIFICO SE HOUVE UM POST */
		if(count($_POST) > 0) {
			$pessoa = null;
		    if($_POST['pesPerfil'] == EPerfil::Aluno){
		    	$pessoa = new Aluno();
		    }else if($_POST['pesPerfil'] == EPerfil::Professor){
		    	$pessoa = new Professor();
		    }else if($_POST['pesPerfil'] == EPerfil::Secretaria){
		    	$pessoa = new Secretaria();
		    }

			$end1 = new Endereco();

		    if(isset($_POST["alnId"])){
				$pessoa->pesId = $_POST["alnId"];
			}
			if(isset($_POST["alnNome"])){
				$pessoa->pesNome = addslashes($_POST["alnNome"]);
			}
			if(isset($_POST["alnCpf"])){
				$pessoa->pesCpf = Mascaras::removeMascara($_POST["alnCpf"]);
			}
			if(isset($_POST["alnRg"])){
				$pessoa->pesRg = Mascaras::removeMascara($_POST["alnRg"]);
			}
			if(isset($_POST["alnSenha"])){
                if($pessoa->pesSenha != $pessoa->pesSenhaAtual){
                    $pessoa->pesSenha = sha1(addslashes($_POST["alnSenha"]));
                }else{
                    $pessoa->pesSenha = addslashes($_POST["alnSenha"]);
                }
			}
			if(isset($_POST["alnSexo"])){
				$pessoa->pesSexo = $_POST["alnSexo"];
			}
			if(isset($_POST["alnDataNascimento"])){
				$pessoa->pesDataNascimento = date("Y-m-d", strtotime(str_replace('/','-', $_POST["alnDataNascimento"])));
			}

			/*RESPONSAVEIS*/
			if(EPerfil::Aluno == $pessoa->pesPerfil){
				if(isset($_POST["nomeresp1"]) && $_POST["nomeresp1"] != null && $_POST["nomeresp1"] != ''){
					$hasResp1 = new AlunoHasResponsavel();
					$hasResp1->ahrResponsavel = new Responsavel();
					$hasResp1->ahrResponsavel->respId = $_POST["idresp1"];
					$hasResp1->ahrResponsavel->respNome = $_POST["nomeresp1"];
					$hasResp1->ahrResponsavel->respCpf = Mascaras::removeMascara($_POST["cpfresp1"]);
					$hasResp1->ahrResponsavel->respParentesco = $_POST["parentescoresp1"];
					$pessoa->addResponsavel($hasResp1);
				}
				if(isset($_POST["nomeresp2"]) && $_POST["nomeresp2"] != null && $_POST["nomeresp2"] != ''){
					$hasResp2 = new AlunoHasResponsavel();
					$hasResp2->ahrResponsavel = new Responsavel();
					$hasResp2->ahrResponsavel->respId = $_POST["idresp2"];
					$hasResp2->ahrResponsavel->respNome = $_POST["nomeresp2"];
					$hasResp2->ahrResponsavel->respCpf = Mascaras::removeMascara($_POST["cpfresp2"]);
					$hasResp2->ahrResponsavel->respParentesco = $_POST["parentescoresp2"];
					$pessoa->addResponsavel($hasResp2);
				}
			}

			/*CONTATOS*/
			if(isset($_POST["tipotelefone1"]) && $_POST["tipotelefone1"] != null && $_POST["tipotelefone1"] != ''){
				$tel1 = new Telefone();
				$tel1->telId = $_POST["idtel1"];
				$tel1->telTipo = $_POST["tipotelefone1"];
				$tel1->telNumero = Mascaras::removeMascara($_POST["numerotelefone1"]);
				$pessoa->pesTelefones[] = $tel1;
			}
			if(isset($_POST["tipotelefone2"]) && $_POST["tipotelefone2"] != null && $_POST["tipotelefone2"] != ''){
				$tel2 = new Telefone();
				$tel2->telId = $_POST["idtel2"];
				$tel2->telTipo = $_POST["tipotelefone2"];
				$tel2->telNumero = Mascaras::removeMascara($_POST["numerotelefone2"]);
				$pessoa->pesTelefones[] = $tel2;
			}
			if(isset($_POST["tipotelefone3"]) && $_POST["tipotelefone3"] != null && $_POST["tipotelefone3"] != ''){
				$tel3 = new Telefone();
				$tel3->telId = $_POST["idtel3"];					 
				$tel3->telTipo = $_POST["tipotelefone3"];
				$tel3->telNumero = Mascaras::removeMascara($_POST["numerotelefone3"]);
				$pessoa->pesTelefones[] = $tel3;
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

			$pessoa->addEndereco($end1);

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
				$pessoa->addEndereco($end2);
			}						
			if(empty($pessoa->pesNome) || empty($pessoa->pesCpf)){
				header('location: ..\pages\aluno-cadastro.php?id='.$pessoa->pesId);
				die;
			}
			//echo "<pre>";
			//var_dump($pessoa);
			
	    	try{
	            $insert = $pessoa->salvarDados();
	            if($insert){
	        		include_once 'menu.php';?>
	            	<script>
	            		try {
	            			
		            		swal("Dados salvos com sucesso", " ", "success");
		            		window.setTimeout("location.href='../pages/aluno-listar-ativos.php?tipo=<?php echo SHA1($pessoa->pesPerfil)."'\"";?>,1000);
	            		} catch (e) {
	            			alert(e);
	            		}
	            	</script>
					<?php
				}else{
					header('location: ..\pages\aluno-cadastro.php?id='.$pessoa->pesId);
				}
	        }catch(Exception $e){
				echo "<h1>Erro: ".$e->getMessage()."</h1>"; 
			}	 
		}
	}catch(Exception $e){
		echo "Ocorreu um erro ao receber os dados da tela.<br>".$e->getMessage();
	}
?>
