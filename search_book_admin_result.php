<?php

	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	$title_filter = $_POST['title'];
	$author_filter = $_POST['author'];
	
	//*******************************
	//		searches all user
	//*******************************
		
		if($title_filter == "" && $author_filter == ""){
			$query = "select * from book order by title";
		}
		else{
			if($title_filter != "" && $author_filter == ""){
				$query = "select * from book where title like '%{$_POST['title']}%'";
			}
			else if($title_filter == "" && $author_filter != ""){
				$query = "select * from book where author like '%{$_POST['author']}%'";
			}
			else if($title_filter != "" && $author_filter != ""){
				$query = "select * from book where title like '%{$_POST['title']}%' and author like ''%{$_POST['author']}%";
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
		
		echo "<section id=\"search_result_tab\">";
		// +---------------+----------------+
		// | Table-ized the result of query	|
		// +---------------+----------------+
		echo "<div id=\"tableResult\">";
		echo "<table cellpadding=\"5\" width=\"100%\">
			<th>Book Number</th>
			<th>Title</th>
<<<<<<< HEAD
			<th>Author</th>";
			// +----------------+----------------+
			// |one row of result = one table row|
			// +----------------+----------------+
			while($row = mysql_fetch_assoc($result)){
				echo "<tr><td align=\"center\">";
				echo $row['booknum'];
				echo "</td><td align=\"center\">";
				echo $row['title'];
				echo "</td><td align=\"center\">";
				echo $row['author'];
				echo "</td><tr>";
=======
			<th>Author</th>
			<th>Quantity</th>
			<th>Available</th>";
			// +----------------+----------------+
			// |one row of result = one table row|
			// +----------------+----------------+
			$current_booknum = "a";
			while($row = mysql_fetch_assoc($result)){
				while($current_booknum != $row['booknum']){
					echo "<tr><td align=\"center\">";
					echo $row['booknum'];
					echo "</td><td align=\"center\">";
					echo "<a href=\"view_book_admin.php?id=" . $row['booknum'] . "\">{$row['title']}</a>";
					echo "</td><td align=\"center\">";
					echo $row['author'];
					echo "</td><td align=\"center\">";
					
					$compute = "select * from book where booknum='$row[booknum]'";
					$tempres = mysql_query($compute, $con);
					$quantity = 0;
					while($temp = mysql_fetch_assoc($tempres)){
						$quantity+=1;
					}
					echo $quantity;

					echo "</td>";
					echo "</td><td align=\"center\">";
					
					$compute = "select * from book where booknum='$row[booknum]' and studnum IS NULL";
					$tempres = mysql_query($compute, $con);
					$avail = 0;
					while($temp = mysql_fetch_assoc($tempres)){
						$avail+=1;
					}
					echo $avail;
					
					echo "</td>";
					echo "<td align=\"center\"><a href = \"edit_book.php?id={$row['title']}\">Edit</a></td>";				
					echo "</td></tr>";
					
					$current_booknum = $row['booknum'];
					break;					
				}
>>>>>>> 2/23/2013 CHANGES
			}
		echo "</table>";
		echo "</div>";
		// +---------------+----------------+
		// |		End of Table :)			|
		// +---------------+----------------+
		echo "</section>";
		echo "<section id = \"nav\">";
			require_once "include/admin_nav.php";
		echo "</section></br></br></br></br></br></br></br>";
<<<<<<< HEAD
		require_once "include/footer.php";
=======
		require_once "include/user_footer.php";
>>>>>>> 2/23/2013 CHANGES
		
?>