<?

	//Conecta ao Banco de Dados
	include_once "conecte.php";

	$acao	= $_REQUEST[acao];
	$id 	= $_GET[id];
	$pag	= $_GET[pag];
	
	//Campos para busca
	$busca	= $_REQUEST[busca];
	$selec	= $_REQUEST[selec];
	
	//Variavel para ordenar tabela
	$y		= $_GET[y];

	//Numero de registro por paginação
	$lim	= 15;

	//Pasta de arquivos upados
	$thumb	= "../uploads/"; //Exemplo: "/uploads"

	//Tamanho dos uploads
	$larg	= 200; //preferencia alterar esse
	$altu	= 0; //se alterar esse tomar cuidado para não cortar a imagem

	//Gera o array para a busca
	$conta = 0;
	while ($conta < 999):
		if ($campo[$conta] != ""):
			if ($conta >= 1):
				$array.= ", ".$campo[$conta];
			else:
				$array = " ".$campo[$conta];
			endif;
		endif;
		$conta++;
	endwhile;

	
	
?>
<table cellpadding='0' cellspacing='0' width='725'>
	<tr>
		<td class='main'><b><?=$titu?></b></td>
	</tr>
	<tr>
		<td align='center' class='menu_bord'>
<?
	/////////////////////////////////////////////////////////////////////////////
	//
	//	Lista todos os registros
	//
	/////////////////////////////////////////////////////////////////////////////

	if($acao == "" || $acao == "list"):
		
		//Busca para paginação
		$s1	= "SELECT * FROM $tabela";
		if($busca) $s1.=" WHERE $selec LIKE '%$busca%'";
		$q1 = mysql_query($s1);
		$n1 = @mysql_num_rows($q1);
		
		
		
		//Guarda o numero total de cadastros da tabela
		$cads = $n1;

		//Gera os calculos para a paginação
		$totp = ceil($n1/$lim); //total de paginas
		$pgto = ($pag*$lim); //ordem de partida da paginação

		// Busca e lista todas as linhas oferecidas no Arquivo Base 
		$s = "SELECT $array FROM $tabela";
		
		//Adiciona o codigo de Busca no SQL
		if($busca):
			//Verifica se for de outra tabela
			$plode = explode('_',$selec);
			if($plode[1] != ""):
				$cont = 0;
				while($cont < 999):
					if($selec == $campo2[$cont]) $selec2 = $sel[$cont];
					$cont++;
				endwhile;
				$s2 = "SELECT id FROM $plode[1] WHERE $selec2 LIKE '$busca%'";
				$q2 = mysql_query($s2);
				$a2 = @mysql_fetch_array($q2);
				$busca = $a2[0];
				$s.=" WHERE $selec LIKE '%$busca%'";
			else:
				$s.=" WHERE $selec LIKE '%$busca%'";
			endif;
		endif;
		
		//Adiciona o codigo de ordem no SQL
		if($y):
		 	$s.=" ORDER BY $y";
		else:
		 	$s.=" ORDER BY 1";
		endif;
		
		$s.=" LIMIT $pgto,$lim";
		$q = mysql_query($s);
?>
			<table cellpadding='5' cellspacing='0' width='100%'>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td align='center' colspan='10'>
						<form action='' method='post'>
							<table cellpadding='0' cellspacing='0'>
								<tr>
									<td>
										<input name='busca' style='width:300px;'>
										<select name='selec'>
<?
	$cont = 0;
	while($cont < 999):
		if($campo2[$cont] != ""):
?>
											<option value='<?=$campo2[$cont]?>'><?=$titulo2[$cont]?></option>
<?
		endif;
		$cont++;
	endwhile;
?>
										</select>
									</td>
									<td>&nbsp;<input type='image' src='images/enviar.png'></td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
<?
		$conta = 0;
		while($titulo[$conta] != ""):
?>
					<td class='topo' align='center'><b><a href='?pg=<?=$pg?>&y=<?=$campo[$conta]?>' style='color:#666666'><?=$titulo[$conta]?></a></b></td>
<?
			$conta++;
		endwhile;
?>
					<td class='topo' align='center'><b>Funções</b></td>
				</tr>
<?
		$conta2 = 0;
		while ($a = @mysql_fetch_row($q)):
			if($conta2%2 == 0):
?>
				<tr class='linha1'>
<?
			else:
?>
				<tr class='linha2'>
<?
			endif;
			$conta = 0;
			while($campo[$conta]):
				if($tipo[$conta] == "titulo"):
?>
					<td class='meio' align='center'><?=$a[$conta]?></td>
<?
				elseif($tipo[$conta] == "data"):
						$da = explode('-',$a[$conta]);
						list($ano,$mes,$dia) = $da;
?>
					<td class='meio' align='center'><?=$dia?>/<?=$mes?>/<?=$ano?></td>
<?
				elseif($tipo[$conta] == "texto"):
?>
					<td class='meio' align='center'><?=substr($a[$conta],0,40)?>...</td>
<?
				elseif($tipo[$conta] == "imagem"):
