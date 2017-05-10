//Evento submit do formulario
//$(document.getElementById("formcadastrar")).on('submit',function(e){
//    validaAoSalvar();
//})



var form = document.getElementById("formcadastrar");

if (form.addEventListener) {                   
    form.addEventListener("submit", validaAoSalvar);
} else if (form.attachEvent) {                  
    form.attachEvent("onsubmit", validaAoSalvar);
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
$("#formcadastrar input").each(function(idx, elm){
	if($(elm).hasClass("cpf") || $(elm).hasClass("telefone")){
		$(elm).attr('maxlength','14'); //000.000.000-00 / (00) 0000-0000
	}else if($(elm).hasClass("cep") || $(elm).hasClass("datepicker")){
		$(elm).attr('maxlength','10'); //00.000-000 / 00/00/0000
	}else if($(elm).hasClass("celular")){
		$(elm).attr('maxlength','15'); //(00) 00000-0000
	}else if($(elm).hasClass("rg")){
		$(elm).attr('maxlength','12'); //00.000.000-0
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
$("#formcadastrar input, select").blur(function(){
	validaCampo($(this)); 
});

//Evento que ocorre quando uma tecla é pressionada no campo que tem a classe telefone
$("#formcadastrar input.telefone").keyup(function(){
	var conteudo = $(this).val();
	conteudo = getNumbers(conteudo);		             		//Remove tudo o que não é dígito
    conteudo = conteudo.replace(/^(\d{2})(\d)/g,"($1) $2"); 	//Coloca parênteses em volta dos dois primeiros dígitos
    conteudo = conteudo.replace(/(\d)(\d{4})$/,"$1-$2");    	//Coloca hífen entre o quarto e o quinto dígitos
    console.log(conteudo);
    $(this).val(conteudo);
});

//Evento que ocorre quando uma tecla é pressionada no campo que tem a classe telefone
$("#formcadastrar input.celular").keyup(function(){
	var conteudo = $(this).val();
	conteudo = getNumbers(conteudo);		             		//Remove tudo o que não é dígito
    conteudo = conteudo.replace(/^(\d{2})(\d)/g,"($1) $2"); 	//Coloca parênteses em volta dos dois primeiros dígitos
    conteudo = conteudo.replace(/(\d)(\d{4})$/,"$1-$2");    	//Coloca hífen entre o quarto e o quinto dígitos
    console.log(conteudo);
    $(this).val(conteudo);
});

//Evento que ocorre quanto uma tecla é pressionada no campo que tem a classe cep
$("#formcadastrar input.cep").keyup(function(){
	var conteudo = $(this).val();
	conteudo = getNumbers(conteudo)					 		//Remove tudo o que não é dígito
	conteudo = conteudo.replace(/(\d)(\d{6})$/,"$1.$2");    //Coloca ponto entre o segundo e o terceiro dígitos 00.000-000
	conteudo = conteudo.replace(/(\d)(\d{3})$/,"$1-$2");    //Coloca hífen entre o quinto e o sexto dígitos 00.000-000
	$(this).val(conteudo);
});

//Evento que ocorre quanto uma tecla é pressionada no campo que tem a classe datepicker
$("#formcadastrar input.datepicker").keyup(function(){
	var conteudo = $(this).val();
	conteudo = getNumbers(conteudo)					 		//Remove tudo o que não é dígito
	conteudo = conteudo.replace(/(\d)(\d{6})$/,"$1/$2");    //Coloca barra entre o segundo e o terceiro dígitos
	conteudo = conteudo.replace(/(\d)(\d{4})$/,"$1/$2");    //Coloca barra entre o quarto e o quinto dígitos
	$(this).val(conteudo);
});

//Evento que ocorre quanto uma tecla é pressionada no campo que tem a classe RG
$("#formcadastrar input.rg").keyup(function(){
	var conteudo = $(this).val();
	conteudo = getNumbers(conteudo)					 		//Remove tudo o que não é dígito
	conteudo = conteudo.replace(/(\d)(\d{7})$/,"$1.$2");    //Coloca ponto entre o segundo e o terceiro dígitos 00.000.000-0
	conteudo = conteudo.replace(/(\d)(\d{4})$/,"$1.$2");    //Coloca hífen entre o quinto e o sexto dígitos 00.000.000-0
	conteudo = conteudo.replace(/(\d)(\d{1})$/,"$1-$2");    //Coloca hífen entre o quinto e o sexto dígitos 00.000.000-0
	
	$(this).val(conteudo);
});

//Evento que ocorre quando uma tecla é pressionada no campo que tem a classe cpf
$("#formcadastrar input.cpf").keyup(function(){
	var conteudo = $(this).val();

	//Remove tudo o que não é dígito
	conteudo = getNumbers(conteudo);             
	//Coloca um ponto entre o terceiro e o quarto dígitos
    conteudo = conteudo.replace(/(\d{3})(\d)/,"$1.$2")

    //Coloca um ponto entre o terceiro e o quarto dígitos
    //de novo (para o segundo bloco de números)
    conteudo = conteudo.replace(/(\d{3})(\d)/,"$1.$2")

    //Coloca um hífen entre o terceiro e o quarto dígitos
    conteudo = conteudo.replace(/(\d{3})(\d{1,2})$/,"$1-$2")    

    $(this).val(conteudo);
});

//Validação genérica para validar vários tipos de campo
function validaCampo(elm){
	var nome = $(elm).attr('name');
 	var tipo = $(elm).attr('type');
 	var nomespan = '.msg-' + nome;
 	var caixa_msg = document.querySelector(nomespan);
 	var mensagem = "";

 	if($(elm).hasClass("obrigatorio") && removeMascara($(elm).val()) == ""){   
 		mensagem = "Campo obrigatório";
        //$(this).css({"border" : "1px solid #F00", "padding": "2px"});
    }else if(tipo == "number" && $(elm).val() != ""){
    	if(!isNumber($(elm).val())){		 		
 			mensagem = "Informe um número válido para o campo";
 		}else if(parseFloat($(elm).val()) <= 0 ){
 			mensagem = "Informe um número maior que zero para o campo";
 		}
 	}else if((tipo == "email" || $(elm).hasClass("email")) && !isEmail($(elm).val())){
 		mensagem = "Informe um e-mail válido";
 	}else if($(elm).hasClass("cpf") && !validarCPF($(elm).val())){
 		mensagem = "O CPF informado é inválido"
 	}else if($(elm).hasClass("cep") && !isCEP($(elm).val())){
 		mensagem = "O CEP informado não é válido"
 	}else if($(elm).hasClass("telefone") && !isTelefone($(elm).val())){
 		mensagem = "O Telefone informado não é válido"
 	}else if($(elm).hasClass("celular") && !isCelular($(elm).val())){
 		mensagem = "O Celular informado não é válido"
 	}

 	if(mensagem != ""){
 		//$(elm).css({"border-color" : "#D2691E"});
 		if(caixa_msg != null){
         	caixa_msg.innerHTML = mensagem;
			caixa_msg.style.display = "block";
			caixa_msg.style.color = "#D2691E";        		
    	}
 	}else{
 		if(caixa_msg != null){
    		caixa_msg.style.display = "none";
		}
 	}
 	return mensagem == "";
}

function isNumber(texto) {
    return !isNaN(parseFloat(texto)) && isFinite(texto);
}

function validarCPF(cpf) {  
    cpf = getNumbers(cpf);   
    if(cpf == '') return false; 
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

	//if(email.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z0-9._-]+)/gi)){
	//	return true;
	//}else{
	//	return false;
	//}


    //var exclude=/[^@-.w]|^[_@.-]|[._-]{2}|[@.]{2}|(@)[^@]*1/;
    //var check=/@[w-]+./;
    //var checkend=/.[a-zA-Z]{2,3}$/;
    //if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){
    //	return false;
    //}
    //else {
    //	return true;
    //}
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
    var objER =  /\([1-9]{2}\)\ [3-9]{1}\d{3}\-\d{4}/;
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
