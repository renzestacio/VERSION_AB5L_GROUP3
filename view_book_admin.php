<?php
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	$query = "select * from book where booknum = '$_GET[id]'";
	$query2 = "select * from book where booknum = '$_GET[id]'";	
	$result = mysql_query($query, $con);
	$result2 = mysql_query($query2, $con);

	// +---------------+----------------+
	// | 			UI Part...			|
	// +---------------+----------------+
	require_once "include/header.php";
	
	echo "<section id = \"greetings\">";
	echo "<article>";
			echo "Welcome, <em><a href = \"admin_home.php\" id = \"uname\">{$_SESSION['uname']}</a></em>!|<a href = \"signout.php\" >Sign Out</a>";
	echo "</article>";
	echo "</section><br/>";
	
	echo "<section id=\"avatar\">";
		echo "<table cellpadding=\"10\">";
			echo "<tr><td align=\"center\">";
			echo "<b>Avatar Image </b>";
			echo "</td><td>";
			while($row2 = mysql_fetch_assoc($result2)){
				echo "<img src=get_book_image.php?id=". $row2['BookID'] .">";
				break;
			}
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
		echo "<b>Book Number  </b>";
		echo "</td><td>";
		echo $row['booknum'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Title  </b>";
		echo "</td><td>";
		echo $row['title'];
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Author  </b>";
		echo "</td><td>";
		echo $row['author'];
		echo "</td></tr>";

		echo "<tr><td align=\"center\">";
		echo "<b>Quantity  </b>";
		echo "</td><td>";
		$compute = "select * from book where booknum='$row[booknum]'";
		$tempres = mysql_query($compute, $con);
		$quantity = 0;
		while($temp = mysql_fetch_assoc($tempres)){
			$quantity+=1;
		}
		echo $quantity;
		echo "</td></tr>";
		
		echo "<tr><td align=\"center\">";
		echo "<b>Available  </b>";
		echo "</td><td>";
		$compute = "select * from book where booknum='$row[booknum]' and studnum IS NULL";
		$tempres = mysql_query($compute, $con);
		$avail = 0;
		while($temp = mysql_fetch_assoc($tempres)){
			$avail+=1;
		}
		echo $avail;
		echo "</td></tr>";

		echo "<tr><td align=\"center\">";
		echo "<b>Borrowers  </b>";
		echo "</td><td>";
		$compute = "select * from book where booknum='$row[booknum]' and studnum IS NOT NULL";
		$tempres = mysql_query($compute, $con);
		while($temp = mysql_fetch_assoc($tempres)){
			echo "<tr><td align=\"center\">";
			echo "<a href = \"view_search_profile.php?id={$temp['studnum']}\">{$temp['studnum']}</a>";
			echo "</td></tr>";
		}
			echo "</td></tr>";	
		
		echo "<td align=\"center\"><a href = \"edit_book.php?id={$row['title']}\">Edit</a></td>";
		echo "</td></tr>";		
		
		echo "</section>";
		break;
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