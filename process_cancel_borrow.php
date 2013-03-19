<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	require_once "include/checkSession.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	/*
		Gets the book id of the current book whose reservation will be cancelled
	*/
	$book_id = $_GET['id'];
	
	/*
		the following query is used to retrieve the currently
		logged user's student number from the database using
		the user's username
	*/
	$student = "select * from student where username = '{$_SESSION['uname']}'";
	$student_result = mysql_query($student,$con);
	
	if(!$student_result){
		die("Error: " . mysql_error());
	}else{
		while ($row = mysql_fetch_assoc($student_result)) {
			$studnum = $row['studnum'];
		}
	}
	
	/*
		The following query removes the current book involved from the table reservation
	*/
	$delete = "delete from reservation where bknum = '$book_id'";
	mysql_query($delete,$con);
	
	/*
		The status of the book from the table book is updated to 1 (it indicates that the
		book is now available)
	*/
	$update = "UPDATE `book` SET `status`=1, `studnum`= NULL WHERE `BookID`='$book_id'";
	mysql_query($update,$con);
	
	echo $studnum; echo $book_id;
	
	header("Location: view_profile.php");
	require_once "connection/close.php";
	
?>