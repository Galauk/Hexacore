<?
	session_start();
	$_SESSION[auten] = "";
	if(!$auten):
		header('location:index.php');
	endif;
?>