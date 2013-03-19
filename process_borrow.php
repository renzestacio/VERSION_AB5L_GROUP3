<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	
	require_once "connection/connect.php";
	require_once "connection/use_db.php";

	session_start();
	require_once "include/checkSession.php";
	
	$_GET;
	//var_dump($_GET);
	
	/*
		the following query is used to retrieve the selected
		user's student number from the database using
		the book's book id
	*/
	$book = "select * from reservation where bknum = '$_GET[BookID]'";
	$book_result = mysql_query($book,$con);
	while($bookrow = mysql_fetch_assoc($book_result)){
		$book_id = $bookrow['bknum'];
		$studnum = $bookrow['stdnum'];
	}
	
	/*
		gets the current date, which serves as the borrow date, and the
		current date plus 2 weeks, which serves as the due date of
		the book borrowed
	*/
	$bor_date = date('Y-m-d');
	$due_date = date('Y-m-d',strtotime('+2 week'));
	
	echo "book id: ".$book_id." studnum: ".$studnum;
	
	/*
		When the transaction is made, the information of the book
		reserved is transferred in the table borrow
	*/
	$add = "insert into borrow (borrow_date,due_date,stdnum,bknum)values(
		'{$bor_date}',
		'{$due_date}',
		'{$studnum}',
		'{$book_id}'
	)";
	mysql_query($add, $con) or die(mysql_error());
	
	/*
		after transferring, the entry in the table reservation is removed
	*/
	$delete = "delete from reservation where bknum = '$book_id'";
	mysql_query($delete,$con);
	
	header("Location: view_search_profile.php?id=$studnum");
	require_once "connection/close.php";
?>
