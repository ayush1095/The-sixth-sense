<%@ page contentType="text/html; charset=UTF-8" %>
<%@ taglib prefix="s" uri="/struts-tags"%>
<!DOCTYPE html>
<html>
	<head>
		<title>The Sixth Sense | Student Signup Page</title>
		<link href="./css/bootstrap.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
		
		<style type="text/css">
			.errors {
				background-color:#FFCCCC;
				border:1px solid #CC0000;
				width:400px;
				margin-bottom:8px;
			}
			.errors li{
				list-style: none;
			}
			.welcome {
				background-color:#DDFFDD;
				border:1px solid #009900;
				width:200px;
			}
			.welcome li{
				list-style: none;
			}
		</style>
	</head>
	<body background="images/blur.jpg">
		<section class="dark top">
		<div class="header">
		    <img src="images/logo.png" width="10%" align="left" class="img-responsive">
			<h1 align="center">The Sixth Sense, Dehradun</h1>
		</div>
		</section>
		<s:if test="hasActionErrors()">
			<br>
			<div class="errors">
				<s:actionerror/>
			</div>
			<br>
		</s:if>
		<s:if test="hasActionMessages()">
			<br>
			<div class="welcome">
				<s:actionmessage/>
			</div>
			<br>
		</s:if>
		<section class="container">
			<s:form action="Student_signup" method="post" class="light">
				<table>
					<div class="light" width="100%">
						<center><b>STUDENT Registration Form</b></center>
					<div>
					<tr><br>
						<s:textfield type="text" name="Name" class="textInput" placeholder="Enter Full Name" label="Name of candidate" required="true" />
					</tr><tr>
						<s:textfield type="email" name="Email" class="textInput" placeholder="example@email.com" label="Email address" required="true" />
					</tr><tr>
						<s:textfield type="phone" name="Phone1" class="textInput" placeholder="10 digit phone number" label="Father's Phone No." required="true" />
					</tr><tr>
						<s:textfield type="phone" name="Phone2" class="textInput" placeholder="10 digit phone number" label="Mother's Phone No." required="true" />
					</tr><tr>
						<s:textfield type="address" name="Address" class="textInput" placeholder="Permanent Address" label="Address" required="true" />
					</tr><tr>
						<s:textfield type="text" name="School" class="textInput" placeholder="Enter School/College name" label="School/College" required="true" />
					</tr><tr>
						<s:select label="Board" headerKey="-1" headerValue="<----select---->"
							list="#{'ICSE':'ICSE', 'CBSE':'CBSE', 'Others':'Others'}"
							name="Board" required="true" />
					</tr><tr>
						<s:textfield type="text" name="Adm_No" class="textInput" placeholder="Admission No. (ex. TSS17***)" label="Admission Number" required="true" />
					</tr><tr>
						<s:textfield type="password" name="Pass1" class="textInput" placeholder="Choose a password" label="Create Password" required="true" />
					</tr><tr>
						<s:textfield type="password" name="Pass2" class="textInput" placeholder="Re-enter Password" label="Confirm Password" required="true" />
					</tr>
				</table>
				<center><s:textfield type="submit" value="Create Account" class="button" /></center>
			</s:form>
		</section>
	</body>
</html>