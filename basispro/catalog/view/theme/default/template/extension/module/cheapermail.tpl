<?php
	if (isset($_POST['namer'])) {$namer = $_POST['namer'];}
	if (isset($_POST['number'])) {$telefon = $_POST['number'];}
	if (isset($_POST['desired_price'])) {$desired_price = $_POST['desired_price'];}
	if (isset($_POST['search_cheaper'])) {$search_cheaper = $_POST['search_cheaper'];}
	if (isset($_POST['subject'])) {$subject = $_POST['subject'];}
	$sendfrom   = "basispro@".$_SERVER["HTTP_HOST"]; /*Укажите адрес, с которого будет приходить письмо, можно не настоящий, нужно для формирования заголовка письма*/
	
	$headers  = "From: " . strip_tags($sendfrom) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
	$message = "
".$name_klient.$namer."
".$telefon_klient.$telefon."
".$tovar_klient.$name_tovar."
".$href_tovar_klient.$href_tovar."
".$text_price_tovar.$price_tovar."
".$text_desired_price.$desired_price."
".$text_search_cheaper.$search_cheaper;
	
	$message = strip_tags(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
	$send = mail ($to, $subject, $message, $headers);
	echo('success');

?>