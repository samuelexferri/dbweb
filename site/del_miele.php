<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>

<html>
	<head>
		<title>Elimina qualità di miele</title>
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
							$sql = "DELETE FROM miele WHERE id_miele = $id_miele";
							$query = mysqli_query($con, $sql);
							
							if ($query)
							{
								echo "<h1 class='header orange-text'>Cancellazione confermata</h1>";
								echo "<br><br><h5 class='header col s12 light'>La cancellazione richiesta è andata a buon fine</h5>";
							}
							else
							{
								echo "<h1 class='header orange-text'>Cancellazione errata</h1>";
								echo "<br><br><h5 class='header col s12 light'>La cancellazione richiesta non è andata a buon fine</h5>";
							}
										
						}
						
						echo '<br><br><br><a href="/site/vedi_miele.php"class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>';
						
						mysqli_close($con);
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