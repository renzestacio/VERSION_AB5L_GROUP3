<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	require_once "include/checkSession.php";

	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
	require_once "include/admin_header.php";
	require_once "include/admin_nav.php";

	/*
		this indicates whether a recently added book
		has been successful or not
	*/
	$success = -1;
	
	if(!isset($_GET['success'])){
		$success = -1;
	}
	else if($_GET['success'] == 1){
		$success = 1;
	}
	else if($_GET['success'] == 0){
		$success = 0;
	}
	
?>
	
	<div id="site_content">
		
		<div id = "prompt_add_user">
			<aside>
				<?php
						/*
							when process_add_book.php sends a value of 1, it indicates a successful transaction
							else, the value 0 indicates a failure in addition of book
						*/
						if($success == 1){
							echo "User was successfully added!";
						}
						else if($success == 0){
							echo "Fail to add user.";
						}
				?>
			</aside>
		</div>
		
		<div id = "user_requests_container">
			<table cellpadding = "5px" width = "100%">
				<thead>
					<tr>
						<th>Student Number</th>
						<th>Username</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = "select * from requests";	
						$result = mysql_query($query, $con);
						while($row = mysql_fetch_assoc($result)){
							echo "<tr>";
								echo "<td>{$row['studnum']}</td>";
								echo "<td>{$row['username']}</td>";
								echo "<td>{$row['fname']}</td>";
								echo "<td>{$row['lname']}</td>";
								echo "<td>{$row['email']}</td>";
								echo "<td><a href = \"process_requests.php?studnum={$row['studnum']}\">Accept Request</a></td>";
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