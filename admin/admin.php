<?
	//Titulo da pagina
	$titu = "ADMINISTRADORES";
	
	//Tabela do Banco de Dados
	$tabela = "admin";
	
	//informa��es para listagem
		//Titulo de apresenta��o das Variaveis
		$titulo = array(
		"Codigo",
		"Nome");
		
		//Variaveis
		$campo = array(
		"id",
		"nome");
		
		//Tipo da variavel
		$tipo = array(
		"titulo",
		"titulo");
	
	//Informa��es para edi��o
		//Titulo de apresenta��o das Variaveis
		$titulo2 = array(
		"Codigo",
		"Nome",
		"Login",
		"Senha",
		"Acesso");
		
		//Variaveis
		$campo2 = array(
		"id",
		"nome",
		"login",
		"senha",
		"nivel");
		
		//Tipo da variavel
		$tipo2 = array(
		"titulo",
		"titulo",
		"titulo",
		"titulo",
		"adm");
		
	//Inform��es extras
		//Variavel de sele��o
		$sel = array(
		"",
		"");
	
	//inclui arquivo biblia
	include_once "BD.php";
?>
