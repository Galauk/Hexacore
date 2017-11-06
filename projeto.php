<?php

include_once 'lib.php';

$html = new HTML();

include_once 'top.php';
include_once 'bottom.php';

$html->add(
	$top.
	$html->div('Check Motors').
	$html->div('My Gym').
	$html->div('School Late').
	$bottom
);

$html->show();

?>