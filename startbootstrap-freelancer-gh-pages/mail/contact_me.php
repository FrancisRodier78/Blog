<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['first-name']) || empty($_POST['email']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$firstName = strip_tags(htmlspecialchars($_POST['first-name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = "francisrodier78@yahoo.fr"; // Add your email address inbetween the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
$subject = "Le Blog vous contacte de la part de $name";
$body = "Vous avez reçus un message de votre Blog.\n\n"."Voila le détails:\n\nName: $name\n\nEmail: $email\n\nfirst-name: $firstName\n\nMessage:\n$message";
$header = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$header .= "Reply-To: $email";	

if(!mail($to, $subject, $body, $header))
  http_response_code(500);
?>
