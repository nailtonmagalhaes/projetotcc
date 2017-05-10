<?php
	
	// O nome do banco de dados
	define('DB_NAME', 'dbescolamusica');
	// Usuário do banco de dados MySQL 
	define('DB_USER', 'root');
	// Senha do banco de dados MySQL 
	define('DB_PASSWORD', '');
	// nome do host do MySQL 
	define('DB_HOST', 'localhost');
	
	
	/*
	// O nome do banco de dados
	define('DB_NAME', 'marciovieira_tcc');
	// Usuário do banco de dados MySQL 
	define('DB_USER', 'marci_root');
	// Senha do banco de dados MySQL 
	define('DB_PASSWORD', '#@Bl860');
	// nome do host do MySQL 
	define('DB_HOST', 'robb0372.publiccloud.com.br');
	*/

	/** caminho absoluto para a pasta do sistema **/
	if ( !defined('ABSPATH') )
		define('ABSPATH', dirname(__FILE__) . '/');
		
	/** caminho no server para o sistema **/
	if ( !defined('BASEURL') )
		define('BASEURL', '/crud-bootstrap-php/');
		
	/** caminho do arquivo de banco de dados **/
	if ( !defined('DBAPI') )
		define('DBAPI', ABSPATH . 'database.php');
?>