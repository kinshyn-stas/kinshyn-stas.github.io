<?php
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontact=" Email: $email <br>\r\n Message: $message";
$formcall=" Phone: $phone ";
$recipient = "agafonov.yurii@easy-agency.com";
$subject = "Contacts Form EASY.AGENCY";
$contheader = "From: Easy-Agency < no-reply@easy-agency.com > \n";
$contheader .= "Content-Type: text/html; charset=UTF-8 \n";
if (isset($_POST['email'])) {
  mail($recipient, $subject, $formcontact, $contheader) or die("Error!");
  sleep(2);
  header("Location: /thankyou", true, 303);
  exit;
} else if (isset($_POST['phone'])) {
  mail($recipient, $subject, $formcall, $contheader) or die("Error!");
  sleep(2);
  header("Location: /thankyou", true, 303);
  exit;
}
?>
