<?php
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	$_SESSION = $_POST;
	var_dump($_SESSION);
	var_dump($_FILES);
	$status = (int)$_SESSION['status'];
	$quantity = (int)$_SESSION['quantity'];
	$title = mysql_escape_string($_SESSION['title']);
	$author = mysql_escape_string($_SESSION['author']);
	$booknum = mysql_escape_string($_SESSION['booknum']);
	$pub_date = mysql_escape_string($_SESSION['pub_date']);
	$image = mysql_escape_string($_FILES['image_file']['name']);
	
	
	//echo "{$status}";
	$add = "insert into book(booknum, author,title,pub_date,status,quantity,image) values(
		'{$booknum}',
		'{$author}',
		'{$title}',
		'{$pub_date}',
		'{$status}',
		'{$quantity}',
		'{$image}'
	)";
	
	move_uploaded_file($_FILES['image_file']['tmp_name'],"books/" . $_FILES['image_file']['name']); 
	
	$inserted = mysql_query($add, $con);
	if($inserted){
		header("Location: add_book.php");
	}else{
		die(mysql_error());
	}
	
	
	require_once "connection/close.php";
?>