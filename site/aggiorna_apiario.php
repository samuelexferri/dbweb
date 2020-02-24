<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
?>

<html>
	<head>
		<title>Apiario aggiornato</title>
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
						if(mysqli_connect_errno()) die ("Errore di connessione"); //cotrollo connessione
						else
						{
							$id_apiario=$_REQUEST['id_apiario'];
							if(!empty($_REQUEST['luogo']) && !empty($_REQUEST['altitudine']))
							{
								
								$luogo=$_REQUEST['luogo'];
								$altitudine=$_REQUEST['altitudine'];
								
							
								$query2 = mysqli_query($con,"UPDATE apiari SET luogo='$luogo', altitudine=$altitudine WHERE id_apiario=$id_apiario"); 
								
								if($query2)
								{
									echo "<h1 class='header orange-text'>Modifica confermata</h1>";
									echo "<br><br><h5 class='header col s12 light'>L'apiario è stato modificato con successo</h5>";
								}
								else
								{
									echo "<h1 class='header orange-text'>Modifica errata</h1>";
									echo "<br><br><h5 class='header col s12 light'>L'apiario non è stato modificato con successo</h5>";
								}
									
							}
							else
							{
								echo "<h1 class='header orange-text'>Modifica impossibile</h1>";
								echo "<br><br><h5 class='header col s12 light'>L'apiario non è stato modificato con successo perchè alcuni campi non sono stati compilati</h5>";
							}
						}
						mysqli_close($con);
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