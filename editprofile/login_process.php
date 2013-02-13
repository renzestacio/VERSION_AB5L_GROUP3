<?php
	session_start();
	$_SESSION = $_POST;
	//var_dump($_SESSION);
	require_once "connection/connect.php";
	require_once "connection/use_db.php";

	$query = "select * from student";	
	$result = mysql_query($query, $con);
	
	$uname = $_POST['uname'];
	$pass = md5($_POST['pass']);
	
	while($row = mysql_fetch_assoc($result)){
		if($uname===$row['username'] && $pass===$row['password']){
			$_POST['uname'] = htmlentities($uname);
			$_SESSION['fname'] = $row['fname'];
			$_SESSION['lname'] = $row['lname'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['college'] = $row['college'];
			$_SESSION['degree'] = $row['degree'];
			$_SESSION['imagename'] = $row['imagename'];
			$_SESSION['imagefile'] = $row['imagefile'];
			header("Location: home.php");
			exit;
		}
	}
	
	require_once "include/header.php";
		echo "<section id = \"login\">";
			echo "<article id = \"login_form\">";
				echo "Invalid username and password. Try again.<br/><br/>";
				echo "<a href = \"login.php\">Log In</a>";
			echo "</article>";
		echo "</section>";
	require_once "include/footer.php";
	
	require_once "connection/close.php";
?>