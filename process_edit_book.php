<?php
	session_start();
	include 'connection/connect.php';
	include 'image-resize.php';
	$id = mysql_escape_string($_REQUEST['id']);
	
	if((isset($_POST['imagesubmit']))){
		if( ! is_uploaded_file($_FILES['image']['tmp_name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK)
		{
				//echo "File not uploaded. Possibly too large or no file selected.";
			header("Location: view_book_admin.php?id={$id}");
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
				if(!$insert=mysql_query("UPDATE `book` SET `imagename`='$image_name',`imagefile`='$image' WHERE `booknum`='$id'")){
					echo "Upload Failed";
				}
				else{
					header("Location: view_book_admin.php?id={$id}");
				}
			}
		}
	}
	
	if(isset($_POST['submit'])){
			mysql_select_db($db_name, $con);
			$update = "UPDATE `book` SET `booknum`='$_POST[newbooknum]', `title`='$_POST[newtitle]', `author`='$_POST[newauthor]', `pub_date`='$_POST[newdate]' WHERE `booknum`='$id'";
			mysql_query($update, $con) or die(mysql_error());
			
			$getval = "SELECT * FROM `book` WHERE `booknum`='$id'";
			$tempres = mysql_query($getval, $con);
			while($temp = mysql_fetch_assoc($tempres)){
				$imagename = mysql_escape_string($temp['imagename']);
				$imagefile = mysql_escape_string($temp['imagefile']);
				$status = mysql_escape_string($temp['status']);	
			}
			
			for($i=1 ; $i<=$_POST['newquantity'] ; $i++){
				$add = "insert into book(booknum, author,title,pub_date,status,imagename,imagefile) values(
					'$_POST[newbooknum]',
					'$_POST[newauthor]',
					'$_POST[newtitle]',
					'$_POST[newdate]',
					'$status',
					'$imagename',
					'$imagefile'
				)";
				$inserted = mysql_query($add, $con);
			}			
			
			header("Location: view_book_admin.php?id={$_POST[newbooknum]}");
	}else if(isset($_POST['cancel'])){
		header("Location: view_book_admin.php?id={$id}");
	}
	
	if(isset($_POST['remove'])){
		if($_POST['removeoption'] == 1){	//delete all
			mysql_select_db($db_name, $con);
			$delete = "DELETE FROM `book` WHERE `booknum`='$id' AND `studnum` IS NULL";
			mysql_query($delete, $con) or die(mysql_error());			
			header("Location: admin_home.php");
		}
		else{	//delete by number (incomplete)
			mysql_select_db($db_name, $con);
				for($i=1 ; $i<=$_POST['removenum'] ; $i++){
				$book = "select * from book where booknum = '$id' AND `studnum` IS NULL";
				$book_result = mysql_query($book,$con);
				while($bookrow = mysql_fetch_assoc($book_result)){
					$delete = "DELETE FROM `book` WHERE `BookID`='$bookrow[BookID]' AND `studnum` IS NULL";
					mysql_query($delete, $con) or die(mysql_error());
					break;
				}
			}
			header("Location: admin_home.php");			
		}
	}
	
?>