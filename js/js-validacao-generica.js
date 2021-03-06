//Evento submit do formulario
//$(document.getElementById("formcadastrar")).on('submit',function(e){
//    validaAoSalvar();
//})



var form = document.getElementById("formcadastrar");
if(form != null){
	if (form.addEventListener) {                   
	    form.addEventListener("submit", validaAoSalvar);
	} else if (form.attachEvent) {                  
	    form.attachEvent("onsubmit", validaAoSalvar);
	}
}


function validaAoSalvar(evt){
	var contErros = 0;

	$("#formcadastrar input, select").each(function(idx, elm){
		if(!validaCampo(elm)){
			contErros++;
		}
    });

	if(contErros > 0){
     	evt.preventDefault();
    }
}

//Percorre todos os inputs do formulário e define o maxlength de acordo com a classe
//OBS: Mudar para class
$("input").each(function(idx, elm){
	if($(elm).hasClass("cpf")){
		$(elm).attr('maxlength','14').on('keyup', function(){ keyupcpf(elm); });        // 000.000.000-00
	} else if($(elm).hasClass("telefone")){
		$(elm).attr('maxlength','14').on('keyup', function(){ keyuptelefone(elm); });   // (00) 0000-0000
	}else if($(elm).hasClass("cep")){
		$(elm).attr('maxlength','10').on('keyup', function(){ keyupcep(elm); });        // 00.000-000
	}else if ($(elm).hasClass("datepicker")){
		$(elm).attr('maxlength','10').on('keyup', function(){ keyupdatepicker(elm); }); // 00/00/0000
	}else if($(elm).hasClass("celular")){
		$(elm).attr('maxlength','15').on('keyup', function(){ keyupcelular(elm); });    //(00) 00000-0000
	}else if($(elm).hasClass("rg")){
		$(elm).attr('maxlength','12').on('keyup', function(){ keyuprg(elm); });         //00.000.000-0
	}else if($(elm).hasClass("hora")){
		$(elm).attr('maxlength','5').on('keyup', function(){ keyuphora(elm); });         //00:00
	}
});

//Evento clique do botão salvar
//$("#botao-salvar").click(function(evt){
//
//	var cont = 0;
//
//	$("#formcadastrar .obrigatorio").each(function(idx, elm){
//		if(!validaCampo(elm)){
//			cont++;
//		}
//  });
//
//	if(cont > 0){
//  	evt.preventDefault();
//    }else{
//        $("#formcadastrar").submit();
//    }
//});

//Evento que ocorre ao perder o foco do campo
$("input, select").blur(function(){
	validaCampo($(this)); 
});

function keyuptelefone(elm){
	var conteudo = $(elm).val();
	conteudo = getNumbers(conteudo);		             		//Remove tudo o que não é dígito
    conteudo = conteudo.replace(/^(\d{2})(\d)/g,"($1) $2"); 	//Coloca parênteses em volta dos dois primeiros dígitos
    conteudo = conteudo.replace(/(\d)(\d{4})$/,"$1-$2");    	//Coloca hífen entre o quarto e o quinto dígitos
    $(elm).val(conteudo);
}

function keyupcelular(elm){
	var conteudo = $(elm).val();
	conteudo = getNumbers(conteudo);		             		//Remove tudo o que não é dígito
    conteudo = conteudo.replace(/^(\d{2})(\d)/g,"($1) $2"); 	//Coloca parênteses em volta dos dois primeiros dígitos
    conteudo = conteudo.replace(/(\d)(\d{4})$/,"$1-$2");    	//Coloca hífen entre o quarto e o quinto dígitos
    $(elm).val(conteudo);
}

//Evento que ocorre quanto uma tecla é pressionada no campo que tem a classe cep
function keyupcep(elm){
	var conteudo = $(elm).val();
	conteudo = getNumbers(conteudo)					 		//Remove tudo o que não é dígito
	conteudo = conteudo.replace(/(\d)(\d{6})$/,"$1.$2");    //Coloca ponto entre o segundo e o terceiro dígitos 00.000-000
	conteudo = conteudo.replace(/(\d)(\d{3})$/,"$1-$2");    //Coloca hífen entre o quinto e o sexto dígitos 00.000-000
	$(elm).val(conteudo);
};

//Evento que ocorre quanto uma tecla é pressionada no campo que tem a classe datepicker
function keyupdatepicker(elm){
	var conteudo = $(elm).val();
	conteudo = getNumbers(conteudo)					 		//Remove tudo o que não é dígito
	conteudo = conteudo.replace(/(\d)(\d{6})$/,"$1/$2");    //Coloca barra entre o segundo e o terceiro dígitos
	conteudo = conteudo.replace(/(\d)(\d{4})$/,"$1/$2");    //Coloca barra entre o quarto e o quinto dígitos
	$(elm).val(conteudo);
};

function keyuphora(campo){
    var conteudo = $(campo).val();
    conteudo = conteudo.replace(/\D/g,"");					 //Remove tudo o que não é dígito
    conteudo = conteudo.replace(/(\d)(\d{2})$/,"$1:$2");    //Coloca barra entre o segundo e o terceiro dígitos
    $(campo).val(conteudo);
}

