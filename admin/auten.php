<?
	session_start();
	$auten = $_SESSION[auten];
	$log = $_SESSION[log];
	if(!$auten):
		header('location:index.php?msg=Acesso Negado');
	endif;
?>