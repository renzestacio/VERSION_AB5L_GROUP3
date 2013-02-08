<?php
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	$query = "select * from student where username = '{$_SESSION['uname']}'";	
	$result = mysql_query($query, $con);

	// +---------------+----------------+
	// | 			UI Part...			|
	// +---------------+----------------+
	require_once "include/header.php";
	
	echo "<section id = \"greetings\">";
	echo "<article>";
			echo "Welcome, <em><a href = \"home.php\" id = \"uname\">{$_SESSION['uname']}</a></em>!|<a href = \"signout.php\">Sign Out</a>";
	echo "</article>";
	echo "</section><br/>";
	
	echo "<section id=\"mylib\">";
	
	// +---------------+----------------+
	// | Table-ized user's basic info	|
	// +---------------+----------------+
	echo "<table cellpadding=\"10\">";
	while($row = mysql_fetch_assoc($result)){
		echo "<tr><td align=\"center\">";
		echo "<b>Student Number : </b>";
		echo "</td><td>";
		echo $row['studnum'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Username : </b>";
		echo "</td><td>";
		echo $row['username'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Email Address : </b>";
		echo "</td><td>";
		echo $row['email'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>First Name : </b>";
		echo "</td><td>";
		echo $row['fname'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Last Name : </b>";
		echo "</td><td>";
		echo $row['lname'];
		echo "</td></tr>";
	}

	echo "</table>";
	// +---------------+----------------+
	// |		End of Table :)			|
	// +---------------+----------------+

	// +---------------+----------------+
	// | Books borrowed inserted here	|
	// +---------------+----------------+
	//***i suggest this is a different div***
	echo "<div id=\"booklist\">";
		echo "books here :)";
	echo "</div>";
	
	echo "</section>";
	echo "<section id = \"nav\">";
		require_once "include/nav.php";
	echo "</section>";
	
	require_once "include/footer.php";
	require_once "connection/close.php";
?>