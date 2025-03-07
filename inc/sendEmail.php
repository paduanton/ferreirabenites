<?php

// Replace this with your own email address
$siteOwnersEmail = 'contato@ferreirabenites.com.br';


if($_POST) {

   $name = trim(stripslashes($_POST['contactName']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));

   // Check Name
	if (strlen($name) < 2) {
		echo "Insira seu nome";
		exit();
	}
	// Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		echo "Insira um endereço de email válido."; 
		exit();
	}
	
	$formMessageFormatted = " 
	<br>Formulário via site
	<br>--------------------------------------------<br>
	<br><strong>Nome:</strong> $name
	<br><strong>Email:</strong> $email
	<br><strong>Assunto:</strong> $subject
	<br><strong>Mensagem:</strong> $contact_message
	<br><br>--------------------------------------------
	";
	$boundary = "XYZ-" . date("dmYis") . "-ZYX";

	$message = "--$boundary\n"; 
	$message.= "Content-Transfer-Encoding: 8bits\n"; 
	$message.= "Content-Type: text/html; charset=\"utf-8\"\n\n";
	$message.= "$formMessageFormatted\n";

	$headers = "MIME-Version: 1.0\n";
	$headers.= "From: $siteOwnersEmail\n";
	$headers.= "Reply-To: $email\n";
	$headers.= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";  
	$headers.= "$boundary\n"; 

	var_dump($message);
	var_dump($headers);
	var_dump($subject);
	var_dump($siteOwnersEmail);

	$mail = mail($siteOwnersEmail, $subject, $message, $headers);

	if ($mail) {
		echo "Enviado com sucesso!"; 
	} else {
		echo "Algo deu errado. Tente novamente.";
	}

}

?>