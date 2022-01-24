<?php
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

			mail($to,$subject,$comment,$headers);
       		echo '{}';
        } 
?>