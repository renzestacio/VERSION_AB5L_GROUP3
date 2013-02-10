<?php
	session_start();
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	include 'connection/connect.php';
?>
	<?php echo $_SESSION['fname'];?> <br/> <br/>
	<?php echo $_SESSION['lname']; ?> <br/> <br/>
	<?php echo $_SESSION['email']; ?> <br/> <br/>
	<?php echo $_SESSION['college']; ?> <br/> <br/>
	<?php echo $_SESSION['degree']; ?> <br/> <br/>	

<?php	
	echo "<a href= \"edit.php\" > Change profile info </a>";
?>
