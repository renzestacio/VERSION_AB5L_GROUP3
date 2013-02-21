<?php
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	$_SESSION = $_POST;
	var_dump($_SESSION);
	var_dump($_FILES);
	$status = (int)$_SESSION['status'];
	$quantity = (int)$_SESSION['quantity'];
	$title = mysql_real_escape_string($_SESSION['title']);
	$author = mysql_real_escape_string($_SESSION['author']);
	$booknum = mysql_real_escape_string($_SESSION['booknum']);
	$pub_date = mysql_real_escape_string($_SESSION['pub_date']);
	//if no file upload, load default
	if(! is_uploaded_file($_FILES['image']['tmp_name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK){
		$imagename = mysql_real_escape_string("book1.jpg");
		$imagefile = mysql_real_escape_string(file_get_contents("book1.jpg"));	// mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));		
	}else{
		$imagename = mysql_real_escape_string($_FILES['image']['name']);
		$imagefile =  mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));		
	}
	//echo "{$status}";
	for($i=0;$i<$quantity;$i++){
		$add = "insert into book(booknum, author,title,pub_date,status,quantity,imagename,imagefile) values(
			'{$booknum}',
			'{$author}',
			'{$title}',
			'{$pub_date}',
			'{$status}',
			'{$quantity}',
			'{$imagename}',
			'{$imagefile}'
		)";
		$inserted = mysql_query($add, $con);
	}
	
	
	//move_uploaded_file($_FILES['image_file']['tmp_name'],"books/" . $_FILES['image_file']['name']); 
	if($inserted){
		header("Location: add_book.php");
	}else{
		die(mysql_error());
	}
	
	
	require_once "connection/close.php";
?>