//Evento que ocorre quanto uma tecla é pressionada no campo que tem a classe RG
function keyuprg(elm){
	var conteudo = $(elm).val();
	conteudo = getNumbers(conteudo)					 		//Remove tudo o que não é dígito
	conteudo = conteudo.replace(/(\d)(\d{7})$/,"$1.$2");    //Coloca ponto entre o segundo e o terceiro dígitos 00.000.000-0
	conteudo = conteudo.replace(/(\d)(\d{4})$/,"$1.$2");    //Coloca hífen entre o quinto e o sexto dígitos 00.000.000-0
	conteudo = conteudo.replace(/(\d)(\d{1})$/,"$1-$2");    //Coloca hífen entre o quinto e o sexto dígitos 00.000.000-0	
	$(elm).val(conteudo);
};

//Evento que ocorre quando uma tecla é pressionada no campo que tem a classe cpf
function keyupcpf(elm){
	var conteudo = $(elm).val();

	//Remove tudo o que não é dígito
	conteudo = getNumbers(conteudo);             
	//Coloca um ponto entre o terceiro e o quarto dígitos
    conteudo = conteudo.replace(/(\d{3})(\d)/,"$1.$2")

    //Coloca um ponto entre o terceiro e o quarto dígitos
    //de novo (para o segundo bloco de números)
    conteudo = conteudo.replace(/(\d{3})(\d)/,"$1.$2")

    //Coloca um hífen entre o terceiro e o quarto dígitos
    conteudo = conteudo.replace(/(\d{3})(\d{1,2})$/,"$1-$2")    

    $(elm).val(conteudo);
};
//############ VALIDAÇÕES ####################################################################
//Validação genérica para validar vários tipos de campo
function validaCampo(elm){
	var nome = $(elm).attr('name');
 	var tipo = $(elm).attr('type');
 	if(tipo=="hidden") return true;
 	var nomespan = '.msg-' + nome;
 	var caixa_msg = document.querySelector(nomespan);
 	var mensagem = "";

 	if($(elm).hasClass("obrigatorio") && removeMascara($(elm).val()) == ""){   
 		mensagem = "Campo obrigatório";
    }else if(tipo == "number" && $(elm).val() != ""){
    	if(!isNumber($(elm).val())){		 		
 			mensagem = "Informe um número válido para o campo";
 		}else if(parseFloat($(elm).val()) <= 0 ){
 			mensagem = "Informe um número maior que zero para o campo";
 		}
 	}else if((tipo == "email" || $(elm).hasClass("email")) && !isEmail($(elm).val())){
 		mensagem = "Informe um e-mail válido";
 	}else if($(elm).hasClass("cpf") && !validarCPF($(elm).val())){
 		mensagem = "O CPF informado é inválido";
 	}else if($(elm).hasClass("cep") &&  $(elm).val().length > 0 && !isCEP($(elm).val())){
 		mensagem = "O CEP informado não é válido";
 	}else if($(elm).hasClass("telefone") && !isTelefone($(elm).val())){
 		mensagem = "O Telefone informado não é válido";
 	}else if($(elm).hasClass("celular") && !isCelular($(elm).val())){
 		mensagem = "O Celular informado não é válido";
 	}else if($(elm).hasClass("data")&&!validaData($(elm).val())){
		mensagem = "A data informada é inválida";			
 	} else if ($(elm).hasClass("data-nascimento") && !validaDataNascimento($(elm).val())) {
 	    mensagem = "A idade mínima deve ser maior ou igual a 2 anos";
 	} else if ($(elm).hasClass("ano-menor-que-atual") && !validaAnoMaiorQueAtual($(elm).val())) {
 	    mensagem = "O ano deve ser menor ou igual a "+ new Date().getFullYear();
 	}

 	if(mensagem != ""){
		if($(elm).hasClass("data")){
			$(elm).parent().parent().addClass("has-error");
		}else{
			$(elm).parent().addClass("has-error");
		}
 		if(caixa_msg != null){
         	caixa_msg.innerHTML = mensagem;
			caixa_msg.style.display = "block";
			caixa_msg.style.color = "#D2691E";        		
    	}
 	}else{
		if($(elm).hasClass("data")){
			$(elm).parent().parent().removeClass("has-error");
		}else{
			$(elm).parent().removeClass("has-error");
		}
 		if(caixa_msg != null){
    		caixa_msg.style.display = "none";
		}
 	}
 	return mensagem == "";
}

function validaAnoMaiorQueAtual(ano) {
    if(getNumbers(ano).length!=4)
        return false;

    if (getNumbers(ano) > new Date().getFullYear())
        return false;

    return true;
}

function validaDataNascimento(strData) {
    var partesData = strData.split("/");
    var data = new Date(partesData[2], partesData[1] - 1, partesData[0]);
    dataAtual = new Date();
    dataAtual = dataAtual.setFullYear(dataAtual.getFullYear() - 2);
    if (data > dataAtual)
        return false;

    return true;
}

