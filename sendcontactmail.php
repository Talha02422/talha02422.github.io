<?php 
session_start();

/* ==========================  Define variables ========================== */
#Your e-mail address

define("__TO__", "talhaashfaqmirza16@gmail.com");
#Message subject
define("__SUBJECT__", "Premier Relocation Services Form");
#Success message
define('__SUCCESS_MESSAGE__', "Your message has been sent. Thank you!");
#Error message 
define('__ERROR_MESSAGE__', "Error, your message hasn't been sent");
#Messege when one or more fields are empty
define('__MESSAGE_EMPTY_FILDS__', "Please fill out all fields");

$post=$_POST;

$name = $post['name'];
$email = $post['email'];
$phone = $post['phone_number'];
$subject = $post['msg_subject'];
$message =  $post['message'];


$captcha=$_POST['g-recaptcha-response'];
$secretkey = "6Lfv0wEVAAAAAP2mrPZflXlfJ6Dg-jO7ugRk8bVF";
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkey."&response=".$captcha);
$responseKeys = json_decode($response,true); 

if(isset($name) and isset($email)){
   if($name == '') {
		echo "Please enter your name.";
		echo json_encode(array('success' => false, 'msg' => "Please enter your name."));
		exit();
	} else if($email == '' or !filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo json_encode(array('success' => false, 'msg' => "Please enter valid e-mail."));
		exit();
	}else if(intval($responseKeys["success"]) !== 1){
	    echo json_encode(array('success' => false, 'msg' => "Wrong captcha try again please!"));
		exit();
	}else {
	    $text = "Sender's Name: $name <br>
		 Sender's Email: $email <br> 
		 Sender's Phone: $phone <br> 
		 Sender's Subject: $subject <br> 
		 Sender's Message:<br>
		 $message";
		 
		$headers = 'From: ' . $email . "\r\n" . 'Reply-To: ' . $email . "\r\n";
		$headers .= "Content-type:text/html\r\n";
		$headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
		if(@mail(__TO__,__SUBJECT__,$text,$headers)){
			session_destroy();
			echo json_encode(array('success' => true, 'msg' => __SUCCESS_MESSAGE__));
		}else {
		    echo json_encode(array('success' => false, 'msg' => __ERROR_MESSAGE__));
		}
	}
}else{
    echo json_encode(array('success' => false, 'msg' => __MESSAGE_EMPTY_FILDS__));
}
?>
