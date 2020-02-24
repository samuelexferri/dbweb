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
		<title>Registrazione</title>
		<script type="text/javascript">
			function check()
			{
				var username = document.getElementById("username").value;
				var password = document.getElementById("password").value;
				var password1 = document.getElementById("password1").value;
				
				if (username === undefined || username == "" || password === undefined || password == "" || password != password1)
				{
					alert("Controllare la compilazione dei campi");
					return false;
				}
			}
		</script>
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection"/>

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
					<div class='nav-wrapper container center'>
						<a href='/site/index.php'>Beekeeper Unibg</a>
					</div>
				</nav>";
			?>
		</header>
		<main>
			<div class="section no-pad-bot" id="index-banner">
				<div class="container">
					<div style="margin-left:20px;">
						<h1 class='header orange-text'>Registrazione</h1>
							
						<form action="registrazione.php" method="post" onsubmit="return check();">
							<div style="float:left; width:45%;">
								<h5 class='header col s12 light'>Username:</h5> <input type="text" name="username" placeholder="Inserire Username" id="username">
								<h5 class='header col s12 light'>Nome:</h5> <input type="text" name="name" placeholder="Inserire Nome" id="name">
								<h5 class='header col s12 light'>Cognome:</h5><input type="text" name="surname" placeholder="Inserire Cognome" id="surname">
								<h5 class='header col s12 light'>Data Nascita:</h5> <input type="date" name="birthday" max="2017-12-31" min="1900-01-01">
							</div> 
							<div style="float:right; width:45%;">
								<h5 class='header col s12 light'>Residenza:</h5> <input type="text" name="residence" placeholder="Inserire Residenza" id="residence">
								<h5 class='header col s12 light'>Numero di telefono:</h5> <input type="text" name="num_tel" placeholder="Numero telefonico" id="num_tel">
								<h5 class='header col s12 light'>Password:</h5> <input type="password" name="password" placeholder="Inserire Password" id="password">
								<h5 class='header col s12 light'>Ripeti Password:</h5> <input type="password" name="password1" placeholder="Inserire Password" id="password1">
								
								<button class="btn waves-effect waves-light" type="submit" name="action">Registrati</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>

	</body>
</html>