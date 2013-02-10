<?php

	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: admin_login.php");
	}
	require_once "include/admin_header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	$studnum_filter = $_POST['studnum'];
	$fname_filter = $_POST['fname'];
	$lname_filter = $_POST['lname'];
	
	//*******************************
	//		searches all user
	//*******************************
		
		if($studnum_filter == "" && $fname_filter == "" && $lname_filter == ""){
			$query = "select * from student order by lname";
		}
		else{
			//*******************
			//by student number only
			//*******************
			if($studnum_filter != "" && $fname_filter == "" && $lname_filter == ""){
				$query = "select * from student where studnum like '%{$_POST['studnum']}%'";
			}
			//*******************
			//by first name only
			//*******************
			else if($studnum_filter == "" && $fname_filter != "" && $lname_filter == ""){
				$query = "select * from student where fname like '%{$_POST['fname']}%'";
			}
			//*******************
			//by last name only
			//*******************
			else if($studnum_filter == "" && $fname_filter == "" && $lname_filter != ""){
				$query = "select * from student where lname like '%{$_POST['lname']}%'";
			}
			//*******************
			//by student number and first name
			//*******************
			else if($studnum_filter != "" && $fname_filter != "" && $lname_filter == ""){
				$query = "select * from student where studnum like '%{$_POST['studnum']}%' and fname like '%{$_POST['fname']}%'";
			}
			//*******************
			//by student number and last name
			//*******************
			else if($studnum_filter != "" && $fname_filter == "" && $lname_filter != ""){
				$query = "select * from student where studnum like '%{$_POST['studnum']}%' and lname like '%{$_POST['lname']}%'";
			}
			//*******************
			//by first name and last name
			//*******************
			else if($studnum_filter == "" && $fname_filter != "" && $lname_filter != ""){
				$query = "select * from student where fname like '%{$_POST['fname']}%' and lname like '%{$_POST['lname']}%'";
			}
			//*******************
			//by student number, first name and last name
			//*******************
			else if($studnum_filter != "" && $fname_filter != "" && $lname_filter != ""){
				$query = "select * from student where studnum like '%{$_POST['studnum']}%' and fname like '%{$_POST['fname']}%' and lname like '%{$_POST['lname']}%'";
			}
		}
		
		$result = mysql_query($query,$con);

		// +---------------+----------------+
		// | 			UI Part...			|
		// +---------------+----------------+
		require_once "include/admin_header.php";
		
		echo "<section id = \"greetings\">";
		echo "<article>";
				echo "Welcome, <em><a href = \"admin_home.php\" id = \"uname\">{$_SESSION['uname']}</a></em> ! 	| 	<a href = \"signout.php\">Sign Out</a>";
		echo "</article>";
		echo "</section><br/>";
		
		echo "<section id=\"mylib\">";
		// +---------------+----------------+
		// | Table-ized the result of query	|
		// +---------------+----------------+
		echo "<div id=\"tableResult\">";
		echo "<table cellpadding=\"5\" width=\"100%\">
			<th>Student Number</th>
			<th>Username</th>
			<th>Email</th>
			<th>First Name</th>
			<th>Last Name</th>";
			// +----------------+----------------+
			// |one row of result = one table row|
			// +----------------+----------------+
			while($row = mysql_fetch_assoc($result)){
				echo "<tr><td align=\"center\">";
				echo $row['studnum'];
				echo "</td><td align=\"center\">";
				echo $row['username'];
				echo "</td><td align=\"center\">";
				echo $row['email'];
				echo "</td><td align=\"center\">";
				echo $row['fname'];
				echo "</td><td align=\"center\">";
				echo $row['lname'];
				echo "</td><tr>";
			}
		echo "</table>";
		echo "</div>";
		// +---------------+----------------+
		// |		End of Table :)			|
		// +---------------+----------------+
		echo "</section>";
		echo "<section id = \"nav\">";
			require_once "include/admin_nav.php";
		echo "</section>";
		require_once "include/admin_footer.php";
		
?>