<?php

$html->title("..:: Hexacore ::..");
$html->loadCss("css/bootstrap.min.css");
$html->loadCss("css/css.css");
$html->loadJava("https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js");
$html->loadJava("js/bootstrap.min.js");

$menu = array(
	'index.php'=>'Principal',
	'equipe.php'=>'Equipe',
	'projeto.php'=>'Projetos',
	'contato.php'=>'Contato',
);


$top =
	$html->openDiv(array('align'=>"center","class"=>"all")).
	$html->openDiv(array("class"=>"content")).
	$html->quebra().
	$html->div($html->img("./img/logo.png"),array("class"=>"top")).
	$html->quebra().
	$html->div($html->listaMenu($menu)).
	$html->openDiv(array('class'=>'main'));

?>
