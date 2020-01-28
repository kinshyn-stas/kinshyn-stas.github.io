<?php
	if (isset($_POST['namer'])) {$namer = $_POST['namer'];}
	if (isset($_POST['number'])) {$telefon = $_POST['number'];}
	if (isset($_POST['message'])) {$comment = $_POST['message'];}
	if (isset($_POST['subject'])) {$subject = $_POST['subject'];}
	$to = "site@sitename.com"; /*Укажите адрес, га который должно приходить письмо*/
	$sendfrom   = "support@sitename.ru"; /*Укажите адрес, с которого будет приходить письмо, можно не настоящий, нужно для формирования заголовка письма*/
	
	$headers  = "From: " . strip_tags($sendfrom) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($sendfrom) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
	$message = "
Имя пославшего: ".$namer."
Телефон: ".$telefon."
Текст сообщения: ".$comment;
	$message = strip_tags(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
	$send = mail ($to, $subject, $message, $headers);
	echo('success');

?>