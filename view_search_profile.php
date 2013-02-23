<?php
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	$id = mysql_escape_string($_REQUEST['id']);
	$query = "select * from student where studnum = '$id'";
	$bookquery = "select * from book where studnum = '$id'";
	$result = mysql_query($query, $con);
	$bookresult = mysql_query($bookquery, $con);

	while($row = mysql_fetch_assoc($result)){
		$uname = $row['username'];
		$fname = $row['fname'];
		$lname = $row['lname'];
		$email = $row['email'];
		$hasImage = $row['imagefile'];
		$degree = $row['degree'];
		$college = $row['college'];
		break;
	}
	
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
			if(isset($hasImage))
				echo "<img src=get.php?id=". $uname .">";
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
		echo "<tr><td align=\"center\">";
		echo "<b>Student Number  </b>";
		echo "</td><td>";
		echo $id;
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Username  </b>";
		echo "</td><td>";
		echo $uname;
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Email Address  </b>";
		echo "</td><td>";
		echo $email;
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>First Name  </b>";
		echo "</td><td>";
		echo $fname;
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Last Name  </b>";
		echo "</td><td>";
		echo $lname;
		echo "</td></tr>";

		echo "<tr><td align=\"center\">";
		echo "<b>College  </b>";
		echo "</td><td>";
		echo $college;
		echo "</td></tr>";		

		echo "<tr><td align=\"center\">";
		echo "<b>Degree  </b>";
		echo "</td><td>";
		echo $degree;
		echo "</td></tr>";
		
		echo "</section>";
		
	echo "<tr><td align=\"center\">";
	echo "<b>Books Borrowed</b>";
	echo "</td><td>";
	
	while($row = mysql_fetch_assoc($bookresult)){
		echo "<tr><td align=\"center\">";
		echo "<b>Title  </b>";
		echo "</td><td>";
		echo $row['title'];
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
	echo "</section>";
	
	echo "<section id = \"view_shelf\">";
		echo "<img src=\"Athenaeum_Shelf.jpg\" id=\"view_SHELF\" alt=\"The Athenaeum\"/>";
	echo "</section>";
	
	echo "<section id = \"nav\">";
		require_once "include/admin_nav.php";
	echo "</section>";
	
	require_once "include/user_footer.php";
	require_once "connection/close.php";
?>