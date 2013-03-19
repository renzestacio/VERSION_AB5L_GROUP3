<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	require_once "include/checkSession.php";
	include 'connection/connect.php';
		
	/*
		Instance(s) of the book are being removed
	*/
	
	var_dump($_POST);
	if(isset($_POST['remove'])){
		/*
			All currently available instances of selected
			book will be removed from the table book
		*/
		if($_POST['removeoption'] == 1){
			mysql_select_db($db_name, $con);
			$delete = "DELETE FROM `book` WHERE `booknum`='{$_GET['id']}' AND `studnum` IS NULL";
			mysql_query($delete, $con) or die(mysql_error());			
				require_once "include/admin_header.php";
				echo "<div id = \"admin_login\">";
					echo "<p id = \"login_form\">";
						echo "All copies of {$_GET['id']} were succesfully deleted.<br/><br/>";
						echo "<a href = \"search_book_admin.php\">Search Book |</a>";
						echo "<a href = \"admin_home.php\">Home |</a>";
						echo "<a href = \"search_user.php\">Search User</a>";
					echo "</p>";
				echo "</div>";
			require_once "include/footer.php";
		}
		/*
			certain number of currently available instances of selected
			book will be removed from the table book
		*/
		else{
			mysql_select_db($db_name, $con);
				$book = "select * from book where booknum = '{$_GET['id']}' AND `studnum` IS NULL";
				$book_result = mysql_query($book,$con);			
				for($i=1 ; $i<=$_POST['removenum'] ; $i++){
				while($bookrow = mysql_fetch_assoc($book_result)){
					$delete = "DELETE FROM `book` WHERE `BookID`='$bookrow[BookID]' AND `studnum` IS NULL";
					$bnum = $bookrow['booknum'];
					mysql_query($delete, $con) or die(mysql_error());
					break;
				}
			}
				$countQuery = "select * from book where booknum = '$bnum'";
				$countResult = mysql_query($countQuery,$con);
				if(mysql_num_rows($countResult)==0) header("Location: search_book_admin.php");
				else header("Location: view_book_admin.php?id={$_GET['id']}&success=2");	
		}
	}
	
?>