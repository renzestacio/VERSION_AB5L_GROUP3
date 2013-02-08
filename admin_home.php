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
	
	<section id = "mylib">
		
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