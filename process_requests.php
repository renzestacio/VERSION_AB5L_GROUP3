
<?php
	
	/*
		When the admin has accessed this page, the assumption is
		that he/she has approved the request of the user who recently
		registered for the system
	*/
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	require_once "include/checkSession.php";
	
	$_GET;
	//var_dump($_GET);
	$all = "select * from requests where studnum like '{$_GET['studnum']}' ";
	$all_res = mysql_query($all, $con);

	$imagename = mysql_escape_string("defpic.jpg");
	$imagefile = mysql_escape_string(file_get_contents("defpic.jpg"));
	
	if(!$all_res){
		die("Error: " . mysql_error());
	}else{
		/*
			The selected student's information is retrieved from the
			table request and is transferred to the table student
		*/
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
				'{$imagename}',
				'{$imagefile}',
				1,
				0
			)";
			$inserted = mysql_query($add, $con);
		}
		/*
			After transferring to table student, the entry in the table request is deleted
		*/
		$del_query = "delete from requests where studnum like '{$_GET['studnum']}' ";
		$delete = mysql_query($del_query,$con);

		/*
			indicates a signal to add_user_requests.php whether or not the user has been added
		*/
		if($delete){
			header("Location: add_user_requests.php?success=1");
		}else{
			header("Location: add_user_requests.php?success=0");
			//die(mysql_error());
		}

	}
	require_once "connection/close.php";
?>
