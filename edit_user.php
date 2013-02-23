<?php
	//include 'connection/connect.php';
	//just to make sure that the user is online when accessing this page
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "connection/connect.php";
	require_once "connection/use_db.php";	
	
	if(isset($_POST['punish'])){
		$query = "UPDATE `student` SET `canborrow`=0 WHERE `studnum` = '$_GET[id]'";	
		$result = mysql_query($query, $con);
		header("Location: admin_home.php");
	}
	else if(isset($_POST['unpunish'])){
		$query = "UPDATE `student` SET `canborrow`=1 WHERE `studnum` = '$_GET[id]'";	
		$result = mysql_query($query, $con);
		header("Location: admin_home.php");
	}
?>