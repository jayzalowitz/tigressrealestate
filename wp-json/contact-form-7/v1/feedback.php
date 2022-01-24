<?php
        $email;$comment;$captcha;
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }
        if(isset($_POST['comment'])){
          $comment=$_POST['comment'];
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
       		echo 'Test';
        } 
?>