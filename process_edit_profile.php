<?php
	session_start();
	include 'connection/connect.php';
	include 'image-resize.php';	
	/*
		if the user chooses to save currently chosen image,
		information in the database are updated.
	*/
	if((isset($_POST['imagesubmit']))){
		/*
			failed to upload the chosen image
		*/
		if( ! is_uploaded_file($_FILES['image']['tmp_name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK)
		{
				//echo "File not uploaded. Possibly too large or no file selected.";
				//echo '<script type="text/javascript" src="js/alert.js">imagealert();</script>';
				header("Location: edit_profile.php?success=3");
		}
		/*
			successfully uploaded the file
		*/
		else{
				mysql_select_db($db_name, $con);
				$file=$_FILES['image']['tmp_name'];
				$type=$_FILES['image']['type'];	
				$image_size = getimagesize($file);
			if($image_size == FALSE){
				header("Location: edit_profile.php?success=3");
			}else{
				$image = mysql_escape_string(imageresize($file, $type));
				//uncomment if no resize needed
				//$image =  mysql_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
				$image_name =  mysql_escape_string($_FILES['image']['name']);			
				if(!$insert=mysql_query("UPDATE `student` SET `imagename`='$image_name',`imagefile`='$image' WHERE `username`='$_SESSION[uname]'")){
					header("Location: edit_profile.php?success=3");
				}
				else{
					$_SESSION['imagefile'] = $image;
					header("Location: edit_profile.php?success=2");	
				}
			}
		}
	}
	/*
		The user has chosen to remove the currently uploaded image
	*/
	if(isset($_POST['imageremove'])){
		mysql_select_db($db_name, $con);
		$imagename = mysql_escape_string("defpic.jpg");
		$imagefile = mysql_escape_string(file_get_contents("defpic.jpg"));		
		if(isset($_SESSION['imagefile'])){
			if(!$insert=mysql_query("UPDATE `student` SET `imagename`='$imagename',`imagefile`='$imagefile' WHERE `username`='$_SESSION[uname]'")){
				header("Location: edit_profile.php?success=3");					
			}
			else{
				//$_SESSION['imagefile'] = NULL;
				header("Location: edit_profile.php?success=1");
			}
		}
		else{
			//tempo for javascript
			header("Location: edit_profile.php?success=0");
		}
	}
	
	/*
		If the user chooses to save the changes, the user's information
		are updated in the database
	*/
	if(isset($_POST['submit'])){
			mysql_select_db($db_name, $con);
			$update = "UPDATE `student` SET `fname`='$_POST[newfname]', `lname`='$_POST[newlname]', `email`='$_POST[newemail]', `college`='$_POST[newcollege]', `degree`='$_POST[newdegree]' WHERE `username`='$_SESSION[uname]'";
			mysql_query($update, $con) or die(mysql_error());
			$_SESSION['fname'] = $_POST['newfname'];
			$_SESSION['lname'] = $_POST['newlname'];
			$_SESSION['email'] = $_POST['newemail'];
			$_SESSION['college'] = $_POST['newcollege'];
			$_SESSION['degree'] = $_POST['newdegree'];
			
			$getpass = "SELECT * FROM `student` WHERE `username`='$_SESSION[uname]'";
			$tempres = mysql_query($getpass, $con);
			while($temp = mysql_fetch_assoc($tempres)){
				$pass = mysql_escape_string($temp['password']);
			}
			//echo $pass;
			//echo $_POST['oldpass'] ;
			if($_POST['oldpass'] != "" && $_POST['pass2'] != "" && $_POST['pass1'] != "" && $_POST['pass1'] == $_POST['pass2'] && md5($_POST['oldpass']) == $pass){
				
				$_SESSION['pass'] = $_POST['pass2'];
				$newpassword = md5($_POST['pass2']);
				$update = "UPDATE `student` SET `password`='$newpassword' WHERE `username`='$_SESSION[uname]'";
				mysql_query($update, $con) or die(mysql_error());
			}else{
				header("Location: edit_profile.php?success=3");
			}
			header("Location: view_profile.php?success=1");	
	/*
		The user cancelled all changes, and quits editing profile
	*/
	}else if(isset($_POST['cancel'])){
		header("Location: view_profile.php?success=2");	
	}
?>