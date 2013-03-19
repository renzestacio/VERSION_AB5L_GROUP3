<?php
	require_once "include/header.php";
	require_once "connection/connect.php";
	require_once "connection/use_db.php";
	
?>

	<div id="site_content">
		<div id = "user_requests_container">
			
			<form class = "form_settings" action = "search_book_guest_result.php" method = "post">
				<table>
				<tfoot>
					<tr>
						<td>
							|&nbsp;&nbsp;&nbsp;
							<a href = "index.php">Sign Up</a>&nbsp;&nbsp;&nbsp;|&nbsp;
							<a href = "index.php">Home</a>&nbsp;&nbsp;&nbsp;|&nbsp;
							<a href = "index.php">Log In</a>&nbsp;&nbsp;&nbsp;|
						</td>
					</tr>
				</tfoot>
				<tbody>
					<tr>
						<td>
							<input type = "text" name = "search"  />
							<input class = "submit" type = "submit" value = "Search book"/>
						</td>
					</tr>
				</tbody>
				</table>
			</form>
			
			<table cellpadding = "5" width = "100%">
				<thead>
					<tr>
						<th>Book Number</th>
						<th>Title</th>
						<th>Author</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						$key = htmlentities(mysql_escape_string($_POST['search']));

						/*
							since there are no filters for the guest search,
							if the form is blank, all books will be shown
							else, the entered word/s will both be a
							filter for title and author
						*/
						$query = "select * from book where title like '%$key%' or author like '%$key%' order by booknum";
						$result = mysql_query($query,$con);
						
						/*
							guest search only displays the book's title and author
						*/
						$current_booknum = "a";
						while($row = mysql_fetch_assoc($result)){
							while($current_booknum != $row['booknum']){
								echo "<tr><td align=\"center\">";
								echo $row['booknum'];
								echo "</td><td align=\"center\">";
								echo $row['title'];
								echo "</td><td align=\"center\">";
								echo $row['author'];
								echo "</td>";
								
								$current_booknum = $row['booknum'];
								break;
							}
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