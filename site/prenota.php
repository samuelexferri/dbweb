<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
?>

<html>
	<head>
		<title>Prenotazione miele</title>
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
					if(!$con) die ("Errore di connessione");
					else
					{
						$id_miele = $_REQUEST['id_miele'];
						$quantita = $_REQUEST['quantita'];
						$usrname_vendor = $_REQUEST['usrname_vendor'];
						$sql0 = "
						SELECT disponibilita
						FROM miele
						WHERE id_miele = $id_miele";
						$query0 =mysqli_query($con, $sql0);
						$row = mysqli_fetch_assoc($query0);
						$new_disp = $row['disponibilita'] - $quantita;
						if ( $row['disponibilita'] >= $quantita && $quantita > 0)
						{
							$usrname = $_SESSION["login_user"];
							
							
							// Trovare l'id del cliente
							$sql1 = "SELECT id_user FROM users WHERE user = '$usrname'";
							$query1 =mysqli_query($con, $sql1);
							$row = mysqli_fetch_assoc($query1);
							$id_cliente = $row['id_user'];
							
							// Aggiornare la disponibilita del miele
							$sql3 = "		
							UPDATE miele		
							SET disponibilita = $new_disp
							WHERE id_miele = $id_miele";
							
							//Creare nuova prenotazione
							$sql6= "
							INSERT INTO prenotazioni
							(id_cliente, id_miele, quantita, confermata)
							VALUES ($id_cliente, $id_miele, $quantita, 0)";
							
							// Inizio transazione
							mysqli_query($con, "begin");
										
							$query3 =mysqli_query($con, $sql3);
							$query6 =mysqli_query($con, $sql6);
							
							if($query3 && $query6)
							{
								echo "<h1 class='header orange-text'>Prenotazione aggiunta</h1>";
								echo "<br><br><h5 class='header col s12 light'>Prenotazione di ".$quantita. " kg completata con successo</h5>";
								$commit = "commit";
								$querylog = "&nbsp&nbspModifica effettuata!";
							}
							else
							{
								echo "<h1 class='header orange-text'>Prenotazione fallita</h1>";
								echo "<br><br><h5 class='header col s12 light'>Un errore è avvenuto durante la creazione della prenotazione</h5>";
								$commit = "rollback";
							}
							
							mysqli_query($con,$commit);
						}	
						else
						{
							echo "<h1 class='header orange-text'>Prenotazione fallita</h1>";
							echo "<br><br><h5 class='header col s12 light'>E' stata inserita una quantitò non valida</h5>";
						}
						echo '<br><br><br><a href="/site/miele.php?usrname='.$usrname_vendor.'"class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>';
						mysqli_close($con);
					}
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