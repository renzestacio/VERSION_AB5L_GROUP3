<?php
	
	//require_once "include/admin_header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";

	$_GET;
	//var_dump($_GET);
	$all = "select * from requests where studnum like '{$_GET['studnum']}' ";
	$all_res = mysql_query($all, $con);
			
	if(!$all_res){
		die("Error: " . mysql_error());
	}else{
		while ($row = mysql_fetch_assoc($all_res)) {
			$add = "insert into student values(
				'{$row['studnum']}',
				'{$row['username']}',
				'{$row['password']}',
				'{$row['fname']}',
				'{$row['lname']}',
				'{$row['email']}',
				NULL,
				NULL,
				NULL,
				NULL				
			)";
			$inserted = mysql_query($add, $con) or die(mysql_error());
		}
		$del_query = "delete from requests where studnum like '{$_GET['studnum']}' ";
		$delete = mysql_query($del_query,$con);
	}
	header("Location: admin_home.php");
	require_once "connection/close.php";
?>
