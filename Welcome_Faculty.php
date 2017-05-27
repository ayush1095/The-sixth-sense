<html>
	<head>
		<title>Welcome</title>
	</head>
	<body bgcolor="">
		<h3 align="center">Welcome
			<?php
				echo $_SESSION['user'];
			?>
		</h3>
		<hr />
		<br>
		<p>
			<u>Fill this form to Add a Student Data</u>
			<br>
			<form id="formData" method="POST" autocomplete="off" action="Welcome_Faculty.php">
				<fieldset>
					<table id="table" align="center" border="0.5px" bgcolor="">
						<legend align="center"><b>Form</b></legend>
						<tr>
							<td>Student's Name</td>
							<td><input name="name" type="text" required/></td>
						</tr>
						<tr>
							<td>Provide a Unique ID</td>
							<td><input name="sid" type="text" required/></td>
						</tr>
						<tr>
							<td>Choose a Password</td>
							<td><input name="pass1" type="password" required/></td>
						</tr>
						<tr>
							<td>Re-enter Password</td>
							<td><input name="pass2" type="password" required/></td>
						</tr>
						<tr>
							<td>Course Course</td>
							<td><input name="course" type="text"/></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td><input name="phone" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/></td>
						</tr>
						<tr>
							<td>Permanent Address</td>
							<td><input name="address" type="text"/></td>
						</tr>
					</table>
					<center>
						<button id="add" type="submit">Create Account</button>
					</center>
					<span id="result"></span>
				</fieldset>
			</form>
			<br>
		</p>
		<p>To upload a student's attendence <a href="sample.html"><u>click here.</u></a></p>
		<p>To Upload/Update a student's Score <a href="sample.html"><u>click here.</u></a></p>
		
		<script src="jquery-2.1.3.min" type="text/javascript"></script>
		<script src="my_script.js" type="text/javascript"></script>
		
	</body>
</html>