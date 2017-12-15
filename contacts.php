<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
		echo 'Email address not valid';
	} else {	
		ini_set("SMTP","ssl://smtp.gmail.com");
		ini_set("smtp_port","465");
		
		$body = "\nName : ".$name."\n\nMessage :\n".$message."\n\n\nThis message was sent from the website URL : www.thesixthsense.in";
		if(mail('nidhi@thesixthsense.in', 'Customer Query', $body , 'From: '.$email)) {
			echo 'Thanks for contacting us. We will get back to you soon...';
		} else {
			echo 'Oops, your message was not sent';
		}
	}
?>