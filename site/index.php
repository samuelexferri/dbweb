<?php
	session_start();
	session_unset();
	session_destroy();
	if(isset($_SESSION['login_user']))
	{
		header("location: profile.php");
	}
?>

<html>
	<head>
		<title>Beekeeper Unibg</title>
		<script type="text/javascript">			
			function check1()
			{
				var username1 = document.getElementById("username1").value;
				var password1 = document.getElementById("password1").value;
				
				if (username1 === undefined || username1 == "" || password1 === undefined || password1 == "")
				{
					alert("Controllare la compilazione dei campi.");
					return false;
				}
			}
		</script>
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	
	<body>
		<!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
		<header>
			<?php 
				// Menu
				echo "<nav  role='navigation'>
					<div class='nav-wrapper container'>
						<ul class='right hide-on-med-and-down'>
						</ul>
					</div>
				</nav>";
			?>
		</header>
		<main>
			<div class="section no-pad-bot" id="index-banner">
				<div class="container">
					<div style="width: 45%; margin-left:20px;">
						<h1 class='header orange-text'>Login</h1>
						<form action="login.php" method="post" onsubmit="return check1();">
							<h5 class='header col s12 light'>Username:</h5> <input type="text" name="username" placeholder="Inserire Username" id="username1">
							<h5 class='header col s12 light'>Password:</h5> <input type="password" name="password" placeholder="Inserire Password" id="password1">
							<br><br><button class="btn waves-effect waves-light" type="submit" name="action">Login</button>
						</form>
					</div>
					<br>
					<div style="margin-left:20px;">
						<div class="icon-block">
							<a href="/site/registrazione_form.php"class="btn-large waves-effect waves-light orange">Registrati</a>
						</div>
					</div>
					
					<br><br>
				</div>
			</div>
		</main>
		<footer class="page-footer">
            <div class="container grey-text text-darken-4">
				Beekeeper Unibg
            </div>
        </footer>
	</body>
</html>