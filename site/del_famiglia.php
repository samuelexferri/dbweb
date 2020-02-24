<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>

<html>
	<head>
		<title>Famiglia eliminata</title>
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
						if(mysqli_connect_errno()) die ("Errore di connessione");
						else
						{
							$id_apiario = $_REQUEST['id_apiario'];
							$id_famiglia = $_REQUEST['id_famiglia'];
							
							// Ricerca dei report collegati
							$sql1 = "SELECT id_hanno FROM history_anno WHERE id_famiglia = $id_famiglia";
							$sql2 = "SELECT id_hmese FROM history_mese WHERE id_famiglia = $id_famiglia";
							
							$query1=mysqli_query($con, $sql1);
							$query2=mysqli_query($con, $sql2);
							
							// Cancellazione di tutti i report annuali
							while ($row1 = mysqli_fetch_assoc($query1))
							{
								$id_hanno = $row1['id_hanno'];
								$sql3 = "DELETE FROM history_anno WHERE id_hanno = $id_hanno";
								$query3 = mysqli_query($con, $sql3);
							}
							
							// Cancellazione di tutti i report mensili
							while ($row2 = mysqli_fetch_assoc($query2))
							{
								$id_hmese = $row2['id_hmese'];
								$sql4 = "DELETE FROM history_mese WHERE id_hmese = $id_hmese";
								$query4 = mysqli_query($con, $sql4);
							}
							
							// Cancellazione della famiglia
							$sql = "DELETE FROM famiglie WHERE id_famiglia = $id_famiglia";
							$query = mysqli_query($con, $sql);
							
							if ($query)
							{
								echo "<h1 class='header orange-text'>Eliminazione confermata</h1>";
								echo "<br><br><h5 class='header col s12 light'>La famiglia e tutti i suoi report sono stati cancellati</h5>";
							}
							else
							{
								echo "<h1 class='header orange-text'>Eliminazione errata </h1>";
								echo "<br><br><h5 class='header col s12 light'>La famiglia non è stata cancellata</h5>";
							}
						}
						mysqli_close($con);
						echo '<br><br><br><a href="/site/vedere_apiario.php?id_apiario='.$id_apiario.'" id="back-button" class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>';
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