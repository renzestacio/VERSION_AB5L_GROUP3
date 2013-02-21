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
	
	if(mysql_num_rows($result) == 0){
		//inserts the values in the table
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
			echo "Could not successfully run query {$new_request} from DB: " . mysql_error();
			exit;
		}else{
			header("Location: login.php");
		}

	}else{
		//tables are already populated
		while ($row = mysql_fetch_assoc($result)) {
			if($uname===$row['username'] && $studnum===$row['studnum']){
				require_once "include/header.php";
				echo "<section id = \"login\">";
					echo "<article id = \"login_form\">";
						echo "Invalid input. Try again.<br/><br/>";
						echo "<a href = \"register.php\">Sign Up</a>";
					echo "</article>";
				echo "</section>";
				require_once "include/footer.php";
			}
			else{
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
					echo "Could not successfully run query {$new_request} from DB: " . mysql_error();
					exit;
				}else{
					header("Location: login.php");
				}
			}
		}
	}
	
	

	
	require_once "connection/close.php";
?>