?>
					<td class='meio' align='center'><? if($a[$conta] != ""):?><a href='<?=$thumb?><?=$a[$conta]?>' class="highslide" onclick="return hs.expand(this)"><img alt='Imagem' src='<?=$thumb?><?=$a[$conta]?>' height='40px'></a><? endif;?></td>
<?
				elseif($tipo[$conta] == "arquivo"):
?>
					<td class='meio' align='center'><a href='<?=$thumb?><?=$a[$conta]?>'><img alt='Arquivo' src='images/file.png'></a></td>
<?
				elseif($tipo[$conta] == "seleção"):
					$exp = explode("_",$campo[$conta]);
					$s2 = "SELECT $sel[$conta] FROM $exp[1] WHERE id = $a[$conta]";
					$q2 = mysql_query($s2);
					$a2 = @mysql_fetch_array($q2);
?>
					<td class='meio' align='center'><?=$a2[0]?></td>
<?
				elseif($tipo[$conta] == "compativel"):
					$exp = explode("_",$campo[$conta]);
					$exp2 = explode(",",$a[$conta]);
					$conta3 = 0;
					$com = "";
					while($conta3 < 999):
						$s2 = "SELECT $sel[$conta] FROM $exp[1] WHERE id = $exp2[$conta3]";
						$q2 = mysql_query($s2);
						$a2 = @mysql_fetch_array($q2);
						if($a2[0] != ""):
							$com.= $a2[0]."<br>";
						endif;
						$conta3++;
					endwhile;
?>
					<td class='meio' align='center'><?=$com?></td>
<?
				else:
?>
					<td class='meio' align='center'>&nbsp;</td>
<?
				endif;
				$conta++;
			endwhile;
?>
					<td class='meio' align='center'>
						<a href='?pg=<?=$pg?>&acao=view&id=<?=$a[0]?>'><img title='Visualizar' src='images/view.png'></a>
						<a href='?pg=<?=$pg?>&acao=edit&id=<?=$a[0]?>'><img title='Editar' src='images/edit.png'></a>
						<a href='?pg=<?=$pg?>&acao=del&id=<?=$a[0]?>'><img title='Apagar' src='images/del.png'></a>
					</td>
<?
			$conta2++;
		endwhile;
?>
				</tr>
			</table>
			<br>
			<table cellpadding='0' cellspacing='0' width='100%'>
				<tr>
					<td align='center'>
						<a href='?pg=<?=$pg?>&acao=novo'><img src='images/new.png'></a>
					</td>
				</tr>
			</table>
			<br>
			<table cellpadding='5' cellspacing='0' class='ts' width='100%'>
				<tr>
					<td align='center'>Mostrando <?=($pgto+1)?> de <?=$cads?> registro(s) encontrado(s) em<b> <?=$totp?> página(s)</b></td>
				</tr>
			</table>
			<br>
			<table cellpadding='5' cellspacing='0' class='ts' width='100%'>
				<tr>
					<td align='center'>
						<table cellpadding='0' cellspacing='0'>
							<tr>
<?
		$conta = 0;
		while($conta < $totp):
			
?>
								<td align='center' width='20px' <? if($pag == $conta) echo "bgcolor='FF9900'";?>>
									<a<? if($pag == $conta) echo " style='color: #FFFFFF'";?> style='color: #666666' href='?pg=<?=$pg?>&pag=<?=$conta?><? if($busca) echo "&busca=$busca&selec=$selec";?><? if($y) echo "&y=$y";?>'><b><?=($conta+1)?></b></a>
								</td>
<?
			$conta++;
		endwhile;
?>
							</tr>
						</table>
					</td>
				</tr>
			</table>
<?
	/////////////////////////////////////////////////////////////////////////////
	//
	//	Visualizar registros
	//
	/////////////////////////////////////////////////////////////////////////////

	elseif($acao == "view"):

?>
			<table cellpadding='5' cellspacing='0' class='ts' width='100%'>
<?
		$s = "SELECT * FROM $tabela WHERE id = $id";
		$q = mysql_query($s);
		$a = mysql_fetch_row($q);
		$conta = 0;
		while($conta < 999):
			if($a[$conta] != ""):
				if($conta%2 == 0):
					echo "<tr class='linha1'>";
				else:
					echo "<tr class='linha2'>";
				endif;
?>
					<td class='meio' valign='top'><?=$titulo2[$conta]?></td>
<?
				if($tipo2[$conta] == "titulo"):
?>
					<td class='meio'><?=$a[$conta]?></td>
<?
				elseif($tipo2[$conta] == "texto"):
?>
					<td class='meio'><?=nl2br($a[$conta])?></td>
<?
				elseif($tipo2[$conta] == "data"):
						$da = explode('-',$a[$conta]);
						list($ano,$mes,$dia) = $da;
?>
			<td class='meio'><?=$dia?>/<?=$mes?>/<?=$ano?></td>
<?
				elseif($tipo2[$conta] == "imagem"):
