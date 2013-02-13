
		<?php
			require_once "connection/connect.php";
			require_once "connection/use_db.php";
		?>
		
		<div id="accordion">
			<h3 class = "titles">User<h3>
				<div class = "content">
					<p class = "links"><a href = "user_requests.php">Add</a></p>
					<p class = "links"><a href = "search_user.php">Search</a></p>
					
				</div>
				
			<h3 class = "titles">Books<h3>
			<div class = "content">
				<p class = "links"><a href = "add_book.php">Add</a></p>
				<p class = "links"><a href = "#">Edit</a></p>
				<p class = "links"><a href = "#">Remove</a></p>
			</div>
				
		</div>
		
		
		<script>
			$( "#accordion" ).accordion();
		</script>
		<?php require_once "connection/close.php";?>