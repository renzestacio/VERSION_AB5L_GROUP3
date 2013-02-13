<?php
	session_start();
	//hanggang hindi nakaset yung username hindi makakapasok yung gustong makaaccess dito
	if(!isset($_SESSION['uname'])){
		header("Location: login.php");
	}
	require_once "include/header.php";
?>

	<section id = "greetings">
		<article>
			<?php
				echo "Welcome, <em><a href = \"home.php\" id = \"uname\">{$_SESSION['uname']}</a></em> ! 	| 	<a href = \"signout.php\" id=\"text_color\">Sign Out</a>";
			?>
		</article>
	</section><br/>
	
	<section id="home_shelf">
		<img src="Athenaeum_Shelf.jpg" id="home_SHELF" alt="The Athenaeum"/>
	</section>
	
	<section id = "nav">
		<?php
			require_once "include/nav.php";
		?>
	</section>
	
<?php
	require_once "include/user_footer.php";
?>