<?
	//Conecta ao Banco de Dados
	include_once "conecte.php";

	// nome dos menus disponiveis(a 1º posição é o nome da tabela)
	
	$menu[0] = array("ADMIN","Admins");
	$menu[1] = array("PRODUTO","Produtos");
	$menu[2] = array("PEDIDOS","Pedidos");

	// Link dos menus (a 1º posição é referente ao 1º link)
	$link[0] = array("admin");
	$link[1] = array("prod");
	$link[2] = array("pedido");

	$auten = $_SESSION[auten];
	$nivel = explode(",",$auten);
	
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
		$checa = in_array($conta,$nivel);
		if($checa == 1):
?>
<table cellpadding='5' cellspacing='0' class='titulo'>
	<tr>
		<td class='menu' style='padding-top:8px;padding-left:30px;'><b><?=$menu[$conta][0]?></b></td>
		<td align='right' class='tp'>&nbsp;</td>
	</tr>
</table>
<table cellpadding='5' cellspacing='0' class='menu_bord' id='<?=$menu[$conta][0]?>' style='display:block;width:250px;'>
<?
			$conta2 = 1;
			while($menu[$conta][$conta2] != ""):
?>
	<tr>
		<td>
<?
				if($link[$conta][($conta2-1)]):
?>
			<a href='?pg=<?=$link[$conta][($conta2-1)]?>' style='padding-left:5px;color: #666666'>
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
		endif;
		$conta++;
	endwhile;
?>