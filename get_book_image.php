<?php
	include 'connection/connect.php';
	mysql_select_db($db_name, $con);	
	$id = mysql_escape_string($_REQUEST['id']);
	$image = mysql_query("SELECT * FROM `book` WHERE `BookID`='$id'");
	$image = mysql_fetch_assoc($image);
	$image = $image['imagefile'];
	header("Content-type: image/jpeg");
	echo $image;
?>