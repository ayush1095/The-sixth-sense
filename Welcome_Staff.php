<?php
	session_start();
	$uid = $_SESSION['uid'];  /* Store the userid that was validated during the Login Session */

	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("the-sixth-sense") or die(mysql_error());
	

	echo "Welcome, $uid";
	session_destroy();
?>