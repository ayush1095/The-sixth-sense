<!-- Documentation for Faculties (Welcome Page) -->
<html>
	<head>
		<title>theSixthSense Faculty Welcome page</title>
		<link rel="stylesheet" type="text/css" href="style2.css">
	</head>
	<body>
		<?php
			
			error_reporting(0);
			
			session_start();
			$uid = $_SESSION['uid'];  /* Store the userid that was validated during the Login Session */
			
			mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("the-sixth-sense") or die(mysql_error());

			$sql = "select * from faculty where UID='$uid'";
			$res = mysql_query($sql);
			$temp = mysql_fetch_assoc($res);

			$name = $temp['AD_NAME'];
			$phone = $temp['AD_PHONE'];
			$phone2 = $temp['Phone2'];
			$email = $temp['AD_EID'];
			$course = $temp['AD_DEPT'];
			$add = $temp['AD_ADD'];
		?>
		<div>
			<img src="images/logo.png" width="10%" align="left">
			<div class="right_align">
				<form method="post">
					<p><?php echo "Welcome, <b>".$name."</b>"; ?>
						<button  method="post" name="logout_btn">Logout</button>
					</p>
				</form>
			</div>
		</div>
		<hr />
		<div>
			<h3>Personal Details</h3>
			<table>
				<tr>
					<td>Name</td><td><pre>:    </pre></td>
					<td><?php echo $name; ?></td>
				</tr><tr>
					<td>User ID</td><td><pre>:    </pre></td>
					<td><?php echo $uid; ?></td>
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
				</tr><tr>
					<td>Course</td><td><pre>:    </pre></td>
					<td><?php echo $course; ?></td>
				</tr>
			</table>
		</div>
		<hr />
		<div>
			<h3>Vedanta</h3>
			<p>
				<b>Here you can:</b>
				<ul>Upload an assignment for students.<br>Upload an e-book for students.<br>Upload solutions to important questions.<br>and more...</ul>
			</p>
			<center><table>
				<tr>
					<td>Select Class</td>
					<td>Select Board</td>
					<td>Select Subject</td>
				</tr>
				<tr>
					<td>
						<center><select name="class">
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
						</select></center>
					</td><td>
						<center>
							<select name="board">
								<option value="">--select--</option>
								<option value="ICSE">ICSE</option>
								<option value="CBSE">CBSE</option>
								<option value="Others">Others</option>
							</select>
						</center>
					</td><td>
						<center>
							<select name="subject">
								<option value="">--select--</option>
								<option value="Mathematics">Mathematics</option>
								<option value="Physics">Physics</option>
								<option value="Chemistry">Chemistry</option>
								<option value="Biology">Biology</option>
								<option value="History and Civics">History and Civics</option>
								<option value="Geography">Geography</option
								<option value="Computer Applications">Computer Applications</option>
								<option value="English Language">English Language</option>
								<option value="English Literature">English Literature</option>
								<option value="Arts">Arts</option>
							</select>
						</center>
						</td><td>
							<form action="add_file.php" method="post" enctype="multipart/form-data">
            					<input type="file" name="uploaded_file">
        					</form>
						</td>
					</tr>
				</table>
			</center>
			<br>
			<center>
				<input type="submit" name="upload_btn" value="Upload">
			</center>
			<br>
			<p>
            	<a href="list_files.php">View all files.</a>
        	</p>
			<div>
				<p><b>Note:</b>
					<div>
						File being uploaded <strong>may contain viruses</strong>. It is <strong>highly recommended</strong> that you <strong>compress your data</strong> before you upload them on the database.
					</div>
				</p>
			</div>
		</div>
		<hr />
		<div>
			<p><b>Doubts from students appear here.</b></p>
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