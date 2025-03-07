<?php

// Replace this with your own email address
$siteOwnersEmail = 'contato@ferreirabenites.com.br';


if($_POST) {

   $name = trim(stripslashes($_POST['contactName']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));

   $message = "";
   $error = [];

   // Check Name
	if (strlen($name) < 2) {
		$error['name'] = "Insira seu nome.";
	}
	// Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Insira um endereço de email válido.";
	}
	
   // Subject
	if ($subject == '') { $subject = "Contact Form Submission"; }


   // Set Message
   $message .= "De: " . $name . "<br />";
	$message .= "Email: " . $email . "<br />";
   $message .= "Mensagem: <br />";
   $message .= $contact_message;
   $message .= "<br /> ----- <br /> Este email foi enviado a partir do formulário de contato do site. <br />";

   // Set From: header
   $from =  $name . " <" . $email . ">";

   // Email Headers
    $headers = 'From: contato@ferreirabenites.com.br' . "\r\n" .
        'Reply-To: contato@ferreirabenites.com.br' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();


   if (!$error) {

      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Algo deu errado. Tente novamente."; }
		
	} # end if - no validation error

	else {

		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
		
		echo $response;

	} # end if - there was a validation error

}

?>