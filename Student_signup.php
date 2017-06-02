<!-- Documentation for Students -->
<?php
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("the-sixth-sense") or die(mysql_error());

	session_start();

	error_reporting(0); /* This will disable all warnings reported on this PHP script */
	
	if(isset($_POST['register_btn'])) {
		$name = mysql_real_escape_string($_POST['name']);
		$email = mysql_real_escape_string($_POST['email']);
		$password1 = mysql_real_escape_string($_POST['password1']);
		$password2 = mysql_real_escape_string($_POST['password2']);
		$phone1 = mysql_real_escape_string($_POST['phone1']);
		$phone2 = mysql_real_escape_string($_POST['phone2']);
		$class = mysql_real_escape_string($_POST['class']);
		$school = mysql_real_escape_string($_POST['school']);
		$board = mysql_real_escape_string($_POST['board']);
		$adm_no = mysql_real_escape_string($_POST['adm_no']);
		$date_adm = mysql_real_escape_string($_POST['date_adm']);

		$course1[0]="";$course1[1]="";$course1[2]="";$course1[3]="";$course1[4]="";$course1[5]="";$course1[6]="";

		$course1[0] = mysql_real_escape_string($_POST['1']);
		$course1[1] = mysql_real_escape_string($_POST['2']);
		$course1[2] = mysql_real_escape_string($_POST['3']);
		$course1[3] = mysql_real_escape_string($_POST['4']);
		$course1[4] = mysql_real_escape_string($_POST['5']);
		$course1[5] = mysql_real_escape_string($_POST['6']);
		$course1[6] = mysql_real_escape_string($_POST['7']);

		$course = $course1[0]." ".$course1[1]." ".$course1[2]." ".$course1[3]." ".$course1[4]." ".$course1[5]." ".$course1[6];
		
		$hq = mysql_real_escape_string($_POST['hq']);
		$address = mysql_real_escape_string($_POST['address']);
		$year = "";

		/*Check the validity of the Admission Number */
		$adm = strlen($adm_no);
		if($adm == 8) {

			/* Check if User ID is already taken */
			$sql2 = "select * from student where Adm_no='$adm_no'";
			$temp = mysql_query($sql2);
			$rs = mysql_num_rows($temp);
			if($rs) {
				$_SESSION['message'] = "Sorry, Admission Number is already Registered.";
			} else {

				/* Extract year and month from the Date entered */
				$year = substr("$adm_no",-5,2);
				$no = substr("$adm_no", -3,3);
				
				$sid = ($year).($year+1).$no;

				/* Check if the account already exists */
				$sql2 = "select * from student where Name='$name' and Email='$email' and Phone=$phone1 and School='$school' and Class=$class and Board='$board'";
				$temp = mysql_query($sql2);
				$rs = mysql_num_rows($temp);
				if($rs == 0) {
					/* Check whether the passwords match */
					if($password2 == $password1) {
						$_SESSION['username'] = $name; // create user

						/* Check if email address and/or phone number are/is already registered */
						$sql2 = "select * from student where Email='$email' or Phone=$phone1";
						$temp = mysql_query($sql2);
						$rs = mysql_num_rows($temp);
						if($rs){
							$_SESSION['message'] = "Email and/or Phone is/are already registered.";
						}
						else{
							/* If the details are Valid then account created */
							if($phone2 == null)
							{
								if($class == null) {
									$sql = "insert into student(Name, SID, Phone, Email, Address, School, Board, Qual, Date_adm, Adm_no, Course, Pass) values('$name','$sid',$phone1,'$email','$address','$school','$board','$hq',(STR_TO_DATE('$date_adm','%Y-%m-%d')),'$adm_no','$course','$password1')";
								} else {
									$sql = "insert into student(Name, SID, Phone, Email, Address, Class, School, Board, Qual, Date_adm, Adm_no, Course, Pass) values('$name','$sid',$phone1,'$email','$address',$class,'$school','$board','$hq',(STR_TO_DATE('$date_adm','%Y-%m-%d')),'$adm_no','$course','$password1')"; 
								}
							}
							else {
								if($class != null) {
									$sql = "insert into student(Name, SID, Phone, Phone2, Email, Address, Class, School, Board, Qual, Date_adm, Adm_no, Course, Pass) values('$name','$sid',$phone1,$phone2,'$email','$address',$class,'$school','$board','$hq',(STR_TO_DATE('$date_adm','%Y-%m-%d')),'$adm_no','$course','$password1')";
								} else {
									$sql = "insert into student(Name, SID, Phone, Phone2, Email, Address, School, Board, Qual, Date_adm, Adm_no, Course, Pass) values('$name','$sid',$phone1,$phone2,'$email','$address','$school','$board','$hq',(STR_TO_DATE('$date_adm','%Y-%m-%d')),'$adm_no','$course','$password1')";
								}	
							}
							$res = mysql_query($sql) or die(mysql_error());
							if($res) {
								$_SESSION['message3'] = "Account Created Successfully :)";
							} else {
								/* For invalid details message appears */
								$_SESSION['message'] = "Error Occured: Re-Check your Details OR Contact for Support";
							}
						}
					}
					else {
						$_SESSION['message'] = "Passwords didn't match, Please Retry";
					}
				} else {
					$_SESSION['message2'] = "Seems, you already have an Account :)";
				}
			}
		} else {
			$_SESSION['message'] = "Invalid admission number. Please Retry";
		}
	}
	
	mysql_close();