?>
					<td class='meio'><a href='<?=$thumb?><?=$a[$conta]?>' class="highslide" onclick="return hs.expand(this)"><img src='<?=$thumb?><?=$a[$conta]?>' width='200'></a></td>
<?
				elseif($tipo2[$conta] == "arquivo"):
?>
					<td class='meio'><a href='<?=$thumb?><?=$a[$conta]?>'><img src='images/file.png'></a></td>
<?
				elseif($tipo2[$conta] == "seleção"):
					$exp = explode("_",$campo2[$conta]);
					$s2 = "SELECT $sel[$conta] FROM $exp[1] WHERE id = $a[$conta]";
					$q2 = mysql_query($s2);
					$a2 = @mysql_fetch_row($q2);
?>
					<td class='meio'><?=$a2[0]?></td>
<?
				elseif($tipo2[$conta] == "compativel"):
					$exp = explode("_",$campo[$conta]);
					$exp2 = explode(",",$a[$conta]);
					$conta2 = 0;
					while($conta2 < 999):
						$s2 = "SELECT $sel[$conta] FROM $exp[1] WHERE id = $exp2[$conta2]";
						$q2 = mysql_query($s2);
						$a2 = @mysql_fetch_array($q2);
						if($a2[0] != ""):
							$com.= $a2[0]."<br>";
						endif;
						$conta2++;
					endwhile;
?>
					<td class='meio'><?=$com?></td>
<?
				elseif($tipo2[$conta] == "opção"):
?>
					<td class='meio'><?=$a[$conta]?></td>
<?
				elseif($tipo2[$conta] == "adm"):
					$chec = explode(",",$a[$conta]);
					$conta2 = 0;
?>
					<td class='meio'><?
					while($chec[$conta2] != ""):
						$adm = $chec[$conta2];
						 echo $menu[$adm][0]."<br>";
						 $conta2++;
					endwhile;
					?></td>
<?
				endif;
?>
				</tr>
<?
			endif;
			$conta++;
		endwhile;
?>
					<tr>
						<td align='left'>
							<input onclick='history.go(-1)' type='image' src='images/voltar.png'>
						</td>
					</tr>
			</table>
<?
	/////////////////////////////////////////////////////////////////////////////
	//
	//	Editar registros
	//
	/////////////////////////////////////////////////////////////////////////////

	elseif($acao == "edit"):

?>
			<form action='' method='post' enctype="multipart/form-data">
				<table cellpadding='5' cellspacing='0' class='ts' width='100%'>
<?
		$s = "SELECT * FROM $tabela WHERE id = $id";
		$q = mysql_query($s);
		$a = mysql_fetch_row($q);
		$conta = 0;
		while($conta < 999):
			if($tipo2[$conta] != ""):
				if($conta%2 == 0):
					echo "<tr class='linha1'>";
				else:
					echo "<tr class='linha2'>";
				endif;
?>
						<td class='meio' valign='top'><?=$titulo2[$conta]?></td>
<?
				if($tipo2[$conta] == "titulo"):
?>
						<td class='meio'><input name='<?=$campo2[$conta]?>' <?if($campo[$conta] == "id") echo "disabled='true'";?> class='x' type='text' value='<?=$a[$conta]?>'></td>
<?
				elseif($tipo2[$conta] == "texto"):
?>
						<td class='meio'><textarea  name='<?=$campo2[$conta]?>' class='x'><?=$a[$conta]?></textarea></td>
<?
				elseif($tipo2[$conta] == "data"):
						$da = explode('-',$a[$conta]);
						list($ano,$mes,$dia) = $da;
?>
						<td class='meio'><input type='text' name='<?=$campo2[$conta]?>' value='<?=$dia?>/<?=$mes?>/<?=$ano?>' class='x'></td>
<?
				elseif($tipo2[$conta] == "imagem"):
?>
						<td class='meio'>
<?
					if($a[$conta]):
?>
							<table>
								<tr>
									<td><a href='<?=$thumb?><?=$a[$conta]?>' class="highslide" onclick="return hs.expand(this)"><img src='<?=$thumb?><?=$a[$conta]?>' width='200'></a></td>
									<td valign='bottom'><a href='?pg=<?=$pg?>&acao=delimg&id=<?=$id?>&pos=<?=$conta?>'><img src='images/excluir.png'></a></td>
								</tr>
							</table>
<?
					endif;
?>
							<br>
							<input type='file' name='<?=$campo2[$conta]?>'>
						</td>
<?
				elseif($tipo2[$conta] == "arquivo"):
?>
						<td class='meio'>
<?
					if($a[$conta]):
?>
							<table>
								<tr>
									<td><a href='<?=$thumb?><?=$a[$conta]?>'><img src='images/file.png'></a></td>
									<td valign='bottom'><a href='?pg=<?=$pg?>&acao=delimg&id=<?=$id?>&pos=<?=$conta?>'><img src='images/excluir.png'></a></td>
								</tr>
							</table>
<?
					endif;
