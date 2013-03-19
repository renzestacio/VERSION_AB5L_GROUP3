<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	require_once "include/checkSession.php";
	
	$_SESSION = $_POST;
	//var_dump($_SESSION);
	//var_dump($_FILES);
	$status = 1;
	$quantity = (int)$_SESSION['quantity'];
	$title = mysql_escape_string($_SESSION['title']);
	$author = mysql_escape_string($_SESSION['author']);
	$booknum = mysql_escape_string($_SESSION['booknum']);
	$pub_date = mysql_escape_string($_SESSION['pub_date']);
	/*
		if no image of the book has been uploaded,
		the default image for the book is loaded instead
	*/
	if(! is_uploaded_file($_FILES['image']['tmp_name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK){
		$imagename = mysql_escape_string("book1.jpg");
		$imagefile = mysql_escape_string(file_get_contents("book1.jpg"));	// mysql_escape_string(file_get_contents($_FILES['image']['tmp_name']));		
	}else{
		$imagename = mysql_escape_string($_FILES['image']['name']);
		$imagefile =  mysql_escape_string(file_get_contents($_FILES['image']['tmp_name']));		
	}
	//echo "{$status}";
	/*
		Information entered in the form are inserted as a new entry in the table book
	*/
	for($i=0;$i<$quantity;$i++){
		$add = "insert into book(booknum, author,title,pub_date,status,imagename,imagefile) values(
			'{$booknum}',
			'{$author}',
			'{$title}',
			'{$pub_date}',
			'{$status}',
			'{$imagename}',
			'{$imagefile}'
		)";
		$inserted = mysql_query($add, $con);
	}
	
	/*
		indicates a signal to add_book.php whether or not the book has been added
	*/
	if($inserted){
		header("Location: add_book.php?success=1");
	}else{
		header("Location: add_book.php?success=0");
		die(mysql_error());
	}
	
	
	require_once "connection/close.php";
?>