<html>
	<body>
		<?php
		$date = date("y");
		$month = date("m");
		$uid = "tss".$date.($date+1)."001";
		echo $uid;
		?>
		<form method="POST" action="date.php">
			<input type="text" name="name"/>
			<input type="date" name="date"/>
			<br>
			<button type="submit" name="submit">Submit</button>
		</form>
		<?php
		if(isset($_POST['submit']))
		{
			$name = mysql_real_escape_string($_POST['name']);
			$date = mysql_real_escape_string($_POST['date']);
			echo $date;
			$d = substr("$date",-2,2);
			$m = substr("$date",-5,2);
			$Y = substr("$date",-10,4);
			echo "<br>";
			$date2 = $d."-".$m."-".$Y;
			echo $date2;
/*
			mysql_connect("localhost","root","");
			mysql_select_db("the-sixth-sense");

			$sql = "insert into date(Name, Date) values('$name',STR_TO_DATE('$date','%Y-%m-%d'))";
			$query = mysql_query($sql) or die(mysql_error());
			
			$y = substr("$date",-8,2);

			echo "<br>".$y;
*/
			mysql_close();
		}
		?>
	</body>
</html>