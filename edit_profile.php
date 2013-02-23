<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<<<<<<< HEAD
<head>
	<script type="text/javascript" src="js/alert.js"></script>
</head>
=======
>>>>>>> 2/23/2013 CHANGES
<?php
	session_start();
	include 'connection/connect.php';
	/*creator notes: V 0.1
	*	-only change of password requires old password
	*	-code for change of password still needs improvement(TBD add js/jQuery for error messages, etc.)
	*/
	//just to make sure that the user is online when accessing this page
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "include/header.php";
?>

<section id = "left_side_edit">

<h3>You are now editting</h3>
<form action="process_edit_profile.php" method="post" enctype="multipart/form-data">
	
	<table>
	
	<tr class="label">File</tr>
	<tr><input type="file" name="image" ></tr>		
	<br/>
	<tr>
	<?php
		if(isset($_SESSION['imagefile']))
			echo "<img src=get.php?id=". $_SESSION['uname'] .">"; 
		else
			echo "No image";
	?>		
	<td><input type="submit" name="imagesubmit" value="Upload Image"></td>
	<td><input type="submit" name="imageremove" value="Remove Image"></td>
	</tr>
	</table>

	<br/>
	<table>
	<tr class="label" >First Name</tr>
	<tr class="field"><input type = "text" name = "newfname" pattern = "[A-z]{1,}" value="<?php echo $_SESSION['fname']; ?>" size="40" /></tr>
	<br/><br />
	<tr class="label">Last Name</tr> 
	<tr class="field"><input type = "text" name = "newlname" pattern = "[A-z]{1,}" value="<?php echo $_SESSION['lname']; ?>" size="40"/></tr>
	<br /><br />
	<tr class="label">Email Address </tr>
	<tr class="field"><input type = "email"  name = "newemail" required = "required" value="<?php echo $_SESSION['email']; ?>" size="40"/></tr>
	<br /><br />
	<tr class="label">College </tr>
	<tr class="field"><input type = "text"  name = "newcollege" value="<?php echo $_SESSION['college']; ?>" size="40"/></tr>
	<br /><br />
	<tr class="label">Degree</tr>
	<tr class="field"><input type = "text"  name = "newdegree" value="<?php echo $_SESSION['degree']; ?>" size="40"/></tr>
	<br /><br />
	<tr class="label">Old Password </tr>
	<tr class="field"><input type = "password" name = "oldpass"  pattern = "[A-z0-9]{6,}"  size="40"/></tr>
	<br /><br />
	<tr class="label">New Password </tr>
	<tr class="field"><input type = "password" name = "pass1"  pattern = "[A-z0-9]{6,}" size="40"/></tr>
	<br /><br />
	<tr class="label">Repeat New Password </tr>
	<tr class="field"><input type = "password" name = "pass2"  pattern = "[A-z0-9]{6,}" size="40" /></tr>
	<br /><br />
	<tr><input type = "submit" name = "submit" value = "Accept Changes" /></tr>
	<tr><input type = "submit" name = "cancel" value = "Cancel Changes" /></tr>
	</table>
</form>
</section>
		
<?php
	echo "<section id = \"nav\">";
	require_once "include/nav.php";
	echo "</section>";
	require_once "include/user_footer.php";
	require_once "connection/close.php";
?>
</html>


	