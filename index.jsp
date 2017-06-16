<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
pageEncoding="ISO-8859-1"%>
<%@taglib prefix="s" uri="/struts-tags"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>The Sixth Sense | Welcome Screen</title>
</head>
<body>
	<h1>The Sixth Sense</h1>
	<br>
	<span>Please select the Right option</span>
	<!--
   <s:form action="welcome">
      <s:select name="username" label="Username"
         list="{'Mike','John','Smith'}" />

      <s:select label="Company Office" name="mySelection"
         value="%{'America'}"
         list="%{#{'America':'America'}}">
      <s:optgroup label="Asia" 
         list="%{#{'India':'India','China':'China'}}" />
      <s:optgroup label="Europe"
         list="%{#{'UK':'UK','Sweden':'Sweden','Italy':'Italy'}}" />
      </s:select>

      <s:combobox label="My Sign" name="mySign"
         list="#{'aries':'aries','capricorn':'capricorn'}"
         headerKey="-1" 
         headerValue="--- Please Select ---" emptyOption="true"
         value="capricorn" />
      <s:doubleselect label="Occupation" name="occupation"
         list="{'Technical','Other'}" doubleName="occupations2"
         doubleList="top == 'Technical' ? 
         {'I.T', 'Hardware'} : {'Accounting', 'H.R'}" />
   </s:form>
   -->
	<s:form action="signup">
		<s:select label="Sign Up for?" headerKey="-1" headerValue="<----select---->"
		list="#{'Student':'Student', 'Faculty':'Faculty', 'Admin':'Admin'}"
		name="Person"
		value="5" />
		<s:textfield type="submit" value="Sign Up"/>
	</s:form>
</body>
</html>