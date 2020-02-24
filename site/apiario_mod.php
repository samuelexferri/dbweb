<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>
		
<html>
	<head>
		<title>Modifica apiario</title>
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
					<h1 class='header orange-text'>Modifica apiario</h1>
					
					<h5 class='header col s12 light'></h5>
					<?php
						$nomeDB ="localhost";
						$user = "beekeeperunibg";
						$psw = "";
						$database = "my_beekeeperunibg";
						
						$con = mysqli_connect($nomeDB,$user,$psw,$database);
						if(mysqli_connect_errno()) die ("Errore di connessione");
						else
						{
							$id_apiario = $_REQUEST['id_apiario'];
							$sql = "SELECT luogo, altitudine FROM apiari WHERE id_apiario = $id_apiario";
							$query = mysqli_query($con, $sql);
							$row = mysqli_fetch_assoc($query);
							
							$luogo = $row['luogo'];
							$altitudine = $row['altitudine'];
						}
					?>
					
					
					<form action = "aggiorna_apiario.php" method = "get">
							<h5>Luogo:</h5><br> <input type="text" name="luogo" value="<?php echo $luogo; ?>" id="luogo">
							<br><br>
							<h5>Altitudine:</h5><br> <input type="text" name="altitudine" value="<?php echo $altitudine; ?>" id="altitudine">
							<br><br>
							<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
							<button class="btn waves-effect yellow" type="submit" name="action">Modifica</button>
					</form>
					<?php 
					echo '<br><br><br><a href="/site/vedere_apiario.php?id_apiario='.$id_apiario.'"class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>';
					?>
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