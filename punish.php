<?php
	//include 'connection/connect.php';
	//just to make sure that the user is online when accessing this page
	require_once "connection/connect.php";
	require_once "connection/use_db.php";	
	
	
	//$id = urlencode($get);
	//$id2 = htmlspecialchars($get);
	/*
		changes the student's status to 0 which prohibits him/her
		from borrowing any book
	*/
	if(isset($_POST['punish'])){
		$query = "UPDATE `student` SET `canborrow`=0 WHERE `studnum` = '$_GET[id]'";	
		$result = mysql_query($query, $con);
		header("Location: search_user_result.php?success=1");
	}
	/*
		changes the student's status to 1 which allows him/her
		to borrow any book
	*/
	else if(isset($_POST['unpunish'])){
		$query = "UPDATE `student` SET `canborrow`=1 WHERE `studnum` = '$_GET[id]'";	
		$result = mysql_query($query, $con);
		header("Location: search_user_result.php?success=2");
	}
?>