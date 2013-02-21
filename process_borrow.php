<?php
	
	//require_once "include/admin_header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";

	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: admin_login.php");
	}
	
	$_GET;
	//var_dump($_GET);
	echo $_SESSION['uname'];
	$student = "select * from student where username = '{$_SESSION['uname']}'";
	$student_result = mysql_query($student,$con);
	
	if(!$student_result){
		die("Error: " . mysql_error());
	}else{
		while ($row = mysql_fetch_assoc($student_result)) {
			$studnum = $row['studnum'];
		}
	}
	
	echo $studnum;
	
	//mysql_select_db($db_name, $con);
	//$update = "UPDATE `book` SET `status`=1, `studnum`= '$studnum' WHERE `booknum`='$_GET[booknum]'";
	//mysql_query($update, $con) or die(mysql_error());
	
	$book = "select * from book where booknum = '$_GET[booknum]'";
	$book_result = mysql_query($book,$con);
	while($bookrow = mysql_fetch_assoc($book_result)){
		if($bookrow['status']==1){
			$update = "UPDATE `book` SET `status`=0, `studnum`= '$studnum' WHERE `BookID`='$bookrow[BookID]'";
			mysql_query($update, $con) or die(mysql_error());
			decQuantity($bookrow['quantity'], $_GET['booknum'], $con);
			break;
		}
	}
	
	function decQuantity($quantity, $booknum, $con){
		$book = "select * from book where booknum = '$booknum'";
		$book_result = mysql_query($book,$con);
		$quantity = $quantity-1;
		while($bookrow = mysql_fetch_assoc($book_result)){
			$updater = "UPDATE `book` SET `quantity` = '$quantity' where `booknum` = '$booknum'";
			
			mysql_query($updater, $con) or die(mysql_error());
		}
	}
	
	header("Location: home.php");
	require_once "connection/close.php";
?>
