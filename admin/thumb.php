<?php
//<img src='thumb.php?end=uploads/...&largura=...&altura=...'>

$largura = $HTTP_GET_VARS['largura'];
$altura = $HTTP_GET_VARS['altura'];

$jpeg = $HTTP_GET_VARS['end'];


if($d=getimagesize($jpeg)){ // pega o tamanho da imagem original
	if (!$largura or $largura==0) $largura = ($altura*$d[0])/$d[1];
	if (!$altura or $altura==0) $altura = ($largura*$d[1])/$d[0];
	$p_final = $largura/$altura;
	$p_orig = $d[0]/$d[1];

	if ($p_orig >= $p_final) { //verifica se a largura eh maior q a altura
		$nova_largura = ($d[0]-(($largura*$d[1])/$altura))/2;
		$x_i = $nova_largura;
		$x_f = $d[0]-$nova_largura*2;
		
		$y_i = 0;
		$y_f = $d[1];
	} else { // a altura eh maior
		$x_i = 0;
		$x_f = $d[0];
		
		$nova_altura = ($d[1]-(($altura*$d[0])/$largura))/2;
		$y_i = $nova_altura;
		$y_f = $d[1]-$nova_altura*2;
	}
	
	header('Content-type: image/jpeg'); // ediчуo de jpg

	$src = imagecreatefromjpeg($jpeg); //gera uma copia
	$dst = ImageCreateTrueColor($largura, $altura); // gera uma imagem preta
	$white = imagecolorallocate($dst,255,255,255);  //gera a cor branca da preta
	imagefill($dst,0,0,$white); //tranforma a preta em branca

	imagecopyresampled($dst,$src,0,0,$x_i,$y_i,$largura,$altura,$x_f,$y_f); // colocar a imagem por cima da imagem branca
	imagejpeg($dst, null, 98); // faz uma copia em jpg
	
	//libera memoria
	
	imagedestroy($dst);
	imagedestroy($src);
}
?>