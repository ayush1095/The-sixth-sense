<!-- Documentation for Administrators ( Staff / Admins / IT-People ) -->
<?php
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("the-sixth-sense") or die(mysql_error());

	session_start();

	error_reporting(0); /* This will disable all warnings reported on this PHP script */
	
	if(isset($_POST['register_btn'])) {
		$name = mysql_real_escape_string($_POST['name']);
		$uid = mysql_real_escape_string($_POST['userid']);
		$email = mysql_real_escape_string($_POST['email']);
		$password1 = mysql_real_escape_string($_POST['password1']);
		$password2 = mysql_real_escape_string($_POST['password2']);
		$phone1 = mysql_real_escape_string($_POST['phone1']);
		$phone2 = mysql_real_escape_string($_POST['phone2']);
		$address = mysql_real_escape_string($_POST['address']);
		$department = mysql_real_escape_string($_POST['department']);
		$designation = mysql_real_escape_string($_POST['designation']);

		/* Check if User ID is already taken */
		$sql2 = "select * from staff where UID='$uid'";
		$temp = mysql_query($sql2);
		$rs = mysql_num_rows($temp);
		if($rs) {
			$_SESSION['message'] = "User ID already taken, please contact for Support";
		} else {
			/* Check if the account already exists */
			$sql2 = "select * from staff where Name='$name' and Email='$email' and Phone=$phone1 and Department='$department'";
			$temp = mysql_query($sql2);
			$rs = mysql_num_rows($temp);
			if($rs == 0) {
				/* Check whether the passwords match */
				if($password2 == $password1) {
					$_SESSION['username'] = $name; // create user

					/* Check if email address and/or phone number are/is already registered */
					$sql2 = "select * from staff where Email='$email' or Phone=$phone1";
					$temp = mysql_query($sql2);
					$rs = mysql_num_rows($temp);
					if($rs){
						$_SESSION['message'] = "Email and/or Phone is/are already registered.";
					}
					else{
						/* If the details are Valid then account created */
						if($phone2 == null)
						{ 
							$sql = "insert into staff(Name, UID, Email, Phone, Department, Designation, Address, Pass) values('$name','$uid','$email',$phone1,'$department','$designation','$address','$password1')"; 
						}
						else {
							$sql = "insert into staff(Name, UID, Email, Phone, Phone2, Department, Designation, Address, Pass) values('$name','$uid','$email',$phone1,$phone2,'$department','$designation','$address','$password1')";
						}
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
	}
	
	mysql_close();
?>

<html>
	<head>
		<title>theSixthSense Staff/Admin Sign-up page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="bootstrap.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	</head>
	<body>
		<section class="dark top">
		<div class="header">
		    <img src="images/logo.png" width="10%" align="left" class="img-responsive">
			<h1 align="center">The Sixth Sense, Dehradun</h1>
		</div>
		</section>
		<section class="container">
			<?php
				if(isset($_SESSION['message'])) {
					echo "<div id='error_msg'>".$_SESSION['message']."</div>";
					unset($_SESSION['message']);
				} else if(isset($_SESSION['message2'])) {
					echo "<div style=\"width: 40%;margin: 1px auto;height: 20px;padding-bottom: 3px;border: 1px solid #00F900; background: rgba(53, 253, 103, 0.47); font-size:15px; box-shadow: 5px 5px 5px 2px rgba(0, 0, 0, 0.6);  color: #FFF; text-align: center;padding-top: 3px;\"><b>".$_SESSION['message2']."</b></div>";
				}
			?>
			<form method="post" action="Staff_signup.php" class="light">
				<table>
					<div class="light" width="100%">
						<center><b>STAFF / ADMIN Registration Form</b></center>
					</div>
					<br>
					<tr>
						<td class="tdtext">Name*</td>
						<td><input type="text" name="name" class="textInput" placeholder="Enter Full Name" required></td>
					</tr><tr>
						<td class="tdtext">User ID*</td>
						<td><input type="id" name="userid" class="textInput" placeholder="ID (ex. 001***)" required></td>
					</tr><tr>
						<td class="tdtext">Email*</td>
						<td><input type="email" name="email" class="textInput" placeholder="example@email.com" required></td>
					</tr><tr>
						<td class="tdtext">Phone*</td>
						<td><input type="phone" name="phone1" class="textInput" placeholder="10 digit phone number" required></td>
					</tr><tr>
						<td class="tdtext">Alt. Phone</td>
						<td><input type="phone" name="phone2" class="textInput" placeholder="Alternate phone number"></td>
					</tr><tr>
						<td class="tdtext">Department*</td>
						<td>
							<select name="department" class="textInput" required>
								<option value=""></option>
								<option value="Administration">Administration</option>
								<option value="Academics">Academics</option>
								<option value="Human Resource">Human Resource</option>
								<option value="Marketting">Marketting</option>
								<option value="Payroll/Accounting">Payroll/Accounting</option>
								<option value="IT Assistance">IT Support</option>
							</select>
						</td>
					</tr><tr>
						<td class="tdtext">Designation*</td>
						<td><input type="phone" name="designation" class="textInput" placeholder="CEO / CTO / Manager ?" required></td>
					</tr><tr>
						<td class="tdtext">Address*</td>
						<td><input type="address" name="address" class="textInput" placeholder="Current Address" required></td>
					</tr><tr>
						<td class="tdtext">Create Password*</td>
						<td><input type="password" name="password1" class="textInput" placeholder="Choose a Password" required></td>
					</tr><tr>
						<td class="tdtext">Confirm Password*</td>
						<td><input type="password" name="password2" class="textInput" placeholder="Re-enter Password" required></td>
					</tr>
				</table>
				<p class="button">
					<input type="submit" name="register_btn" value="Create Account">
				</p>
				<?php
					if(isset($_SESSION['message2'])) {
						?>
						<br>
						<div class="light" width="100%">
							<center><b>Please <a href="Staff_login.php">click here</a> to Login.</b></center>
						</div>
						<?php
						unset($_SESSION['message2']);
					}
				?>
			</form>
		</section>
	</body>
</html>