<?php

include_once 'lib.php';

$html = new HTML();

include_once 'top.php';
include_once 'bottom.php';

$html->add(
	$top.
	$html->div(
		$html->div(
			$html->img('img/equip1.jpg',array('width'=>'100px'))
		,array('class'=>'equipPic')).
		$html->div(
			$html->label("Angelo Nogueira de Brito",array('class'=>'equipName')).
			$html->label("Funções: Desenvolvedor, Programador, Professor",array('class'=>'equipText')).
			$html->label("Facebook: facebook.com.br/angeloBrito",array('class'=>'equipText')).
			$html->label("Twitter: Twitter.com/nebster",array('class'=>'equipText')).
			$html->label("E-mail: ". $html->link("angelo@hexacore.com.br","mailto:angelo@hexacore.com.br"),array('class'=>'equipText'))
		,array('class'=>'equipText'))
	,array('class'=>'equip')).
	$bottom
);

$html->show();

?>