?>
							<br>
							<input type='file' name='<?=$campo2[$conta]?>'>
						</td>
<?
				elseif($tipo2[$conta] == "seleção"):
					$laga = explode("_",$campo2[$conta]);
					$lage = $sel[$conta];
					$lagi = "id, ".$lage;
					$tab = $laga[1];
?>
						<td class='meio'>
							<select name='<?=$campo2[$conta]?>'>
								<option value=''>--- Escolha ---</option>
<?
					$conta2 = 0;
					$s2 = "SELECT $lagi FROM $tab";
					$q2 = mysql_query($s2);
					while($a2 = mysql_fetch_array($q2)):
?>
								<option <? if($a[$conta] == $a2[id]) echo "selected='selected'";?> value='<?=$a2[id]?>'><?=$a2[$lage]?></option>
<?
						$conta2++;
					endwhile;
?>
							</select>
						</td>
<?
				elseif($tipo2[$conta] == "compativel"):
					$exp = explode("_",$campo[$conta]);
					$exp2 = explode(",",$a[$conta]);
?>
						<td class='meio'>
<?
					$conta2 = 0;
					$s2 = "SELECT * FROM $exp[1]";
					$q2 = mysql_query($s2);
					while($a2 = @mysql_fetch_array($q2)):
						if($a2[0] != ""):
?>
							<input <?
							$conta3 = 0;
							while($conta3 < 9999):
								if($a2[id] == $exp2[$conta3]):
									echo " checked='checked'";
								endif;
								$conta3++;
							endwhile;
							?> name='<?=$campo2[$conta]?><?=($conta2+1)?>' type='checkbox' value='1'><?=$a2[nome]?><br>
<?
						endif;
						$conta2++;
					endwhile;
?>
						</td>
<?
				elseif($tipo2[$conta] == "adm"):
?>
						<td class='meio'>
<?
							$adm = explode(",",$a[$conta]);
							$conta2 = 0;
							while($menu[$conta2][0] != ""):
?>
							<input <? if(in_array($conta2,$adm)==1) echo " checked";?> name='<?=$campo2[$conta].($conta2+1)?>' type='checkbox' value='1'><?=$menu[$conta2][0]?><br>
<?
								$conta2++;
							endwhile;
?>
						</td>
<?
				elseif($tipo2[$conta] == "opção"):
?>
						<td class='meio'>
							<select name='<?=$campo2[$conta]?>'>
								<option value=''>--- Escolha ---</option>
								<option <? if($a[$conta] == 1) echo "selected='selected'"?> value='1'>Sim</option>
								<option <? if($a[$conta] == 2) echo "selected='selected'"?> value='2'>Não</option>
							</select>
						</td>
<?
				endif;
?>
					</tr>
<?
			endif;
			$conta++;
		endwhile;
?>
					<tr>
						<td align='left'>
							<a href='?pg=<?=$pg?>'>
								<img onclick='history.go(-1)' src='images/voltar.png'>
							</a>
						</td>
						<td align='right'>
							<input type='hidden' name='acao' value='atua'>
							<input type='image' src='images/enviar.png'>
						</td>
					</tr>
				</table>
			</form>
<?
	/////////////////////////////////////////////////////////////////////////////
	//
	//	Atualizar Cadastro
	//
	/////////////////////////////////////////////////////////////////////////////

	elseif($acao == "atua"):
	
		//Gera copia de imagem para dentro de thumb
		$conta = 0;
		while($conta < 3000):
			$x = $campo2[$conta];
			$y = $_FILES[$x];
			if($tipo2[$conta] == "imagem" && $y['name'] != ""):
				$s = "SELECT $x FROM $tabela WHERE id = $id";
				$q = mysql_query($s);
				$n = @mysql_num_rows($q);
				$a = @mysql_fetch_array($q);
				
				if($n > 0):
					@unlink("$thumb$a[0]");
				endif;

				$file = $campo2[$conta];
				
				$f_name = $_FILES[$file]['name'];
				$f_tmp  = $_FILES[$file]['tmp_name'];
				$f_type = $_FILES[$file]['type'];
				
//------------------------------------------------------------//
				$p = getimagesize($f_tmp);
				
				//$p[3]= imagesx($f_name);

				if (!$larg or $larg==0) $larg = ($altu*$p[0])/$p[1];
				if (!$altu or $altu==0) $altu = ($larg*$p[1])/$p[0];
				$p_final = ($larg/$altu);
				$p_orig = $p[0]/$p[1];
			
				if ($p_orig >= $p_final) : //verifica se a largura eh maior q a altura
					$n_larg = ($p[0]-(($larg*$p[1])/$altu))/2;
					$x_i = $n_larg;
					$x_f = $p[0]-$n_larg*2;
					
					$y_i = 0;
					$y_f = $p[1];
				else: // a altura eh maior
					$x_i = 0;
					$x_f = $p[0];
					
					$n_altu = ($d[1]-(($altu*$p[0])/$larg))/2;
					$y_i = $n_altu;
					$y_f = $p[1]-$n_altu*2;
				endif;

				$src = imagecreatefromjpeg($f_tmp); //gera uma copia em jpg
				$img = ImageCreateTrueColor($larg, $altu); // gera uma imagem preta
				$branco = imagecolorallocate($img,255,255,255);  //gera a cor branca da preta
				$l = imagefill($img,0,0,$branco); //tranforma a preta em branca

