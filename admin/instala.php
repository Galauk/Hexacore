<?
	//Conecta ao banco de dados
	include_once "conecte.php";
	
	$criar = $_GET[criar];
?>
<body style='font-size:12px; font-family:Arial;'>
<?
	function query($x){
		mysql_query($x);
	}

	//Função que verifica o que existe no Banco de Dados
	function linha($n,$x) {
		if($n >= 1):
			echo " <b style='color:#339900;'>Criado</b><br>";
		else:	
			echo " <a href='?criar=$x' style='text-decoration:none;'><b style='color:#CC3300;'>Criar</b></a><br>";
		endif;

	}
	
	//Função que cria tabelas no Banco de dados
	function cria($x,$y,$z) {
		if($x == "admin"):
			$s = "CREATE TABLE IF NOT EXISTS `$x` (
			`id` int(15) NOT NULL auto_increment,
			`nome` varchar(255) NOT NULL,
			`login` varchar(255) NOT NULL,
			`senha` varchar(255) NOT NULL,
			`nivel` varchar(255) NOT NULL,
			PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

			$s1 = "CREATE TABLE IF NOT EXISTS `del` (
			`id` int(15) NOT NULL auto_increment,
			`admin` varchar(255) NOT NULL,
			`tabela` varchar(255) NOT NULL,
			`info` varchar(255) NOT NULL,
			`data` date NOT NULL,
			`hora` varchar(255) NOT NULL,
			PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

			$s2 = "CREATE TABLE IF NOT EXISTS `log` (
			`id` int(15) NOT NULL auto_increment,
			`admin` varchar(255) NOT NULL,
			`data` date NOT NULL,
			`hora` varchar(255) NOT NULL,
			PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		endif;
		$s3 = "INSERT INTO $x ($y) VALUES ($z)";
		query($s);
		query($s1);
		query($s2);
		query($s3);
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=instala.php'>";
	}

	//Função que leh o Banco de dados
	function checa($x) {
		$s = "SELECT * FROM $x";
		$q = mysql_query($s);
		$n = @mysql_num_rows($q);
		if($x == "admin"):
			echo "Administrador :";
			linha($n,$x);
		endif;
	}

		checa("admin");
		
	if($criar == "admin"):

		//Cria Tabela Admin 
		$y = "`id`, `nome`, `login`, `senha`, `nivel`";
		$z = "1, 'Grupo UDS', 'root', 'forever', '0,1,2,3,4,5,6,7,8,9'";
		cria($criar,$y,$z);

	elseif($criar == "log"):

		//Cria Tabela de Log
		$y = "`id`, `admin`, `data`, `hora`";
		$z = "1, 'Teste', '00:00:00', '0000-00-00'";
		cria($criar,$y,$z);

	elseif($criar == "del"):

		//Cria Tabela de Deletados
		$y = "`id`, `admin`, `tabela`, `info`, `data`, `hora`";
		$z = "1, 'Teste', 'teste', 'informação', '00:00:00', '0000-00-00'";
		cria($criar,$y,$z);

	endif
?>
</body>