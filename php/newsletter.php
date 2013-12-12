<?php
/*
 * @author Marijan Šuflaj <msufflaj32@gmail.com>
 * @link http://www.php4every1.com
 */

include("config.php");

$return['error'] = false;

// E-mail validate function
function isValidEmail($email){
  return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email);
}

while (true) {
  if (empty($_POST['email'])) {
  	$return['error'] = true;
  	$return['msg'] = 'You did not enter your e-mail.';
  	break;
  }
  
  // Validate e-mail address from newsletter form
  if(isValidEmail($_POST['email'])){
    if(isValidEmail($email_address)){
      if (!$return['error']){
        $to = $email_address;
        $subject = 'newsletter subscriber';
        $message = 'You have new newsletter subscriber: '.$_POST['email'];
        $headers = 'From: newsletter' . "\r\n" .
            'Reply-To: no_reply' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
      
        // Send e-mail
        if(mail($to, $subject, $message, $headers)){
          $return['msg'] = 'You have been added to newsletter.';
        }
      }
    }
    else{
      $return['error'] = true;
      $return['msg'] = 'Internal error.';
    }
  }
  else{
    $return['error'] = true;
    $return['msg'] = 'E-mail address is not valid.';
  }
  break;
}

echo json_encode($return);

/* Location: php/newsletter.php */
?>