/*
	$src = imagecreatefromjpeg($jpeg); //gera uma copia
	$dst = ImageCreateTrueColor($largura, $altura); // gera uma imagem preta
	$white = imagecolorallocate($dst,255,255,255);  //gera a cor branca da preta
	imagefill($dst,0,0,$white); //tranforma a preta em branca

	imagecopyresampled($dst,$src,0,0,$x_i,$y_i,$largura,$altura,$x_f,$y_f); // colocar a imagem por cima da imagem branca
	imagejpeg($dst, null, 98); // faz uma copia em jpg
*/
			
				$ima = imagecopyresampled($img,$src,0,0,$x_i,$y_i,$larg,$altu,$x_f,$y_f); // colocar a imagem por cima da imagem branca
				$ext = "jpg";

				$nome = (date(usiHd)+$conta).".".$ext;

				imagejpeg($img,$thumb.$nome, 98); // faz uma copia em jpg
				
//------------------------------------------------------------//

				$f[$conta] = $nome;

			elseif($tipo2[$conta] == "arquivo" && $y['name'] != ""):
				
				$s = "SELECT $x FROM $tabela WHERE id = $id";
				$q = mysql_query($s);
				$n = @mysql_num_rows($q);
				$a = @mysql_fetch_array($q);

				if($n > 0):
					@unlink("$thumb$a[0]");
				endif;
				
				$file = $campo2[$conta];
				
				$f_name = $_FILES[$file]['name'];
				$f_tmp  = $_FILES[$file]['tmp_name'];
				$f_type = $_FILES[$file]['type'];
				
				if($f_type == "application/msword"):
					$ext = "doc";
				elseif($f_type == "application/rtf"):
					$ext = "rtf";
				elseif($f_type == "text/plain"):
					$ext = "txt";
				elseif($f_type == "text/html"):
					$ext = "htm";
				elseif($f_type == "application/vnd.ms-excel"):
					$ext = "xls";
				elseif($f_type == "application/vnd.ms-powerpoint"):
					$ext = "pps";
				elseif($f_type == "image/gif"):
					$ext = "gif";
				elseif($f_type == "image/jpeg"):
					$ext = "jpg";
				else:
					$ext = explode(".",$f_name);
					$ext = array_reverse($ext);
					$ext = $ext[0];
				endif;

				
				$nome = (date(usiHd)+$conta).".".$ext;

				$up = move_uploaded_file($f_tmp, $thumb.$nome);

				$f[$conta] = $nome;
			elseif($tipo2[$conta] == "imagem" && $y['name'] == "" || $tipo2[$conta] == "arquivo" && $y['name'] == ""):
				$s = "SELECT $x FROM $tabela WHERE id = $id";
				$q = mysql_query($s);
				$a = mysql_fetch_array($q);
				$f[$conta] = $a[0];
			endif;
			$conta++;
		endwhile;
		
		//Gera a linha do codigo para UPDATE
		$conta = 0;
		while($conta < 3000):
			if($campo2[$conta] != ""):
				$x = $campo2[$conta];
				$y = $_POST[$x];
				if($conta == 0):
				elseif($conta == 1):
					$set.= $x."='".$y."'";
				else:
					if($tipo2[$conta] == "data"):
						$da = explode('/',$y);
						list($ano,$mes,$dia) = $da;
						$z = $dia."-".$mes."-".$ano;
						
						$set.= ", ".$x."='".$z."'";
					elseif($tipo2[$conta] == "imagem" || $tipo2[$conta] == "arquivo"):
						$y = $f[$conta];
						$set.= ", ".$x."='".$y."'";
					elseif($tipo2[$conta] == "compativel"):
						$conta2 = 1;
						while($conta2 < 9999):
							$xy = $_POST[$campo2[$conta].$conta2];
							if($xy == '1'):
								$y.= $conta2.",";
							endif;
							$conta2++;
						endwhile;
						$set.= ", ".$x."='".$y."'";
					elseif($tipo2[$conta] == "adm"):
						$conta2 = 1;
						while($conta2 < 9999):
							$xy = $_POST[$campo2[$conta].$conta2];
							if($xy == '1'):
								$y.= ($conta2-1).",";
							endif;
							$conta2++;
						endwhile;
						$set.= ", ".$x.'="'.$y.'"';
					else:
						$set.= ", ".$x."='".$y."'";
					endif;
				endif;
			endif;
			$conta++;
		endwhile;

		$s = "UPDATE $tabela SET $set WHERE id = $id ";
		$q = mysql_query($s) or die(mysql_error());
		if($q != ""):
