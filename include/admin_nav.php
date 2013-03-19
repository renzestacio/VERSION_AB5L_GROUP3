<!--
	The main links are Home, Profile, User, Book and Log Out.
	I. Home
	II. Profile
		A. View Profile
		B. Edit Profile
	III. User
		A. Add User
		B. Search User
			1. View User
			2. Edit User
	IV. Book
		A. Add Book
		B. Search Book
			1. View Book
			2. Edit Book
	V. Log Out
-->

<nav>
	<div id = "menu_container">
		<ul class = "sf-menu" id = "navi">
			<li><a href="admin_home.php">Home</a></li>
			
			<li>User
				<ul>
					<li><a href = "add_user_requests.php">Add User</a></li>
					<li><a href = "search_user.php">Search User</a></li>
				</ul>
			</li>
			
			<li>Book
				<ul>
					<li><a href = "add_book.php">Add Book</a></li>
					<li><a href = "search_book_admin.php">Search Book</a></li>
				</ul>
			</li>
			
			<li><a href = "./logout.php">Log Out</a></li>
		</ul>
	</div>
</nav>

	<br/><br/><br/><br/><br/>
	<h2 class="greeting" > Welcome &nbsp;<?php echo "<a href = \"admin_home.php\">{$_SESSION['uname']}</a>"; ?> ! </h2>


