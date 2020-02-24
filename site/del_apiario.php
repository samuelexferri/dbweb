<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>

<html>
	<head>
		<title>Apiario eliminato</title>
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
					<h1 class='header orange-text'></h1>
					<h5 class='header col s12 light'></h5>
					<?php
						$nomeDB ="localhost";
						$user = "beekeeperunibg";
						$psw = "";
						$database = "my_beekeeperunibg";
						
						$con = mysqli_connect($nomeDB,$user,$psw,$database);
						if(mysqli_connect_errno()) die ("Errore di connessione.");
						else
						{
							$id_apiario = $_REQUEST['id_apiario'];
							
							$sql1="SELECT id_famiglia FROM famiglie WHERE id_apiario='$id_apiario'";
							$query1=mysqli_query($con, $sql1);
							
							// Cancellazione di tutte le famiglie
							while ($row1 = mysqli_fetch_assoc($query1)) 
							{
								$id_fam = $row1['id_famiglia'];
								
								$sql4 = "SELECT id_hanno FROM history_anno WHERE id_famiglia = $id_fam";
								$sql5 = "SELECT id_hmese FROM history_mese WHERE id_famiglia = $id_fam";
								
								$query4=mysqli_query($con, $sql4);
								$query5=mysqli_query($con, $sql5);
								
								// Cancellazione di tutti i report annuali
								while ($row4 = mysqli_fetch_assoc($query4))
								{
									$id_hanno = $row4['id_hanno'];
									$sql6 = "DELETE FROM history_anno WHERE id_hanno = $id_hanno";
									$query6 = mysqli_query($con, $sql6);
								}
								
								// Cancellazione di tutti i report mensili
								while ($row5 = mysqli_fetch_assoc($query5))
								{
									$id_hmese = $row5['id_hmese'];
									$sql7 = "DELETE FROM history_mese WHERE id_hmese = $id_hmese";
									$query7 = mysqli_query($con, $sql7);
								}
								
								
								$sql3 = "DELETE FROM famiglie WHERE id_famiglia = $id_fam";
								$query = mysqli_query($con, $sql3);
							}
							
							// Cancellazione apiari
							$sql2 = "DELETE FROM apiari WHERE id_apiario = $id_apiario";
							$query2 = mysqli_query($con, $sql2);
							
							if ($query2)
							{
								echo "<h1 class='header orange-text'>Eliminazione confermata</h1>";
								echo "<br><br><h5 class='header col s12 light'>L'apiario, tutte le famiglie e tutti i report collegati sono stati eliminati</h5>";
							}
							else
							{
								echo "<h1 class='header orange-text'>Eliminazione fallita</h1>";
								echo "<br><br><h5 class='header col s12 light'>L'apiario non è stato eliminato</h5>";
							}
										
						}
						mysqli_close($con);
						echo '<br><br><br><a href="/site/vedi_apiario.php"class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>';
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