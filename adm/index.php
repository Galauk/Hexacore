<?
	include_once "conecte.php";
	
	$env = $_POST[env];
	if($env):
		$login = $_POST[login];
		$senha = $_POST[senha];
	
		$s = "SELECT login, senha FROM admin WHERE login LIKE '$login' AND senha LIKE '$senha'";
		$q = mysql_query($s);
		$n = @mysql_num_rows($q);
		
		if($n > 0):
			session_start();
			$_SESSION[auten] = "1";
			header('location:body.php');
		else:
			header('location:index.php?msg=Acesso Negado');
		endif;		
	else:
		include_once "start.php";
		$msg = $_GET[msg];
?>
<div align='center'>
<br>
<br>
<br>
<br>
	<form action='' method='post'>
		<table cellpadding='5' cellspacing='0' class='ts'>
			<tr>
				<td class='tp' colspan='30'>ADMINISTRADOR</td>
			</tr>
<?
		if($msg):
?>
			<tr>
				<td align='center' class='erro' colspan='30'><?=$msg?></td>
			</tr>
<?
		endif;
?>
			<tr>
				<td>Login:</td>
				<td><input class='x2' name='login' type='text'></td>
			</tr>
			<tr>
				<td>Senha:</td>
				<td><input class='x2' name='senha' type='password'></td>
				<td><input type='hidden' name='env' value='1'><input type='image' src='images/arrow.jpg'></td>
			</tr>
		</table>
	</form>
</div>
<?
	endif;
?>