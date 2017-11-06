<?
	//Titulo da pagina
	$titu = "ADMINISTRADORES";
	
	//Tabela do Banco de Dados
	$tabela = "admin";
	
	//informações para listagem
		//Titulo de apresentação das Variaveis
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
	
	//Informações para edição
		//Titulo de apresentação das Variaveis
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
		
	//Informções extras
		//Variavel de seleção
		$sel = array(
		"",
		"");
	
	//inclui arquivo biblia
	include_once "BD.php";
?>
