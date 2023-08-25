<?
	//Titulo da pagina
	$titu = "ASSOCIADOS";
	
	//Tabela do Banco de Dados
	$tabela = "assoc";
	
	//informaчѕes para listagem
		//Titulo de apresentaчуo das Variaveis
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
		"seleчуo",
		"titulo");
	
	//Informaчѕes para ediчуo
		//Titulo de apresentaчуo das Variaveis
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
		"seleчуo",
		"titulo");
		
	//Informчѕes extras
		//Variavel de seleчуo
		$sel = array(
		"",
		"nome",
		"");
	
	//inclui arquivo biblia
	include_once "BD.php";
?>