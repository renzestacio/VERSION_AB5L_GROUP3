<?php
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: admin_login.php");
	}
	
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

	$query = "select * from requests";	
	$result = mysql_query($query, $con);
	
	echo "<table cellpadding=\"5\" width=\"100%\">";
		echo "<th>Username</th>";
		echo "<th>Student Number</th>";
			while($row = mysql_fetch_assoc($result)){
				echo "<tr>";
				echo "<td align=\"center\">{$row['username']}</td>";
				echo "<td align=\"center\">{$row['studnum']}</td>";
				echo "<td align=\"center\"><a href = \"process_requests.php?studnum={$row['studnum']}\">Accept Request</a></td>";
				echo "</tr>";
			}
			
	echo "</table>";
	
	echo "</div>";
	// +---------------+----------------+
	// |		End of Table :)			|
	// +---------------+----------------+
	echo "</section>";
	
	echo "<nav id = \"nav\">";
		require_once "include/admin_nav.php";
	echo "</nav>";
	require_once "include/admin_footer.php";
	
	require_once "connection/close.php";
?>