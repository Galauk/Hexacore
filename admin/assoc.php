<?
	//Titulo da pagina
	$titu = "ASSOCIADOS";
	
	//Tabela do Banco de Dados
	$tabela = "assoc";
	
	//informa��es para listagem
		//Titulo de apresenta��o das Variaveis
		$titulo = array(
		"Codigo",
		"Categorias",
		"Nome");
		
		//Variaveis
		$campo = array(
		"id",
		"id_categ",
		"nome");
		
		//Tipo da variavel
		$tipo = array(
		"titulo",
		"sele��o",
		"titulo");
	
	//Informa��es para edi��o
		//Titulo de apresenta��o das Variaveis
		$titulo2 = array(
		"Codigo",
		"Categorias",
		"Nome");
		
		//Variaveis
		$campo2 = array(
		"id",
		"id_categ",
		"nome");
		
		//Tipo da variavel
		$tipo2 = array(
		"titulo",
		"sele��o",
		"titulo");
		
	//Inform��es extras
		//Variavel de sele��o
		$sel = array(
		"",
		"nome",
		"");
	
	//inclui arquivo biblia
	include_once "BD.php";
?>