?>

<html>
	<head>
		<title>theSixthSense Student Sign-up page</title>
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
				} else if(isset($_SESSION['message3'])) {
					echo "<div style=\"width: 40%;margin: 1px auto;height: 20px;padding-bottom: 3px;border: 1px solid #00F900; background: rgba(53, 253, 103, 0.47); font-size:15px; box-shadow: 5px 5px 5px 2px rgba(0, 0, 0, 0.6);  color: #FFF; text-align: center;padding-top: 3px;\"><b>".$_SESSION['message3']."</b></div>";
				}
			?>
			<form method="post" action="Student_signup.php" class="light">
				<table>
					<div class="light" width="100%">
						<center><b>STUDENT Registration Form</b></center>
					</div>
					<br>
					<?php
					if(isset($_SESSION['message2'])) {
						?>
						<div class="light" width="100%">
							<center><b>Please <a href="Student_login.php">click here</a> to Login.</b></center>
						</div>
						<br>
						<?php
						unset($_SESSION['message2']);
					} else if(isset($_SESSION['message3'])) {
						?>
						<div class="light" width="100%">
							<center><b>Your Roll No. is : <?php echo $sid; ?></b></center>
							<center><b>Please <a href="Student_login.php">click here</a> to login</b></center>
						</div>
						<br>
						<?php
						unset($_SESSION['message3']);
					}
				?>
					<tr>
						<td class="tdtext">Name of Candidate*</td>
						<td><input type="text" name="name" class="textInput" placeholder="Enter Full Name" required></td>
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
						<td class="tdtext">Address*</td>
						<td><input type="address" name="address" class="textInput" placeholder="Permanent Address"></td>
					</tr><tr>
						<td class="tdtext">Select your Class</td>
						<td>
							<select name="class" class="textInput">
								<option value="">--select--</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
						</td>
					</tr><tr>
						<td class="tdtext">School/College*</td>
						<td><input type="text" name="school" class="textInput" placeholder="Enter School/College name" required></td>
					</tr><tr>
						<td class="tdtext">Board*</td>
						<td>
							<select name="board" class="textInput" required>
								<option value="">--select--</option>
								<option value="ICSE">ICSE</option>
								<option value="CBSE">CBSE</option>
								<option value="Others">Others</option>
							</select>
						</td>
					</tr><tr>
						<td class="tdtext">Admission Number*</td>
						<td><input type="text" name="adm_no" class="textInput" placeholder="Admission number (ex. tss170**)" required></td>
					</tr><tr>
						<td class="tdtext">Date of Admission*</td>
						<td><input type="date" name="date_adm" class="textInput" placeholder="YYYY-MM-DD" required></td>
					</tr><tr>
						<td class="tdtext">Highest Qualification*</td>
						<td>
							<select name="hq" class="textInput" required>
								<option value="">--select--</option>
								<option value="Pre-high school">Pre-high school</option>
								<option value="High School">High School</option>
								<option value="Intermediate">Intermidiate</option>
								<option value="School graduate">School Graduate</option>
								<option value="Under Graduate">Under Graduate</option>
								<option value="Post Graduate">Post Graduate</option>
							</select>
						</td>
					</tr><tr>
						<td class="tdtext">Create Password*</td>
						<td><input type="password" name="password1" class="textInput" placeholder="Choose a Password" required></td>
					</tr><tr>
						<td class="tdtext">Confirm Password*</td>
						<td><input type="password" name="password2" class="textInput" placeholder="Re-enter Password" required></td>
					</tr>
				</table>
				<table>
					<tr>
						<td class="tdtext">Course Opted*</td>
					</tr>
					<tr>
						<td><p class="tdtext"><input type="checkbox" name="1" value="Coaching ">Coaching</p></td>
						<td><p class="tdtext"><input type="checkbox" name="2" value="Creativity ">Creativity</p></td>
						<td><p class="tdtext"><input type="checkbox" name="3" value="Competition ">Competition</p></td>
					</tr><tr>
						<td><p class="tdtext"><input type="checkbox" name="4" value="Counseling ">Counseling</p></td>
						<td><p class="tdtext"><input type="checkbox" name="5" value="Communication ">Communication</p></td>
						<td><p class="tdtext"><input type="checkbox" name="6" value="Care ">Care</p></td>
						<td><p class="tdtext"><input type="checkbox" name="7" value="Others ">Others</p></td>
					</tr>
				</table>
				<p class="button">
					<input type="submit" name="register_btn" value="Create Account">
				</p>
			</form>
		</section>
	</body>
</html>