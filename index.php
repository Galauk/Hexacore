<?

include("lib.php");

$html = new HTML();

include_once "top.php";
include_once "bottom.php";

$html->add(
	$top.
	$html->div('Seja bem vindo a Hexacore.',array('align'=>"center")).
	$bottom
);
$html->show();

?>
