<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
?>
		
<html>
	<head>
		<title>Modifica miele</title>
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
					<?php
						$nomeDB ="localhost";
						$user = "beekeeperunibg";
						$psw = "";
						$database = "my_beekeeperunibg";
						
						$con = mysqli_connect($nomeDB,$user,$psw,$database);
						if(mysqli_connect_errno()) die ("Errore di connessione");
						else
						{
							$id_miele = $_REQUEST['id_miele'];
							$sql = "SELECT costo_kg, disponibilita FROM miele WHERE id_miele = $id_miele";
							$query = mysqli_query($con, $sql);
							$row = mysqli_fetch_assoc($query);
							
							$costo_kg = $row['costo_kg'];
							$disponibilita = $row['disponibilita'];
						}
					?>
					
					<h1 class='header orange-text'>Modifica miele</h1>	
					<form action = "aggiorna_miele.php" method = "get">
						<h5>Costo in kg:</h5><br> <input type="text" name="costo_kg" value="<?php echo $costo_kg; ?>" id="costo_kg">
						<br><br>
						<h5>Disponibilità:</h5><br> <input type="text" name="disponibilita" value="<?php echo $disponibilita; ?>" id="disponibilita">
						<br><br>
						<input type="hidden" name="id_miele" value="<?php echo $id_miele; ?>">
						<button class="btn waves-effect waves-light" type="submit" name="action">Modifica</button>
					</form>
					<br><br><br><a href="/site/vedi_miele.php"class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>
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