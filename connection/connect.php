<?php
	$con = mysql_connect("localhost", "root", "");
	$db_name = "library";
	if(!$con){
		die("Error: " . mysql_error());
	}
?>