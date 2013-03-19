<!--
	The main links are Home, Profile, Book and Log Out.
	I. Home
	II. Profile
		A. View Profile
		B. Edit Profile
	III. Book
		A. Add Book
		B. Search Book
			1. View Book
			2. Edit Book
	IV. Log Out
-->

<nav>
	<div id = "menu_container">
		<ul class = "sf-menu" id = "navi">
			<li><a href="home.php">Home</a></li>
			
			<li>Profile
				<ul>
					<li><a href = "view_profile.php">View Profile</a></li>
					<li><a href = "edit_profile.php">Edit Profile</a></li>
				</ul>
			</li>
			
			<li><a href = "search_book_student.php">Search Book</a></li>
			
			<li><a href = "./logout.php">Log Out</a></li>
		</ul>
	</div>
</nav>

	<br/><br/><br/><br/><br/>
	<h2 class="greeting" > Welcome &nbsp;<?php echo "<a href = \"view_profile.php\">{$_SESSION['uname']}"; ?></a> ! </h2>
	