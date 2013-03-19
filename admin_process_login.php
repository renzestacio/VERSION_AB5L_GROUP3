<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	$_SESSION = $_POST;
	//var_dump($_SESSION);
	require_once "connection/connect.php";
	require_once "connection/use_db.php";

	$query = "select * from admin";	
	$result = mysql_query($query, $con);
	
	$uname = $_POST['uname'];
	$pass = md5($_POST['pass']);
	
	/*
		the admin currently logging is being checked whether
		he/she exists in the database.
		If yes, a session for him/her is created,
		else, he/she would not be able to logged in.
	*/
	while($row = mysql_fetch_assoc($result)){
		if($uname===$row['username'] && $pass===$row['password']){
			$_POST['uname'] = htmlentities($uname);
			header("Location: admin_home.php");
			exit(0);
		}
	}
	
	require_once "include/header.php";
		echo "<div id = \"admin_login\">";
			echo "<p id = \"login_form\">";
				echo "Invalid username and password. Try again.<br/><br/>";
				echo "<a href = \"admin_login.php\">Log In</a>";
			echo "</p>";
		echo "</div>";
	require_once "include/footer.php";
	
	require_once "connection/close.php";
?>