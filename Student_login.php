<!-- Documentation for Student -->
<?php
	session_start();

	error_reporting(0);
	
	// Connect to database
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("the-sixth-sense") or die(mysql_error());

	if(isset($_POST['login_btn'])) {
		$sid = mysql_real_escape_string($_POST['sid']);
		$password = mysql_real_escape_string($_POST['pass']);

		$sql = "select * from student where SID='$sid'";
		$result = mysql_query($sql);
		$temp = mysql_num_rows($result);
		if($temp == 0) {
			$_SESSION['message'] = "Student is NOT Registered";
		} else {
			$res = mysql_fetch_assoc($result);
			$pass = $res["Pass"];
			if($password == $pass) {
				$_SESSION['sid'] = $sid;
				header("location: Welcome_student.php");
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
		<title>theSixthSense Student Login Page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
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
			} else if(isset($_SESSION['message2'])) {
				echo "<div id='error_msg'>".$_SESSION['message2']."</div>";
				unset($_SESSION['message2']);
			}
			?>
			<form method="post" action="Student_login.php">
				<table>
					<div class="light" width="100%">
						<center><b>STUDENT Login</b></center>
					</div>
					<br>
					<tr>
						<td class="tdtext">Roll No.</td>
						<td><input type="text" name="sid" class="textInput" placeholder="ID (ex. 17180**)" required></td>
					</tr><tr>
						<td class="tdtext">Password</td>
						<td><input type="password" name="pass" class="textInput" placeholder="********" required></td>
					</tr>
				</table>
				<p class="button">
					<input type="submit" name="login_btn" value="Log In">
				</p>
				<br>
				<?php
					if(isset($_SESSION['message'])){
						?>
						<div class="light" width="100%">
							<center><b>Please <a href="Student_signup.php">click here</a> to create an account.</b></center>
						</div>
						<?php
						unset($_SESSION['message']);
					}
				?>
			</form>
		</section>
	</body>
</html>