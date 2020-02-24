<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>
		
<html>
	<head>
		<title>Nuovo apiario</title>
		<script type="text/javascript">
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
				include 'menu.php';
			?>
		</header>
		<main>
			<div class="section no-pad-bot" id="index-banner">
				<div class="container">
					<h1 class='header orange-text'>Nuovo apiario</h1>
					<form action="new_apiario_add.php" method="post">
						<h5 class='header col s12 light'>Luogo:</h5><br> <input type="text" name="luogo" placeholder="Inserire luogo" id="luogo">
						<h5 class='header col s12 light'>Altitudine:</h5><br> <input type="text" name="altitudine" placeholder="Inserire altitudine" id="altitudine">
						<br><br>
						<button class="btn waves-effect waves-light" type="submit" name="action">Crea</button>
					</form>
					<br><br><br><a href="/site/vedi_apiario.php"class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>
						
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