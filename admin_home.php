<?php
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: admin_login.php");
	}
	require_once "include/admin_header.php";
?>

	<section id = "greetings">
		<article>
			<?php
				echo "Welcome, <em><a href = \"admin_home.php\" id = \"uname\">{$_SESSION['uname']}</a></em> ! 	| 	<a href = \"signout.php\">Sign Out</a>";
			?>
		</article>
	</section><br/>
	
	<section id = "admin_home_shelf">
		<img src="Athenaeum_Shelf.jpg" id="admin_home_SHELF" alt="The Athenaeum"/>
	</section>
	
	<section id = "nav">
		<?php
			require_once "include/admin_nav.php";
		?>
	</section>
	
	
<?php
	require_once "include/admin_footer.php";
	require_once "connection/close.php";
?>