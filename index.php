<?
include("lib.php");

$html = new BODY();

include_once "top.php";
include_once "bottom.php";

$html->add(
	$top.
	$html->div('Seja bem vindo a Hexacore.',array('align'=>"center")).
	$html->div('Seja bem vindo a Hexacore.',array('style'=>"display:none;")).
	$bottom
);
$html->show();

?>