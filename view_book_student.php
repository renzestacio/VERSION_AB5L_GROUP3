<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	
	require_once "include/checkSession.php";
	require_once "include/header.php";
	require_once "include/student_nav.php";
	
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	/*
		The following queries are used to retrieve
		information of the currently selected book
		from the database
	*/
	$query = "select * from book where booknum = '$_GET[id]'";	
	$result = mysql_query($query, $con);
	$query2 = "select * from book where booknum = '$_GET[id]'";	
	$result2 = mysql_query($query2, $con);	
?>
	
	<div id = "site_content">
		<div id = "book_image_student">
			<table>
				<tr>
					<?php
						while($row2 = mysql_fetch_assoc($result2)){
							echo "<td><img src=get_book_image.php?id=". $row2['BookID'] ."></td>";
							break;
						}
					?>
				</tr>
			</table>
		</div>
	</div>
	
	<div id = "student_book_info">
		<table cellspacing = "10">
			<tbody>
				<?php
					/*
						The following query retrieves all the information of the
						currently logged user from the database
					*/
					while($row = mysql_fetch_assoc($result)){
						echo"<tr>";
							echo "<td><strong>Book Number:</strong></td>";
							echo "<td>{$row['booknum']}</td>";
						echo"</tr>";
						
						echo"<tr>";
							echo "<td><strong>Author:</strong></td>";
							echo "<td>{$row['author']}</td>";
						echo"</tr>";
						
						echo "<tr>";
							echo "<td><strong>Title:</strong></td>";
							echo "<td>{$row['title']}</td>";
						echo "</tr>";
						
						echo "<tr>";
							echo "<td><strong>Publish date:</strong></td>";
							echo "<td>{$row['pub_date']}</td>";
						echo "</tr>";
						
							echo "<td><strong>Available</strong></td>";
							/*
								The following query is used to retrieved currently available
								instances of the selected book. It is then counted by the
								variable $avail
							*/
							$compute =  "select * from book where booknum='$row[booknum]' and studnum IS NULL";
							$tempres = mysql_query($compute, $con);
							$avail = 0;
							while($temp = mysql_fetch_assoc($tempres)){
								$avail+=1;
							}
							echo "<td>{$avail}</td>";
						
						break;
					}	
				?>
			</tbody>
		</table>
	</div>
	<br/><br/>
<?php
	require_once "include/footer.php";
	require_once "connection/close.php";
?>