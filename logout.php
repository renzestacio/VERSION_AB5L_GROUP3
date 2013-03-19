<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
  /*
	To logout a user, his/her session is destroyed
  */
	session_start();
	session_destroy();
	header("Location: index.php");
?>
