<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
?>

<html>
	<head>
		<title>Famiglia aggiornata</title>
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
							// Recupero dei dati
							$id_famiglia=$_REQUEST['id_famiglia'];
							if(!empty($_REQUEST['nome']) && !empty($_REQUEST['numero_favi']) && !empty($_REQUEST['id_open_apiario']))
							{
								$nome=$_REQUEST['nome'];
								$numero_favi=$_REQUEST['numero_favi'];
								$id_apiario=$_REQUEST['id_open_apiario'];
								
								// Aggiornamento dati
								$query2 = mysqli_query($con,"UPDATE famiglie SET nome='$nome', numero_favi=$numero_favi, id_apiario=$id_apiario WHERE id_famiglia=$id_famiglia"); 
								if($query2)
								{
									// Ok
									echo "<h1 class='header orange-text'>Modifica confermata</h1>";
									echo "<br><br><h5 class='header col s12 light'>La famiglia è stata modificata</h5>";
								}
								else
								{
									// Errore interno
									echo "<h1 class='header orange-text'>Modifica errata</h1>";
									echo "<br><br><h5 class='header col s12 light'>La famiglia non è stata modificata</h5>";
								}
							}
							else
							{
								// Errore utente
								echo "<h1 class='header orange-text'>Modifica impossibile</h1>";
								echo "<br><br><h5 class='header col s12 light'>La famiglia non è stata modificata perchè alcuni campi non sono stati compilati</h5>";
							}
						}
						mysqli_close($con);
							
						echo '<br><br><br><a href="/site/vedere_famiglia.php?id_famiglia='.$id_famiglia.'&id_apiario='.$id_apiario.'" id="back-button" class="btn-large waves-effect waves-light orange">Torna alla home/indietro</a><br><br><br>';
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