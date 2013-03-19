<?php
	session_start();
	
	require_once "connection/connect.php";
	require_once "connection/use_db.php";

	require_once "include/checkSession.php";
	require_once "include/header.php";
	require_once "include/student_nav.php";

	$success = -1;
	
	if(!isset($_GET['success'])){
		$success = -1;
	}
	else if($_GET['success'] == 1){
		$success = 1;
	}
	else if($_GET['success'] == 0){
		$success = 0;
	}else if($_GET['success'] == 2){
		$success = 2;
	}else if($_GET['success'] > 2){
		$success = 3;
	}
?>

	<div id = "site_content">
		
		<div id = "prompt_edit_profile">
			<aside>
				<?php
					/*
							when process_add_book.php sends a value of 1, it indicates a successful transaction
						else, the value 0 indicates a failure in addition of book
					*/
					if($success == 1){
						echo "Update Successful!";
					}
					else if($success == 0){
						echo "Update Failed!";
					}else if($success == 2){
						echo "Picture successfully uploaded.";
					}else if($success > 2){
						echo "Picture not successfully uploaded.";
					}
				?>
			</aside><br/>
		</div>
		
		<div id = "edit_info_container">
			<form id = "edit_info_form" action="process_edit_profile.php" method="post" enctype="multipart/form-data">
				<table cellspacing = "8">
						<tfoot>
							<tr>
								<td><input class = "submit" type = "submit" name = "submit" value = "Accept Changes" /></td>
								<td><input class = "submit" type = "submit" name = "cancel" value = "Cancel Changes" /></td>
							</tr>
						</tfoot>
						
						<tbody>
							<tr>
								<th><label for = "newfname">First Name:</label></th>
								<td><input type = "text" name = "newfname" pattern = "[A-z]{1,}" value="<?php echo $_SESSION['fname']; ?>"  /></td>
							</tr>
							
							<tr>
								<th><label for = "newlname">Last Name:</label></th>
								<td><input type = "text" name = "newlname" pattern = "[A-z]{1,}" value="<?php echo $_SESSION['lname']; ?>" /></td>
							</tr>
							
							<tr>
								<th><label for = "newemail">Email:</label></th>
								<td><input type = "email"  name = "newemail" required = "required" value="<?php echo $_SESSION['email']; ?>" /></td>
							</tr>
							
							<tr>
								<th><label for = "newcollege">College:</label></th>
								<td><input type = "text" name = "newcollege" value="<?php echo $_SESSION['college']; ?>" /></td>
							</tr>
							
							<tr>
								<th><label for = "newdegree">Degree:</label></th>
								<td><input type = "text" name = "newdegree" value="<?php echo $_SESSION['degree']; ?>" /></td>
							</tr>
							
							<tr>
								<th><label for = "oldpass">Old Password:</label></th>
								<td><input type = "password" name = "oldpass"  pattern = "[A-z0-9]{6,}"  /></td>
							</tr>
							
							<tr>
								<th><label for = "pass1">New Password:</label></th>
								<td><input type = "password" name = "pass1"  pattern = "[A-z0-9]{6,}"  /></td>
							</tr>
							
							<tr>
								<th><label for = "pass2">Confirm New Password:</label></th>
								<td><input type = "password" name = "pass2"  pattern = "[A-z0-9]{6,}"  /></td>
							</tr>
							
							<tr>
							<th><label for = "image"> Image of the book: </label></th>
								<td><input type="file" name="image" id = "image"></td>
							</tr>
							
							<tr>
								<td></td>
								<td>
									<?php 
										/*
											Displays the current chosen image
										*/
										if(isset($_SESSION['imagefile']))
											echo "<img src=get.php?id=". $_SESSION['uname'] .">"; 
										else
											echo "No image";
									?>
									<br/>
								</td>
							</tr>
							
							<tr>
								<td><input type="submit" name="imagesubmit" value="Upload Image"></td>
								<td><input type="submit" name="imageremove" value="Remove Image"></td>
							</tr>
							
						</tbody>
					</table>
			</form>
		</div>
	</div>
	
<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>

