<?php
	/*creator notes: V 0.1
	*	-only change of password requires old password
	*	-code for change of password still needs improvement (it works but looks ugly IMHO) (TBD add js/jQuery for error messages, etc.)
	*	-add image avatar for every user (TBD)
	*/
	session_start();
	include 'connection/connect.php';
	//just to make sure that the user is online when accessing this page
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
?>


<h3>You are now editting</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
	FName: <input type = "text" name = "newfname" required = "required" pattern = "[A-z]{1,}" value="<?php echo $_SESSION['fname']; ?>" /> <br/><br/>
	Lname: <input type = "text" name = "newlname" required = "required" pattern = "[A-z]{1,}" value="<?php echo $_SESSION['lname']; ?>" /> <br/><br/>
	Email: <input type = "email"  name = "newemail" required = "required" value="<?php echo $_SESSION['email']; ?>" /> <br/><br/>
	College: <input type = "text"  name = "newcollege" value="<?php echo $_SESSION['college']; ?>" /> <br/><br/>
	Degree: <input type = "text"  name = "newdegree" value="<?php echo $_SESSION['degree']; ?>" /> <br/><br/>

	Old Passw: 	<input type = "password" name = "oldpass"  pattern = "[A-z]{6,}"  /> <br/><br/>
	New Passw: <input type = "password" name = "pass1"  pattern = "[A-z]{6,}" /> <br/><br/>
	Repeat New Passw: 	<input type = "password" name = "pass2"  pattern = "[A-z]{6,}"  /> <br/><br/> 

		<input type = "submit" name = "submit" value = "Accept Changes" />
		<input type = "submit" name = "cancel" value = "Cancel Changes" />
	<?php
	if(isset($_POST['submit'])){			
			mysql_select_db($db_name, $con);	
			$update = "UPDATE `student` SET `fname`='$_POST[newfname]', `lname`='$_POST[newlname]', `email`='$_POST[newemail]', `college`='$_POST[newcollege]', `degree`='$_POST[newdegree]' WHERE `username`='$_SESSION[uname]'";
			mysql_query($update, $con) or die(mysql_error());
			$_SESSION['fname'] = $_POST['newfname'];
			$_SESSION['lname'] = $_POST['newlname'];
			$_SESSION['email'] = $_POST['newemail'];
			$_SESSION['college'] = $_POST['newcollege'];
			$_SESSION['degree'] = $_POST['newdegree'];
			
			if($_POST['oldpass'] != "" && $_POST['pass2'] != "" && $_POST['pass1'] != "" && $_POST['pass1'] == $_POST['pass2']){
				$_SESSION['pass'] = $_POST['pass2'];
				$newpassword = md5($_POST['pass2']);
				$update = "UPDATE `student` SET `password`='$newpassword' WHERE `username`='$_SESSION[uname]'";
				mysql_query($update, $con) or die(mysql_error());
			}
			header("Location: view_profile.php");
	}else if(isset($_POST['cancel'])){
		header("Location: view_profile.php");
	}
	?>
</form>
	


	