<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

	session_start();
	require_once "include/checkSession.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	//get the passed book id
	$book_id = $_GET['BookID'];
	
	/*
		the following query is used to retrieve the selected
		user's student number from the database using
		the book's book id
	*/
	$query = "select * from borrow where bknum = $book_id";
	$result = mysql_query($query,$con);
	while($row = mysql_fetch_assoc($result)){
		$studnum = $row['stdnum'];
	}
	
	/*
		When returned, the book currently stored in the table
		book is removed, indicating that the book has already
		been returned
	*/
	$delete = "delete from borrow where bknum = '$book_id'";
	mysql_query($delete,$con);
	
	/*
		The status of the selected book is set to 1,
		indicating that it is now available
	*/
	$update = "UPDATE `book` SET `status`=1, `studnum`= NULL WHERE `BookID`='$book_id'";
	mysql_query($update,$con);

	
	echo $studnum; echo $book_id;
	
	header("Location: view_search_profile.php?id=$studnum");
	
?>