
<?php
	session_start();
	/*
		admins can only access the system when successfully logged in
	*/
	require_once "include/checkSession.php";
	require_once "include/admin_header.php";
	require_once "include/admin_nav.php";
	
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	require_once "punish.php";

	if(!isset($_GET['success'])){
		$success = -1;
	}
	else if($_GET['success'] == 1){
		$success = 1;
	}
	else if($_GET['success'] == 2){
		$success = 2;
	}
	else{
		$success = 0;
	}
	
	if(isset($_POST['studnum'])) $studnum_filter = mysql_real_escape_string($_POST['studnum']);
	else $studnum_filter = "";
	if(isset($_POST['fname'])) $fname_filter = mysql_real_escape_string($_POST['fname']);
	else $fname_filter = "";
	if(isset($_POST['lname'])) $lname_filter = mysql_real_escape_string($_POST['lname']);
	else $lname_filter = "";
	
		/*
		if filters are blank, all users should be shown
	*/
		if($studnum_filter == "" && $fname_filter == "" && $lname_filter == ""){
			$query = "select * from student order by lname";
		}
		else{
			/*
				filter by student number only
			*/
			if($studnum_filter != "" && $fname_filter == "" && $lname_filter == ""){
				$query = "select * from student where studnum like '%$studnum_filter%'";
			}
			/*
				filter by first name only
			*/
			else if($studnum_filter == "" && $fname_filter != "" && $lname_filter == ""){
				$query = "select * from student where fname like '%$fname_filter%'";
			}
			/*
				filter by last name only
			*/
			else if($studnum_filter == "" && $fname_filter == "" && $lname_filter != ""){
				$query = "select * from student where lname like '%$lname_filter%'";
			}
			/*
				filter by student number and first name
			*/
			else if($studnum_filter != "" && $fname_filter != "" && $lname_filter == ""){
				$query = "select * from student where studnum like '%$studnum_filter%' and fname like '%$fname_filter%'";
			}
			/*
				filter by student number and last name
			*/
			else if($studnum_filter != "" && $fname_filter == "" && $lname_filter != ""){
				$query = "select * from student where studnum like '%$studnum_filter%' and lname like '%$lname_filter%'";
			}
			/*
				filter by first name and last name
			*/
			else if($studnum_filter == "" && $fname_filter != "" && $lname_filter != ""){
				$query = "select * from student where fname like '%$fname_filter%' and lname like '%$lname_filter%'";
			}
			/*
				filter by student number, first name and last name
			*/
			else if($studnum_filter != "" && $fname_filter != "" && $lname_filter != ""){
				$query = "select * from student where studnum like '%$studnum_filter%' and fname like '%$fname_filter%' and lname like '%$lname_filter%'";
			}
		}
?>

	<div id = "site_content">
		<div id="prompt_punish_unpunish">
		<aside>
		<?php
			if($success == 1) echo "Student has been punished";
			else if($success == 2) echo "Student has been unpunished";
		?>
		</aside>
		</div>
		<div id = "search_user_container">
			<form class = "form_settings" action="search_user_result.php" method="post">
				
				<table cellspacing= "15px">
				<tr>
					<td><label for = "studnum">Student Number: </label></td>
					<td><input type="text" name="studnum" pattern="[0-9]{0,4}-{0,1}[0-9]{0,5}" /></td>
				</tr>
				<tr>
					<td><label for = "fname">First Name: </label></td>
					<td><input type="text" name="fname" pattern="[A-z0-9 ]{0,}" /></td>
				</tr>
				
				<tr>
					<td><label for = "studnum">Last Name: </label></td>
					<td><input type="text" name="lname" pattern="[A-z0-9 ]{0,}" /></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input class = "submit" type="submit" value="Search"></td>
				</tr>
				</table>
			</form>
		</div>
		
		<div id = "search_user_result_container">
			<table cellpadding = "5px">
				<thead>
					<tr>
						<th>Student Number</th>
						<th>Username</th>
						<th>Email</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$result = mysql_query($query,$con);
						while($row = mysql_fetch_assoc($result)){
							echo "<tr>";
								
								/*
									Student number is a link to view_search_profile.php page
								*/
								echo "<td><a href = \"view_search_profile.php?id={$row['studnum']}\">{$row['studnum']}</a></td>";
								echo "<td>{$row['username']}</td>";
								echo "<td>{$row['email']}</td>";
								echo "<td>{$row['fname']}</td>";
								echo "<td>{$row['lname']}</td>";
								/*
									The following are actions that can be performed by the admin to a certain student.
									option "punish" changes the student's status to 0 wherein he/she can no longer borrow a book
									option "unpunish" changes the student's status to 1 wherein he/she is allowed to borrow a book
								*/
								echo "<form class = \"form_settings\" action=\"punish.php?id={$row['studnum']}\" method=\"post\">";
									if($row['canborrow'] == 1){
										echo "<td><input class = \"submit\" type=\"submit\" name=\"punish\" value=\"Punish\"></td>";
										
									}else{
										echo "<td><input class = \"submit\" type=\"submit\" name=\"unpunish\" value=\"Unpunish\"></td>";
									}
								echo "</form>";
							echo "</tr>";	
						}
					?>
				</tbody>				
			</table>
		</div>
	</div>
	
	
<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>