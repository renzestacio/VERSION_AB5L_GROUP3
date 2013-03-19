<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	
	//require_once "include/admin_header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";

	session_start();
	require_once "include/checkSession.php";
	
	$_GET;
	//var_dump($_GET);
	echo $_SESSION['uname'];
	
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
		one instance of the book from the database is updated and is set to
		unavailable
	*/
	$book = "select * from book where booknum = '$_GET[booknum]'";
	$book_result = mysql_query($book,$con);
	while($bookrow = mysql_fetch_assoc($book_result)){
		$book_id = $bookrow['BookID'];
		if($bookrow['status']==1){
			$update = "UPDATE `book` SET `status`=0, `studnum`= '$studnum' WHERE `BookID`='$bookrow[BookID]'";
			mysql_query($update, $con) or die(mysql_error());
			break;
		}
	}
	
	/*
		gets the current date, which serves as the reservation date, and the
		current date plus 3 days, which serves as the expiration date of
		the reservation
	*/
	$res_date = date('Y-m-d');
	$exp_date = date('Y-m-d',strtotime('+3 day'));
	
	echo "book id: ".$book_id." studnum: ".$studnum;
	
	/*
		When the transaction is made, a new reservation is entered in the table reservation
	*/
	$add = "insert into reservation (reservation_date,expiration_date,stdnum,bknum)values(
		'{$res_date}',
		'{$exp_date}',
		'{$studnum}',
		'{$book_id}'
	)";
	mysql_query($add, $con) or die(mysql_error());
	
	header("Location: view_profile.php");
	require_once "connection/close.php";
?>
