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
				echo "Welcome, <em><a href = \"home.php\" id = \"uname\">{$_SESSION['uname']}</a></em> ! 	| 	<a href = \"signout.php\">Sign Out</a>";
			?>
		</article>
	</section><br/>
	
	<section id = "mylib">
		<article>
			anong magandang ipakita dito?
		</article>
	</section>
	
	<section id = "nav">
		<?php
			require_once "include/nav.php";
		?>
	</section>
	
<?php
	require_once "include/user_footer.php";
?>
