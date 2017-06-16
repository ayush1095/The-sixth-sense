<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
pageEncoding="ISO-8859-1"%>
<%@taglib prefix="s" uri="/struts-tags"%>
<html>
	<head>
		<title>Student Details</title>
	</head>
	<body>
		<center>
		<h1>Here are your details:</h1>
		<table>
			<tr>
				<td>Name</td>
				<td><s:property value="Name" /></td>
			</tr><tr>
				<td>Email</td>
				<td><s:property value="Email" /></td>
			</tr><tr>
				<td>Phone1</td>
				<td><s:property value="Phone1" /></td>
			</tr><tr>
				<td>Phone2</td>
				<td><s:property value="Phone2" /></td>
			</tr><tr>
				<td>Address</td>
				<td><s:property value="Address" /></td>
			</tr><tr>
				<td>School</td>
				<td><s:property value="School" /></td>
			</tr><tr>
				<td>Board</td>
				<td><s:property value="Board" /></td>
			</tr><tr>
				<td>Adm_no</td>
				<td><s:property value="Adm_No" /></td>
			</tr><tr>
				<td>Password</td>
				<td><s:property value="Pass1" /></td>
			</tr>
		</table>
		</center>
	</body>
</html>