?>
				<div align='center'>
					<table cellpadding='5' cellspacing='0' class='ts'>
						<tr>
							<td class='tp'>Atualização efetuada com sucesso.</td>
						</tr>
						<tr>
							<td align='center'><input class='img' type='image' src='images/voltar.png' onclick='history.go(-2)'></td>
						</tr>
					</table>
				</div>
<?
		else:
?>
				<div align='center'>
					<br>
					Cadastro com falha.<br>
					Contate seu Tecnico.<br>
					<input class='img' type='image' src='images/voltar.png' onclick='history.go(-2)'>
				</div>
<?
		endif;	
	/////////////////////////////////////////////////////////////////////////////
	//
	//	Deletar imagem ou arquivo
	//
	/////////////////////////////////////////////////////////////////////////////

	elseif($acao == "delimg"):
		$del = $_POST[del];
		$pos = $_GET[pos];
		if(!$del):
?>
			<form action='' method='post' enctype="multipart/form-data">
				<table cellpadding='5' cellspacing='0' class='ts'>
					<tr>
						<td class='topo' colspan='30'>Tem certeza que quer deletar?</td>
					</tr>
					<tr>
						<td align='center'>
							<a href='?pg=<?=$pg?>'><img src='images/nao.png'></a>
						</td>
						<td align='center'>
							<input type='hidden' name='pos' value='<?=$pos?>'>
							<input type='hidden' name='id' value='<?=$id?>'>
							<input type='hidden' name='del' value='ok'>
							<input type='image' src='images/sim.png'>
						</td>
					</tr>
				</table>
			</form>
<?
		else:

			$conta = 0;
			while($conta < 3000):
			
				if($tipo2[$conta] == "imagem" || $tipo2[$conta] == "arquivo"):
					$s = "SELECT $campo2[$pos] FROM $tabela WHERE id = $id";
					$q = mysql_query($s);
					$n = @mysql_num_rows($q);
					$a = @mysql_fetch_array($q);
					if($n > 0):
						@unlink("$thumb$a[0]");
						$s2 = "UPDATE $tabela SET $campo2[$pos] = '' WHERE id = $id";
						$q2 = mysql_query($s2);
					endif;
				endif;
				$conta++;
			endwhile;
			echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=?pg=$pg'>";
		endif;
	/////////////////////////////////////////////////////////////////////////////
	//
	//	Deletar registro
	//
	/////////////////////////////////////////////////////////////////////////////

	elseif($acao == "del"):
		$delet = $_POST[delet];
		if(!$delet):
?>
			<form action='' method='post' enctype="multipart/form-data">
				<table cellpadding='5' cellspacing='0' class='ts'>
					<tr>
						<td class='topo' colspan='30'>Tem certeza que quer deletar?</td>
					</tr>
					<tr>
						<td align='center'>
							<a href='?pg=<?=$pg?>'><img src='images/nao.png'></a>
						</td>
						<td align='center'>
							<input type='hidden' name='id' value='<?=$id?>'>
							<input type='hidden' name='delet' value='ok'>
							<input type='image' src='images/sim.png'>
						</td>
					</tr>
				</table>
			</form>
<?
		else:

			$conta = 0;
			while($conta < 3000):
			
				if($tipo2[$conta] == "imagem" || $tipo2[$conta] == "arquivo"):
					$s = "SELECT $campo2[$pos] FROM $tabela WHERE id = $id";
					$q = mysql_query($s);
					$n = @mysql_num_rows($q);
					$a = @mysql_fetch_array($q);
					if($n > 0):
						@unlink("$thumb$a[0]");
						
						$s2 = "UPDATE $tabela SET $campo2[$pos] = '' WHERE id = $id";
						$q2 = mysql_query($s2);
					endif;
				endif;
				$conta++;
			endwhile;

			//Busca o que vai ser deletado
			$s = "SELECT * FROM $tabela WHERE id = $id";
			$q = mysql_query($s);
			$f = mysql_fetch_row($q);

			// registra o q foi deletado
			$log = $_SESSION[log];
			$data = date("Y-m-d");
			$hora = date("H:i:s");
			$info = $f[1];
	
			$s1 = "INSERT INTO del (id,admin,tabela,info,data,hora) VALUES('','$log','$tabela','$info','$data','$hora')";
			$q1 = mysql_query($s1);
						
			//Comando de deletar
			$s = "DELETE FROM $tabela WHERE id = $id";
			$q = mysql_query($s);
			$a = @mysql_fetch_array($q);

			echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=?pg=$pg'>";
		endif;
	/////////////////////////////////////////////////////////////////////////////
	//
	//	Cadastrar registros
	//
	/////////////////////////////////////////////////////////////////////////////

	elseif($acao == "novo"):

?>
			<form action='' method='post' enctype="multipart/form-data">
				<table cellpadding='5' cellspacing='0' class='ts' width='100%'>
<?
		$conta = 0;
		while($conta < 999):
			if($tipo2[$conta] != ""):
				if($conta%2 == 0):
					echo "<tr class='linha1'>";
				else:
					echo "<tr class='linha2'>";
				endif;
