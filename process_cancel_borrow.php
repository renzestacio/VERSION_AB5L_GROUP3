<?php
  //hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	session_start();
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	//get the passed book id
	$book_id = $_GET['id'];
	
	//get the student number of current canceller
	$student = "select * from student where username = '{$_SESSION['uname']}'";
	$student_result = mysql_query($student,$con);
	
	if(!$student_result){
		die("Error: " . mysql_error());
	}else{
		while ($row = mysql_fetch_assoc($student_result)) {
			$studnum = $row['studnum'];
		}
	}
	
	//remove entry from table reservation
	$delete = "delete from reservation where bknum = '$book_id'";
	mysql_query($delete,$con);
	
	//update the table book
	$update = "UPDATE `book` SET `status`=1, `studnum`= NULL WHERE `BookID`='$book_id'";
	mysql_query($update,$con);
	
	echo $studnum; echo $book_id;
	
	header("Location: view_profile.php");	
	
?>
