<?
	include_once "conecte.php";

	$env = $_POST[env];
	if($env):
		$login = $_POST[login];
		$senha = $_POST[senha];
	
		$s = "SELECT nome, login, senha, nivel FROM admin WHERE login LIKE '$login' AND senha LIKE '$senha'";
		$q = mysql_query($s);
		$n = @mysql_num_rows($q);
		$a = mysql_fetch_array($q);
		
		if($n > 0):
			session_start();
			$_SESSION[auten] = $a[nivel];
			if(!$_SESSION[auten]):
				$_SESSION[auten] = "9999";
			endif;
			$_SESSION[log] = $a[nome];
			$log = $a[nome];
			
			$data = date("Y-m-d");
			$hora = date("H:i:s");
			
			$s = "INSERT INTO log (id,admin,data,hora) VALUES('','$log','$data','$hora')";
			$q = mysql_query($s);
			
			header('location:index2.php');
		else:
			header('location:index.php?msg=Acesso Negado');
		endif;		
	else:
		require_once "start.php";
		$msg = $_GET[msg];
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div align='center'>
	<table cellpadding='0' cellspacing='0'>
		<tr>
			<td><img src='images/bord1.png'></td>
			<td><img src='images/uds.png'></td>
			<td><img src='images/separa.png'></td>
			<td><img src='images/adm.png'></td>
			<td><img src='images/bord2.png'></td>
		</tr>
	</table>
	<br>
	<table cellpadding='0' cellspacing='0'>
		<tr>
			<td><img src='images/bord01.png'></td>
			<td class='log' valign='top' width='300'>
				<form action='' method='post'>
					<table cellpadding='0' cellspacing='0' style='padding-left:30px;'>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
<?
	if($msg):
?>
						<tr>
							<td></td>
							<td><?=$msg?></td>
						</tr>
<?
	endif;
?>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Usuario:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input name='login' type='text' class='x'></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Senha: </td>
							<td><input name='senha' type='password' class='x'></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td></td>
							<td align='right'>
								<input type='hidden' name='env' value='123'>
								<input type='image' src='images/entrar.png'>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
					</table>
				</form>
			</td>
			<td>
				<img src='images/separa2.png'>
			</td>
			<td align='center' class='log' width='250'>
				Imagem Logo<br>
				Formato(250x200)
			</td>
			<td><img src='images/bord02.png'></td>
		</tr>
	</table>
</div>
<?
	endif;
?>