<?php

include_once 'lib.php';

$html = new BODY();

include_once 'top.php';
include_once 'bottom.php';


if($_POST['nome']){
	/*
		registrar no banco de dados
		enviar e-mail para outros e-mails
	*/
	mail('angelo@hexacore.com.br', 'E-mail pelo site', 'O e-mail utilizado foi: '.$_POST['email'].' e a mensagem foi:'.$_POST['msg']);
	$envio = 'Seu e-mail foi enviado com sucesso.';
}else{
	$envio = '';
}

$form =
	$html->div(
	$html->div($html->label('Nome:').$html->input('text',array('name'=>'nome','class'=>"text"))).
	$html->div($html->label('E-mail:').$html->input('text',array('name'=>'email','class'=>"text"))).
	$html->div($html->label('Telefone:').$html->input('text',array('name'=>'telefone','class'=>"text"))).
	$html->div($html->label('Mensagem:').$html->textarea('',array('name'=>'msg','class'=>"text"))).
	$html->div($html->label('').$html->input('submit',array('class'=>"submit")))
	,array('class'=>"form"))
	;

$html->add(
	$top.
	$html->div($envio).
	$html->form($form,'contato.php').
	$bottom
);

$html->show();

?>
