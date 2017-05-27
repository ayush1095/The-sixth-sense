<!-- Documentation for Administrators ( Staff / IT-People / Faculties ) -->
<?php
	session_start();
	
	// Connect to database
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("the-sixth-sense") or die(mysql_error());

	if(isset($_POST['login_btn'])) {
		$user_id = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);

		$sql = "select * from admin where AD_EID='$user_id' or AD_PHONE='$user_id'"; /* I am here */
		$result = mysql_query($sql) or die(mysql_error());
		$temp = mysql_num_rows($result);
		if($temp == 0) {
			$_SESSION['message'] = "User Does not exist.";
		} else {
			$res = mysql_fetch_assoc($result);
			$pass = $res["AD_PASS"];
			if($password == $pass) {
				$_SESSION['username'] = $username;
				header("location: Welcome_Faculty.php");
			}
			else {
				$_SESSION['message2'] = "Incorrect Password. Please try again.";
			}
		}
	}

	mysql_close();
?>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	</head>
	<body>
		<div class="header">
			<h1>The Sixth Sense, Dehradun</h1>
		</div>
		<?php
			if(isset($_SESSION['message'])) {
				echo "<div id='error_msg'>".$_SESSION['message']."</div>";
			} else if(isset($_SESSION['message2'])) {
				echo "<div id='error_msg'>".$_SESSION['message2']."</div>";
				unset($_SESSION['message2']);
			}
			
		?>
		<form method="post" action="Faculty_login.php">
			<table>
				<center><span><bold>FACULTY / STAFF Login Form</bold></span></center>
				<br>
				<tr>
					<td>Email/Phone</td>
					<td><input type="text" name="username" class="textInput" placeholder="Email address / Phone number" required></td>
				</tr><tr>
					<td>Password</td>
					<td><input type="password" name="password" class="textInput" placeholder="********" required></td>
				</tr>
			</table>
			<p class="button">
				<input type="submit" name="login_btn" value="Log In">
			</p>
		</form>
		<br>
		<?php
			if(isset($_SESSION['message'])){
				?>
				<div>
					<p class = "click">Please <a href="Faculty_signup.php">click here</a> to create an account.</p>
				</div>
				<?php
				unset($_SESSION['message']);
			}
		?>
	</body>
</html>