?>
						<td class='meio' valign='top'><?=$titulo2[$conta]?></td>
<?
				if($tipo2[$conta] == "titulo"):
?>
						<td class='meio'><input name='<?=$campo2[$conta]?>' <?if($campo[$conta] == "id") echo "disabled='true'";?> class='x' type='text' value=''></td>
<?
				elseif($tipo2[$conta] == "texto"):
?>
						<td class='meio'><textarea  name='<?=$campo2[$conta]?>' class='x'></textarea></td>
<?
				elseif($tipo2[$conta] == "data"):
						$da = explode('-',$a[$conta]);
						list($ano,$mes,$dia) = $da;
?>
						<td class='meio'><input type='text' name='<?=$campo2[$conta]?>' value='' class='x'></td>
<?
				elseif($tipo2[$conta] == "imagem"):
?>
						<td class='meio'>
							<input type='file' name='<?=$campo2[$conta]?>'>
						</td>
<?
				elseif($tipo2[$conta] == "arquivo"):
?>
						<td class='meio'>
							<input type='file' name='<?=$campo2[$conta]?>'>
						</td>
<?
				elseif($tipo2[$conta] == "seleção"):
					$laga = explode("_",$campo2[$conta]);
					$lage = $sel[$conta];
					$lagi = "id, ".$lage;
					$tab = $laga[1];
?>
						<td class='meio'>
							<select name='<?=$campo2[$conta]?>'>
								<option value=''>--- Escolha ---</option>
<?
					$conta2 = 0;
					$s2 = "SELECT $lagi FROM $tab";
					$q2 = mysql_query($s2);
					while($a2 = mysql_fetch_array($q2)):
?>
								<option <? if($a[$conta2] == $a2[id]) echo "selected='selected'";?> value='<?=$a2[id]?>'><?=$a2[$lage]?></option>
<?
						$conta2++;
					endwhile;
?>
							</select>
						</td>
<?
				elseif($tipo2[$conta] == "compativel"):
					$exp = explode("_",$campo[$conta]);
					$exp2 = explode(",",$a[$conta]);
?>
						<td class='meio'>
<?
					$conta2 = 0;
					$s2 = "SELECT * FROM $exp[1]";
					$q2 = mysql_query($s2);
					while($a2 = @mysql_fetch_array($q2)):
						if($a2[0] != ""):
?>
							<input <?
							$conta3 = 0;
							while($conta3 < 9999):
								if($a2[id] == $exp2[$conta3]):
									echo " checked='checked'";
								endif;
								$conta3++;
							endwhile;
							?> name='<?=$campo2[$conta]?><?=($conta2+1)?>' type='checkbox' value='1'><?=$a2[nome]?><br>
<?
						endif;
						$conta2++;
					endwhile;
?>
						</td>
<?
				elseif($tipo2[$conta] == "adm"):
?>
						<td class='meio'>
<?
							$adm = explode(",",$a[$conta]);
							$conta2 = 0;
							while($menu[$conta2][0] != ""):
?>
							<input <? if(in_array($conta2,$adm)==1) echo " checked";?> name='<?=$campo2[$conta].($conta2+1)?>' type='checkbox' value='1'><?=$menu[$conta2][0]?><br>
<?
								$conta2++;
							endwhile;
?>
						</td>
<?
				elseif($tipo2[$conta] == "opção"):
?>
						<td class='meio'>
							<select name='<?=$campo2[$conta]?>'>
								<option value=''>--- Escolha ---</option>
								<option value='1'>Sim</option>
								<option value='2'>Não</option>
							</select>
						</td>
<?
				endif;
?>
					</tr>
<?
			endif;
			$conta++;
		endwhile;
?>
					<tr>
						<td align='left'>
							<a href='?pg=<?=$pg?>'>
								<img onclick='history.go(-1)' src='images/voltar.png'>
							</a>
						</td>
						<td align='right'>
							<input type='hidden' name='acao' value='regis'>
							<input type='image' src='images/enviar.png'>
						</td>
					</tr>
				</table>
			</form>
