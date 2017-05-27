<!-- Documentation for Administrators ( Staff / IT-People / Faculties ) -->
<?php
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("the-sixth-sense") or die(mysql_error());

	session_start();

	error_reporting(0); /* This will disable all warnings reported on this PHP script */
	
	if(isset($_POST['register_btn'])) {
		$username = mysql_real_escape_string($_POST['username']);
		$email = mysql_real_escape_string($_POST['email']);
		$password1 = mysql_real_escape_string($_POST['password1']);
		$password2 = mysql_real_escape_string($_POST['password2']);
		$phone = mysql_real_escape_string($_POST['phone']);
		$address = mysql_real_escape_string($_POST['address']);
		$department = mysql_real_escape_string($_POST['department']);
		
		/* Check if the account already exists */
		$sql2 = "select * from admin where AD_NAME='$username' and AD_EID='$email' and AD_PHONE=$phone and AD_ADD='$address' and AD_DEPT='$department'";
		$temp = mysql_query($sql2);
		$rs = mysql_num_rows($temp);
		if($rs == 0) {
			/* Check whether the passwords match */
			if($password2 == $password1) {
				$_SESSION['username'] = $username; // create user

				/* Check if email address and/or phone number are/is already registered */
				$sql2 = "select * from admin where AD_EID='$email' or AD_PHONE=$phone";
				$temp = mysql_query($sql2);
				$rs = mysql_num_rows($temp);
				if($rs){
					$_SESSION['message'] = "Email and/or Phone is/are already registered.";
				}
				else{
					/* If the details are Valid then account created */
					$sql = "insert into admin(AD_NAME, AD_EID, AD_PHONE, AD_DEPT, AD_ADD, AD_PASS) values('$username','$email',$phone,'$department','$address','$password1')";
					$res = mysql_query($sql);
					if($res) {
						$_SESSION['message2'] = "Account Created Successfully :)";
					} else {
						/* For invalid details message appears */
						$_SESSION['message'] = "Error Occured: Re-Check your Details OR Contact for Support";
					}
				}
			}
			else {
				$_SESSION['message'] = "Passwords didn't match :/ Please Retry";
			}
		} else {
			$_SESSION['message2'] = "Seems, you already have an Account :)";
		}
	}
	mysql_close();
?>

<html>
	<head>
		<title>SixthSense Faculty / Staff Sign-up page</title>
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
				unset($_SESSION['message']);
			} else if(isset($_SESSION['message2'])) {
				echo "<div id='msg' style=\"width: 40%;margin: 5px auto;height: 20px;padding-bottom: 5px;border: 1px solid #00F900;background: rgba(53, 253, 103, 0.47);box-shadow: 5px 5px 5px 2px rgba(0, 0, 0, 0.6);color: #FFF;text-align: center;padding-top: 5px;\"><b>".$_SESSION['message2']."</b></div>";
			}
		?>
		<form method="post" action="Faculty_signup.php">
			<table>
				<center><span><bold>FACULTY Sign Up Form</bold></span></center>
				<br>
				<tr>
					<td>Name</td>
					<td><input type="text" name="username" class="textInput" placeholder="Enter Full Name" required></td>
				</tr><tr>
					<td>ID</td>
					<td><input type="id" name="id" class="textInput" placeholder="ID (ex. 001***)" required></td>
				</tr><tr>
					<td>Email Address</td>
					<td><input type="email" name="email" class="textInput" placeholder="example@email.com" required></td>
				</tr><tr>
					<td>Create Password
					<td><input type="password" name="password1" class="textInput" placeholder="Your Password" required></td>
				</tr><tr>
					<td>Confirm Password</td>
					<td><input type="password" name="password2" class="textInput" placeholder="Re-enter Password" required></td>
				</tr><tr>
					<td>Select Course</td>
					<td>
						<select name="department" class="textInput" required>
							<option value=""></option>
							<option value="coaching">Coaching</option>
							<option value="competition">Competition</option>
							<option value="communication">Communication</option>
							<option value="counseling">Counseling</option>
							<option value="creativity">Creativity</option>
							<option value="care">Care</option>
						</select>
					</td>
				</tr><tr>
					<td>Contact Number</td>
					<td><input type="phone" name="phone" class="textInput" placeholder="10 digit phone number" required></td>
				</tr><tr>
					<td>Address</td>
					<td><input type="address" name="address" class="textInput" placeholder="Address" required></td>
				</tr>
			</table>
			<p class="button">
				<input type="submit" name="register_btn" value="Create Account">
			</p>
		</form>
		<?php
			if(isset($_SESSION['message2'])) {
				?>
				<br>
				<div>
					<p class = "click">Please <a href="Faculty_login.php">click here</a> to Login.</p>
				</div>
				<?php
				unset($_SESSION['message2']);
			}
		?>
	</body>
</html>