function validaData(data) {
	var expReg = /^((0[1-9]|[12]\d)\/(0[1-9]|1[0-2])|30\/(0[13-9]|1[0-2])|31\/(0[13578]|1[02]))\/(19|20)?\d{2}$/;
	var aRet = true;
	if (data.match(expReg)) {
		var dia = data.substring(0,2);
		var mes = data.substring(3,5);
		var ano = data.substring(6,10);
		if ((mes == 4 || mes == 6 || mes == 9 || mes == 11 ) && dia > 30) 
		aRet = false;
		else 
		if ((ano % 4) != 0 && mes == 2 && dia > 28) 
			aRet = false;
		else
			if ((ano%4) == 0 && mes == 2 && dia > 29)
			aRet = false;
	}  else 
		aRet = false;  
	return aRet;
}

function isNumber(texto) {
    return !isNaN(parseFloat(texto)) && isFinite(texto);
}

function validarCPF(cpf) {  
    cpf = getNumbers(cpf);
    if(cpf == "00000000001" || cpf == "00000000002" || cpf == "00000000003") return true;
    if(cpf == '') return true; 
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999" ||
        cpf == "12345678901")
            return false;       
    // Valida 1o digito 
    add = 0;    
    for (i=0; i < 9; i ++)       
        add += parseInt(cpf.charAt(i)) * (10 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11)     
            rev = 0;    
        if (rev != parseInt(cpf.charAt(9)))     
            return false;       
    // Valida 2o digito 
    add = 0;    
    for (i = 0; i < 10; i ++)        
        add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
        rev = 0;    
    if (rev != parseInt(cpf.charAt(10)))
        return false;       
    return true;   
}

function isEmail(email){

	var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(filter.test(email)){
		return true;
	}else{
		return false;
	}
}

// Função para validação de CEP.
function isCEP(cep){

	if(getNumbers(cep).length != 8){
		return false;
	}

    // Caso o CEP não esteja nesse formato ele é inválido!
    var objER =  /\d{2}\.\d{3}\-\d{3}/;
    // Substitui os espaços vazios no inicio e no fim da string por vazio.
    cep = cep.replace(/^s+|s+$/g, '');
    if(cep.length > 0){
        if(objER.test(cep))
            return true;
        else
            return false;
    }else{
        return true;
    }
}

// Função para validação de Telefone.
function isTelefone(telefone){
    // Caso o Telefone não esteja nesse formato ele é inválido!
    var objER =  /\([1-9]{2}\)\ [2-9]{1}\d{3}\-\d{4}/;
    // Substitui os espaços vazios no inicio e no fim da string por vazio.
    telefone = telefone.replace(/^s+|s+$/g, '');
    if(telefone.length > 0){
        if(objER.test(telefone))
            return true;
        else
            return false;
    }else{
        return true;
    }
}

// Função para validação de CEP.
function isCelular(celular){
    // Caso o Telefone não esteja nesse formato ele é inválido!
    var objER =  /\([1-9]{2}\)\ [9]{1}[3-9]{1}\d{3}\-\d{4}/;
    // Substitui os espaços vazios no inicio e no fim da string por vazio.
    celular = celular.replace(/^s+|s+$/g, '');
    if(celular.length > 0){
        if(objER.test(celular))
            return true;
        else
            return false;
    }else{
        return true;
    }
}

//Função que remove a mascara de um determinado texto
function removeMascara(texto){
	var retorno = texto;
	retorno = removerUnderlineDuplicados(retorno);
	retorno = removerEspacosDuplicados(retorno);
	retorno = retorno.replace(" ", "");
	retorno = retorno.replace("(", "");
	retorno = retorno.replace(")", "");
	retorno = retorno.replace("/", "");
	retorno = retorno.replace("-", "");
	retorno = retorno.replace(".", "");
	retorno = retorno.replace("_", "");
	retorno = retorno.replace(" ", "");
	return retorno;
}

function removerEspacosDuplicados(texto){
	if(texto == null) return '';
	var retorno = texto;
	retorno = retorno.replace(/\s{2,}/g, ' ');
	return retorno;
	/*
	* \s - qualquer espaço em branco
	* {2,} - em quantidade de dois ou mais
	* g - apanhar todas as ocorrências, não só a primeira
	* depois o replace faz a subsituição desses grupos de espaços pelo que fôr passado no segundo parâmetro. Neste caso um espaço simples , ' ');
	*/
}

function removerUnderlineDuplicados(texto){
	if(texto == null) return '';
	var retorno = texto;
	retorno = retorno.replace(/\_{2,}/g, '_');
	return retorno;
	/*
	* \s - qualquer hifen em branco
	* {2,} - em quantidade de dois ou mais
	* g - apanhar todas as ocorrências, não só a primeira
	* depois o replace faz a subsituição desses grupos de espaços pelo que fôr passado no segundo parâmetro. Neste caso um underline simples , _);
	*/
}

//Função que retorna somente os numeros de um texto
function getNumbers(texto){
	return texto.replace(/\D/g,"");
}
