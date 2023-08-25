<?
	$pg = $_GET[pg];
?>
<table cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td valign='top' width='150'>
<?
	include_once "menu.php";
?>
		</td>
		<td valign='top' style='padding-left:10px;'>
<?
	if($pg):
		include_once "$pg.php";
	else:
		include_once "main.php";
	endif;
?>
		</td>
	</tr>
</table>