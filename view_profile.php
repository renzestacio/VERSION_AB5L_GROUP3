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
			echo "Welcome, <em><a href = \"home.php\" id = \"uname\">{$_SESSION['uname']}</a></em>!|<a href = \"signout.php\" >Sign Out</a>";
	echo "</article>";
	echo "</section><br/>";
	
	echo "<section id=\"avatar\">";
		echo "<table cellpadding=\"10\">";
			echo "<tr><td align=\"center\">";
			echo "<b>Avatar Image </b>";
			echo "</td><td>";
			if(isset($_SESSION['imagefile']))
				echo "<img src=get.php?id=". $_SESSION['uname'] .">";
			else
				echo "No Avatar Image";
			echo "</td></tr>";
		echo "</table>";
	echo "</section>";
	// +---------------+----------------+
	// | Table-ized user's basic info	|
	// +---------------+----------------+
	echo "<section id=\"info\">";
	echo "<table cellpadding=\"10\">";
	while($row = mysql_fetch_assoc($result)){		
		echo "<tr><td align=\"center\">";
		echo "<b>Student Number  </b>";
		echo "</td><td>";
		echo $row['studnum'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Username  </b>";
		echo "</td><td>";
		echo $row['username'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Email Address  </b>";
		echo "</td><td>";
		echo $row['email'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>First Name  </b>";
		echo "</td><td>";
		echo $row['fname'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Last Name  </b>";
		echo "</td><td>";
		echo $row['lname'];
		echo "</td></tr>";

		echo "<tr><td align=\"center\">";
		echo "<b>College  </b>";
		echo "</td><td>";
		echo $row['college'];
		echo "</td></tr>";		

		echo "<tr><td align=\"center\">";
		echo "<b>Degree  </b>";
		echo "</td><td>";
		echo $row['degree'];
		echo "</td></tr>";
		
		echo "</section>";
		
	}
	
	echo "</table>";
	// +---------------+----------------+
	// |		End of Table :)			|
	// +---------------+----------------+

	// +---------------+----------------+
	// | Books borrowed inserted here	|
	// +---------------+----------------+
	//***i suggest this is a different div***	
	echo "</section>";
	
	echo "<section id = \"view_shelf\">";
		echo "<img src=\"Athenaeum_Shelf.jpg\" id=\"view_SHELF\" alt=\"The Athenaeum\"/>";
	echo "</section>";
	
	echo "<section id = \"nav\">";
		require_once "include/nav.php";
	echo "</section>";
	
	require_once "include/user_footer.php";
	require_once "connection/close.php";
?>