<?
	/////////////////////////////////////////////////////////////////////////////
	//
	//	Registrar Cadastro
	//
	/////////////////////////////////////////////////////////////////////////////

	elseif($acao == "regis"):
	
		//Gera copia de imagem para dentro de thumb
		$conta = 0;
		while($conta < 3000):
			$x = $campo2[$conta];
			$y = $_FILES[$x];
			if($tipo2[$conta] == "imagem" && $y['name'] != "" || $tipo2[$conta] == "arquivo" && $y['name'] != ""):
				
				$s = "SELECT $x FROM $tabela WHERE id = $id";
				$q = mysql_query($s);
				$n = @mysql_num_rows($q);
				$a = @mysql_fetch_array($q);

				if($n > 0):
					@unlink("$thumb$a[0]");
				endif;
				
				$file = $campo2[$conta];
				
				$f_name = $_FILES[$file]['name'];
				$f_tmp  = $_FILES[$file]['tmp_name'];
				$f_type = $_FILES[$file]['type'];
				
				if($f_type == "application/msword"):
					$ext = "doc";
				elseif($f_type == "application/rtf"):
					$ext = "rtf";
				elseif($f_type == "text/plain"):
					$ext = "txt";
				elseif($f_type == "text/html"):
					$ext = "htm";
				elseif($f_type == "application/vnd.ms-excel"):
					$ext = "xls";
				elseif($f_type == "application/vnd.ms-powerpoint"):
					$ext = "pps";
				elseif($f_type == "image/gif"):
					$ext = "gif";
				elseif($f_type == "image/jpeg"):
					$ext = "jpg";
				else:
					$ext = explode(".",$f_name);
					$ext = array_reverse($ext);
					$ext = $ext[0];
				endif;

				
				$nome = (date(usiHd)+$conta).".".$ext;

				$up = move_uploaded_file($f_tmp, $thumb.$nome);

				$f[$conta] = $nome;
			elseif($tipo2[$conta] == "imagem" && $y['name'] == "" || $tipo2[$conta] == "arquivo" && $y['name'] == ""):
				$s = "SELECT $x FROM $tabela WHERE id = $id";
				$q = mysql_query($s);
				$a = @mysql_fetch_array($q);
				$f[$conta] = $a[0];
			endif;
			$conta++;
		endwhile;
		
		//Gera a linha do codigo para INSERT
		$conta = 0;
		while($conta < 3000):
			if($campo2[$conta] != ""):
				$x = $campo2[$conta];
				$y = $_POST[$x];
				if($conta == 0):	
				elseif($conta == 1):
					if($tipo2[$conta] == "data"):
						$da = explode('/',$y);
						list($ano,$mes,$dia) = $da;
						$z = $dia."-".$mes."-".$ano;
						
						$set.= $x;
						$set2.="'".$z."'";
					elseif($tipo2[$conta] == "imagem" || $tipo2[$conta] == "arquivo"):
						$y = $f[$conta];
						$set.= $x;
						$set2.="'".$y."'";
					elseif($tipo2[$conta] == "compativel"):
						$conta2 = 1;
						while($conta2 < 9999):
							$xy = $_POST[$campo2[$conta].$conta2];
							if($xy == '1'):
								$y.= $conta2.",";
							endif;
							$conta2++;
						endwhile;
						$set.= $x;
						$set2.="'".$y."'";
					elseif($tipo2[$conta] == "adm"):
						$conta2 = 1;
						while($conta2 < 9999):
							$xy = $_POST[$campo2[$conta].$conta2];
							if($xy == '1'):
								$y.= ($conta2-1).",";
							endif;
							$conta2++;
						endwhile;
						$set.= ", ".$x.'="'.$y.'"';
					else:
						$set.= $x;
						$set2.="'".$y."'";
					endif;
				else:
					if($tipo2[$conta] == "data"):
						$da = explode('/',$y);
						list($ano,$mes,$dia) = $da;
						$z = $dia."-".$mes."-".$ano;
						
						$set.= ",".$x;
						$set2.= ",'".$z."'";
					elseif($tipo2[$conta] == "imagem" || $tipo2[$conta] == "arquivo"):
						$y = $f[$conta];
						$set.= ",".$x;
						$set2.= ",'".$y."'";
					elseif($tipo2[$conta] == "compativel"):
						$conta2 = 0;
						while($conta2 < 9999):
							$xy = $_POST[$campo2[$conta].$conta2];
							echo $xy;
							if($xy == '1'):
								$y.= $conta2.",";
							endif;
							$conta2++;
						endwhile;
						$set.= ",".$x;
						$set2.= ",'".$y."'";
					elseif($tipo2[$conta] == "adm"):
						$conta2 = 1;
						while($conta2 < 9999):
							$xy = $_POST[$campo2[$conta].$conta2];
							if($xy == '1'):
								$y.= ($conta2-1).",";
							endif;
							$conta2++;
						endwhile;
						$set.= ",".$x;
						$set2.= ",'".$y."'";
					else:
						$set.= ",".$x;
						$set2.= ",'".$y."'";
					endif;
				endif;
			endif;
			$conta++;
		endwhile;

		$s = "INSERT INTO $tabela ($set) VALUES($set2)";
		$q = mysql_query($s) or die(mysql_error());
		if($q != ""):

?>
				<div align='center'>
					<table cellpadding='5' cellspacing='0' class='ts'>
						<tr>
							<td class='tp'>Registro cadastrado com sucesso.</td>
						</tr>
						<tr>
							<td align='center'><input class='img' type='image' src='images/voltar.png' onclick='history.go(-2)'></td>
						</tr>
					</table>
				</div>
<?
		else:
?>
				<div align='center'>
					<br>
					Cadastro com falha.<br>
					Contate seu Tecnico.<br>
					<input class='img' type='image' src='images/voltar.png' onclick='history.go(-2)'>
				</div>
<?
		endif;	
	endif;
?>
		</td>
	</tr>
</table>