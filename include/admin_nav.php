
		<?php
			require_once "connection/connect.php";
			require_once "connection/use_db.php";
		?>
		
		<div id="accordion">
			<h3 class = "titles">User<h3>
				<div class = "content">
					<p><a href = "user_requests.php" class = "links">Add</a></p>
					<p><a href = "search_user.php" class = "links">Search</a></p>
					
				</div>
				
			<h3 class = "titles">Books<h3>
			<div class = "content">
				<p><a href = "add_book.php" class = "links">Add</a></p>
				<p><a href = "search_book_admin.php" class = "links">Search</a></p>
				<p><a href = "#" class = "links">Remove</a></p>
			</div>
				
		</div>
		
		
		<script>
			$( "#accordion" ).accordion();
		</script>
		<?php require_once "connection/close.php";?>