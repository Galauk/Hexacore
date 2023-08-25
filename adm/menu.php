<?
	// nome dos menus disponiveis(a 1º posição é o nome da tabela)
	// Link dos menus (a 1º posição é referente ao 1º link)
	$menu[0] = array("ADMINISTRADORES","admins");
	$link[0] = array("admin");
	$menu[1] = array("DOWNLOADS","listar");
	$link[1] = array("downloads");
	$menu[2] = array("IMAGENS","listar");
	$link[2] = array("fotos");
	$menu[3] = array("RECADOS","listar");
	$link[3] = array("recado");

?>
<!-- NÃO MECHER NESSE CODIGO-->
<script>
	function mostradiv(div){
		if (document.getElementById(div).style.display=="block"){
			document.getElementById(div).style.display="none";
		}else{
			document.getElementById(div).style.display="block";
		}
	}
</script>
<!-- NÃO MECHER NESSE CODIGO-->
<?
	$conta = 0;

	while($menu[$conta][0] != ""):
?>
<table cellpadding='5' cellspacing='0' class='ts' width='100%'>
	<tr>
		<td class='tp'><?=$menu[$conta][0]?></td>
		<td align='right' class='tp'><a href="javascript:mostradiv('<?=$menu[$conta][0]?>');" class='tp'>-</a></td>
	</tr>
</table>
<table cellpadding='5' cellspacing='0' class='ts' width='100%' id='<?=$menu[$conta][0]?>'>
<?
		$conta2 = 1;
		while($menu[$conta][$conta2] != ""):
?>
	<tr>
		<td colspan='2'>
<?	if($link[$conta][($conta2-1)]):
?>
			<a href='?pg=<?=$link[$conta][($conta2-1)]?>'>
<?
	endif;
?>
				<?=$menu[$conta][$conta2]?>
			</a>
		</td>
	</tr>
<?
			$conta2++;
		endwhile;
?>
</table>
<br>
<?
		$conta++;
	endwhile;
?>