<html>
	<head>
		<title>theSixthSense Student Welcome page</title>
		<link rel="stylesheet" type="text/css" href="style2.css">
	</head>
	<body>
		<?php
			error_reporting(0);
			session_start();
			$sid = $_SESSION['sid'];  /* Store the userid that was validated during the Login Session */
			mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("the-sixth-sense") or die(mysql_error());

			$sql = "select * from student where SID='$sid'";
			$res = mysql_query($sql);
			$temp = mysql_fetch_assoc($res);
			$name = $temp['Name'];
			$sid = $temp['SID'];
			$phone = $temp['Phone'];
			$phone2 = $temp['Phone2'];
			$email = $temp['Email'];
			$add = $temp['Address'];
			$class = $temp['Class'];
			$school = $temp['School'];
			$board = $temp['Board'];
			$qual = $temp['Qual'];
			$date_adm = $temp['Date_adm'];
			$d = substr("$date_adm",-2,2);
			$m = substr("$date_adm",-5,2);
			$Y = substr("$date_adm",-10,4);
			$date = $d."-".$m."-".$Y;
			$adm_no = $temp['Adm_no'];
			$course = $temp['Course'];
			$tot_amt = 50000;  // This is Random
			$amount = 23000;  // This is Random
			$amt_due = $tot_amt - $amount;  // This is Random
			?>
			<div class="right_align">
				<form method="post">
				<p><?php echo "Welcome, <b>".$name."</b>"; ?>
				<button  method="post" name="logout_btn">Logout</button>
				</p>
				</form>
			</div>
			<hr />
			<div>
				<h3>Student Details</h3>
				<table>
					<tr>
						<td>Name</td><td><pre>:    </pre></td>
						<td><?php echo $name; ?></td>
					</tr><vr /><tr>
						<td>Roll No.</td><td><pre>:    </pre></td>
						<td><?php echo $sid; ?></td>
					</tr><tr>
						<td>Phone</td><td><pre>:    </pre></td>
						<td><?php
								echo $phone;
								if($phone2 != null) echo ", ".$phone2;
							?>
						</td>
					</tr><tr>
						<td>Email</td><td><pre>:    </pre></td>
						<td><?php echo $email; ?></td>
					</tr><tr>
						<td>Address</td><td><pre>:    </pre></td>
						<td><?php echo $add; ?></td>
					</tr>
						<?php
							if($class != null) {
								?>
								<tr>
									<td>Class</td><td><pre>:    </pre></td>
									<td><?php echo $class; ?></td>
								</tr>
								<?php
							}
						?>
					<tr>
						<td>School/College</td><td><pre>:    </pre></td>
						<td><?php echo $school; ?></td>
					</tr><tr>
						<td>Board</td><td><pre>:    </pre></td>
						<td><?php echo $board; ?></td>
					</tr><tr>
						<td>Highest Qualification</td><td><pre>:    </pre></td>
						<td><?php echo $qual; ?></td>
					</tr><tr>
						<td>Date of Admission</td><td><pre>:    </pre></td>
						<td><?php echo $date; ?></td>
					</tr><tr>
						<td>Admission Number</td><td><pre>:    </pre></td>
						<td><?php echo $adm_no; ?></td>
					</tr><tr>
						<td>Course Selected</td><td><pre>:    </pre></td>
						<td><?php echo $course; ?></td>
					</tr>
				</table>
			</div>
			<hr />
			<div>
				<h3>Financial Status</h3>
				<table border="1">
					<tr>
						<td><b>Total Amount</b></td>
						<td><b>Amount Paid</b></td>
						<td><b>Amount Due</b></td>
					</tr>
					<tr>
						<td><strong><?php echo $tot_amt; ?></strong></td>
						<td><strong><?php echo $amount; ?></strong></td>
						<td><strong><?php echo $amt_due; ?></strong></td>
					</tr>
				</table>
			</div>
			<hr />
			<div>
				<p><b>You don't have any New Assignments </b></p>
			</div>
			<hr />
			<div>
				<p><b>Have a Doubt? Send a Query to your Teacher</b></p>
			</div>
			<?php
			if(isset($_POST['logout_btn'])) {
				unset($_SESSION['sid']);
				mysql_close();  // Closing all connections
				session_destroy();  // Destroy current user session
				header("location: Student_login.php");
			}
		?>
	</body>
</html>