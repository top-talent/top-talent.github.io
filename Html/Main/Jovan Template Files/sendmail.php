<?php
// Email Submit
// Note: filter_var() requires PHP >= 5.2.0
if ( isset($_POST['email']) && isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
 
  // detect & prevent header injections
  $test = "/(content-type|bcc:|cc:|to:)/i";
  foreach ( $_POST as $key => $val ) {
    if ( preg_match( $test, $val ) ) {
      exit;
    }
  }

$headers = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    'Reply-To: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    'Return-Path: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-Type: text/html; charset=utf-8' . "\r\n" .
    'X-Priority: 1' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  
  //  Replace with your email
  mail( "creohelpers@gmail.com", $_POST['subject'], $_POST['message'], $headers );
   
}
?>