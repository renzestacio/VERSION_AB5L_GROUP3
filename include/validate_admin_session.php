<?php
	if(isset($_SESSION['uname'])){
		require_once "connection/connect.php";
		require_once "connection/use_db.php";
		$uname = mysql_real_escape_string($_SESSION['uname']);	/*cleans the string for query*/
		
		$query = "select username from admin where username like '{$uname}' ";	
		$result = mysql_query($query, $con);
		
		$res = mysql_num_rows($result);
		if($res=== 0){
			header("Location: index.php");
		}
	}else{
		header("Location: admin_login.php");
	}
?>