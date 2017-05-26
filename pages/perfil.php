<?php 
	include_once 'valida-sessao.php';
  	class EPerfil{
	  	const None = 0;
	    const Aluno = 1;
	    const Professor = 2;
	    const Secretaria = 3;
	    const Administrador = 99;
	}

	class ESituacaoCadastro{
	    const Ativo = 1;
	    const Inativo = 0;
	}

 ?>