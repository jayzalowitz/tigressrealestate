<?php

use SendGrid\Mail\Mail;
        $email;$comment;$captcha;$subject;
        if(isset($_POST['your-email'])){
          $email=$_POST['your-email'];
        }
        if(isset($_POST['your-message'])){
          $comment=$_POST['your-message'];
        }
        if(isset($_POST['your-subject'])){
          $subject=$_POST['your-subject'];
        }
        if(isset($_POST['your-email'])){
          $subject=$_POST['your-email'];
        }
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }

        if(!$captcha){
          echo '
			Please check the the captcha form.
			';
          exit;
        }
        $secretKey = "6LeHLjMeAAAAAGcZDsYbarbR-9Hgw9nqdPO71dYj";
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, false);
        // should return JSON with success as true
        if($responseKeys->success) {
        	$to = "courtsdavis@gmail.com";
			$headers = "From: " .$email. "\r\n" .
			"CC: jayzalowitz@gmail.com";
       		echo '{}';

       		

			$email = new Mail();
			$email->setFrom("jayzalowitz@gmail.com");
			$email->setSubject($subject);
			$email->addTo("courtsdavis@gmail.com", "jayzalowitz@gmail.com");
			$email->addContent("text/plain", $comment);
			$email->addContent(
			    "text/html", $comment
			);
			$sendgrid = new \SendGrid("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
");
			try {
			    $response = $sendgrid->send($email);
			    print $response->statusCode() . "\n";
			    print_r($response->headers());
			    print $response->body() . "\n";
			} catch (Exception $e) {
			    echo 'Caught exception: '.  $e->getMessage(). "\n";
			}
        } 
?>