<?php
	session_start();
	include 'connection/connect.php';
	include 'image-resize.php';	
	if((isset($_POST['imagesubmit']))){
		if( ! is_uploaded_file($_FILES['image']['tmp_name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK)
		{
				//echo "File not uploaded. Possibly too large or no file selected.";
				//echo '<script type="text/javascript" src="js/alert.js">imagealert();</script>';
				header("Location: edit_profile.php");
		}else{
				mysql_select_db($db_name, $con);
				$file=$_FILES['image']['tmp_name'];
				$type=$_FILES['image']['type'];	
				$image_size = getimagesize($file);
			if($image_size == FALSE){
				echo "that's not an image!";
			}else{
				$image = mysql_escape_string(imageresize($file, $type));
				//uncomment if no resize needed
				//$image =  mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
				$image_name =  mysql_escape_string($_FILES['image']['name']);			
				if(!$insert=mysql_query("UPDATE `student` SET `imagename`='$image_name',`imagefile`='$image' WHERE `username`='$_SESSION[uname]'")){
					echo "Upload Failed";
				}
				else{
					$_SESSION['imagefile'] = $image;
					header("Location: view_profile.php");				
				}
			}
		}
	}
	if(isset($_POST['imageremove'])){
		mysql_select_db($db_name, $con);
		if(isset($_SESSION['imagefile'])){
			if(!$insert=mysql_query("UPDATE `student` SET `imagename`=NULL,`imagefile`=NULL WHERE `username`='$_SESSION[uname]'")){
				echo "Remove Failed";
			}
			else{
				$_SESSION['imagefile'] = NULL;
				header("Location: view_profile.php");
			}
		}
		else{
			//tempo for javascript
			echo "No image already";
		}
	}
	
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
			}else{
				echo "require old password and matching new passwords";
			}
			header("Location: view_profile.php");
	}else if(isset($_POST['cancel'])){
		header("Location: view_profile.php");
	}
?>