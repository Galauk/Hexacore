<?
	//Titulo da pagina
	$titu = "PEDIDOS";
	
	//Tabela do Banco de Dados
	$tabela = "pedido";
	
	//informações para listagem
		//Titulo de apresentação das Variaveis
		$titulo = array(
		"Codigo",
		"Nome");
		
		//Variaveis
		$campo = array(
		"id",
		"mesa");
		
		//Tipo da variavel
		$tipo = array(
		"titulo",
		"titulo");
	
	//Informações para edição
		//Titulo de apresentação das Variaveis
		$titulo2 = array(
		"Codigo",
		"Mesa");
		
		//Variaveis
		$campo2 = array(
		"id",
		"mesa");
		
		//Tipo da variavel
		$tipo2 = array(
		"titulo",
		"titulo");
		
	//Informções extras
		//Variavel de seleção
		$sel = array(
		"",
		"");
	
	//inclui arquivo biblia
	include_once "BD.php";
?>