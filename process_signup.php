<?php
	session_start();
	$_SESSION = $_POST;
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	$query = "select * from requests";	
	$result = mysql_query($query, $con);
	
	$studnum = $_SESSION['studnum'];
	$uname = $_SESSION['uname'];
	$pass = md5($_SESSION['pass2']);
	
	/*
		The purpose of the flag is to prevent having
		duplicate usernames in table Student and table
		Admin
	*/
	$flag = 1;
	
	/*
		The following query is used to check if there
		exist such username in the table Student, flag
		will be 0 if there is, else flag remains as 1
	*/
	$checkStudent = "select * from student";
	$studentResult = mysql_query($checkStudent,$con);
	while($row = mysql_fetch_assoc($studentResult)){
		if($row['username'] == $uname){
			$flag = 0;
			require_once "include/header.php";
			echo "<div id = \"login\">";
				echo "<p id = \"login_form\">";
					echo "Sign Up not successful! Username already exists.<br/><br/>";
					echo "<a href = \"index.php\">Sign Up</a>";
				echo "</p>";
			echo "</div>";
			require_once "include/footer.php";
			exit;
		}
		if($row['studnum'] == $studnum){
			$flag = 0;
			require_once "include/header.php";
			echo "<div id = \"login\">";
				echo "<p id = \"login_form\">";
					echo "Sign Up not successful! Student Number ".$studnum." already used.<br/><br/>";
					echo "<a href = \"index.php\">Sign Up</a>";
				echo "</p>";
			echo "</div>";
			require_once "include/footer.php";
			exit;
		}
	}
	
	/*
		The following query is used to check if there
		exist such username in the table Admin, flag
		will be 0 if there is, else flag remains as 1
	*/
	$checkAdmin = "select * from admin";
	$adminResult = mysql_query($checkAdmin,$con);
	while($row = mysql_fetch_assoc($adminResult)){
		if($row['username'] == $uname){
			$flag = 0;
			require_once "include/header.php";
			echo "<div id = \"login\">";
				echo "<p id = \"login_form\">";
					echo "Sign Up not successful! Username already exists.<br/><br/>";
					echo "<a href = \"index.php\">Sign Up</a>";
				echo "</p>";
			echo "</div>";
			require_once "include/footer.php";
		}
	}
	
	/*
		this is first student added to the database,
		no checking of duplicates needed
		
		information will be inserted in the
		table request. it will be there until
		the admin has approved it
	*/
	if(mysql_num_rows($result) == 0 && $flag == 1){
		$new_request = "insert into requests values(
			'{$_SESSION['studnum']}',
			'{$_SESSION['uname']}',
			'{$pass}',		
			'{$_SESSION['fname']}',
			'{$_SESSION['lname']}',
			'{$_SESSION['email']}'
		)";
		$res = mysql_query($new_request, $con);
		if (!$res) {
			require_once "include/header.php";
			echo "<div id = \"login\">";
				echo "<p id = \"login_form\">";
					echo "Sign Up not successful! Try again.<br/><br/>";
					echo "<a href = \"index.php\">Sign Up</a>";
				echo "</p>";
			echo "</div>";
			require_once "include/footer.php";
			exit;
		}else{
			header("Location: index.php?success=1");
		}

	}
	/*
		If the table has already been populated,
		the system will check if the current user trying to
		register already exists in the database.
		If yes, a prompt indicating "try again" will appear.
		else, information will be inserted to the table
		request, which will later be approved or declined by
		the admin.
	*/
	else{
		while ($row = mysql_fetch_assoc($result)) {
			if($uname===$row['username'] && $studnum===$row['studnum']){
				require_once "include/header.php";
				echo "<div id = \"login\">";
					echo "<p id = \"login_form\">";
						echo "Sign Up not successful! Try again.<br/><br/>";
						echo "<a href = \"index.php\">Sign Up</a>";
					echo "</p>";
				echo "</div>";
				require_once "include/footer.php";
			}
			else{
				if($flag == 1){
					$new_request = "insert into requests values(
						'{$_SESSION['studnum']}',
						'{$_SESSION['uname']}',
						'{$pass}',
						'{$_SESSION['fname']}',
						'{$_SESSION['lname']}',						
						'{$_SESSION['email']}'					
					)";
					$res1 = mysql_query($new_request, $con);
					if (!$res1) {
						require_once "include/header.php";
						echo "<div id = \"login\">";
							echo "<p id = \"login_form\">";
								echo "Sign Up not successful! Try Again.<br/><br/>";
								echo "<a href = \"index.php\">Sign Up</a>";
							echo "</p>";
						echo "</div>";
						require_once "include/footer.php";
						exit;
					}else{
						header("Location: index.php?success=1");
					}
					echo "successfully added to request";
				}
				else{
					require_once "include/header.php";
					echo "<div id = \"login\">";
						echo "<p id = \"login_form\">";
							echo "Sign Up not successful! Username already exists.<br/><br/>";
							echo "<a href = \"index.php\">Sign Up</a>";
						echo "</p>";
					echo "</div>";
					require_once "include/footer.php";
					exit;
				}
			}
		}
	}
	
	require_once "connection/close.php";
?>