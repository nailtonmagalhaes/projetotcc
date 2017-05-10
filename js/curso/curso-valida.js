//referencia: http://www.devwilliam.com.br/javascript/validar-formulario-usando-javascript
var form = document.getElementById("formcadastrarcurs");

if (form.addEventListener) {                   
    form.addEventListener("submit", validaCadastro);
} else if (form.attachEvent) {                  
    form.attachEvent("onsubmit", validaCadastro);
}

function validaCadastro(evt){
	var descricao = document.getElementById('crsDescricao');
	var duracao = document.getElementById('crsDuracao');
	var contErro = 0;


	/* Validação do campo descricao */
	caixa_descricao = document.querySelector('.msg-descricao');
	if(descricao.value == ""){
		caixa_descricao.innerHTML = "Preencha o campo Descrição";
		caixa_descricao.style.display = 'block';
		contErro += 1;
	}else{
		caixa_descricao.style.display = 'none';
	}

	/* Validação do campo duracao */
	caixa_duracao = document.querySelector('.msg-duracao');
	if(duracao.value == ""){
		caixa_duracao.innerHTML = "Preencha o campo Duração";
		caixa_duracao.style.display = 'block';
		contErro += 1;
	}else if(duracao.value <= 0){
		caixa_duracao.innerHTML = "Preencha o campo Duração com um valor maior que zero";
		caixa_duracao.style.display = 'block';
		contErro += 1;
	}else{
		caixa_duracao.style.display = 'none';
	}	

	if(contErro > 0){
		evt.preventDefault();
	}
} 

/*
var form = document.getElementById("form-contato");
 
if (form.addEventListener) {                   
    form.addEventListener("submit", validaCadastro);
} else if (form.attachEvent) {                  
    form.attachEvent("onsubmit", validaCadastro);
}

function validaCadastro(evt){
	var nome = document.getElementById('nome');
	var email = document.getElementById('email');
	var sexo = document.getElementById('sexo');
	var senha = document.getElementById('senha');
	var senha2 = document.getElementById('senha2');
	var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var contErro = ;
 
 
	// Validação do campo nome 
	caixa_nome = document.querySelector('.msg-nome');
	if(nome.value == ""){
		caixa_nome.innerHTML = "Favor preencher o Nome";
		caixa_nome.style.display = 'block';
		contErro += 1;
	}else{
		caixa_nome.style.display = 'none';
	}
 
	// Validação do campo email 
	caixa_email = document.querySelector('.msg-email');
	if(email.value == ""){
		caixa_email.innerHTML = "Favor preencher o E-mail";
		caixa_email.style.display = 'block';
		contErro += 1;
	}else if(filtro.test(email.value)){
		caixa_email.style.display = 'none';
	}else{
		caixa_email.innerHTML = "Formato do E-mail inválido";
		caixa_email.style.display = 'block';
		contErro += 1;
	}	
 
	// Validação do campo sexo 
	caixa_sexo = document.querySelector('.msg-sexo');
	if(sexo.value == ""){
		caixa_sexo.innerHTML = "Favor preencher o Sexo";
		caixa_sexo.style.display = 'block';
		contErro += 1;
	}else{
		caixa_sexo.style.display = 'none';
	}
 
	// Validação do campo senha
	caixa_senha = document.querySelector('.msg-senha');
	if(senha.value == ""){
		caixa_senha.innerHTML = "Favor preencher a Senha";
		caixa_senha.style.display = 'block';
		contErro += 1;
	}else if(senha.value.length < 6){
		caixa_senha.innerHTML = "Favor preencher a Senha com o mínimo de 6 caracteres";
		caixa_senha.style.display = 'block';
		contErro += 1;
	}else{
		caixa_senha.style.display = 'none';
	}
 
	// Validação do campo repita a senha 
	caixa_senha2 = document.querySelector('.msg-senha2');
	if(senha2.value == ""){
		caixa_senha2.innerHTML = "Favor preencher o campo Repita a Senha";
		caixa_senha2.style.display = 'block';
		contErro += 1;
	}else if(senha2.value.length < 6){
		caixa_senha2.innerHTML = "Favor preencher o campo Repita a Senha com o mínimo de 6 caracteres";
		caixa_senha2.style.display = 'block';
		contErro += 1;
	}else{
		caixa_senha2.style.display = 'none';
	}
 
	// Valida se a senha é igual ao campo repita a senha 
	if(senha.value != "" && senha2.value != "" && senha.value != senha2.value){
		caixa_senha2.innerHTML = "O campo Repita a Senha é diferente do campo Senha";
		caixa_senha2.style.display = 'block';
		contErro += 1;
	}
 
	if(contErro > ){
		evt.preventDefault();
	}
}
*/