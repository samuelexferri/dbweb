<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>
		
<html>
	<head>
		<title>Miele aggiunto</title>
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
							if(!empty($_REQUEST))
							{
								if(!empty($_REQUEST['id_tipo_miele']) && !empty($_REQUEST['costo_kg']) && !empty($_REQUEST['disponibilita']) && !empty($_REQUEST['id_venditore']))
								{
									$id_tipo_miele=$_REQUEST['id_tipo_miele'];
									$costo_kg=$_REQUEST['costo_kg'];
									$disponibilita=$_REQUEST['disponibilita'];
									$id_venditore=$_REQUEST['id_venditore'];
									
									$sql2 = "INSERT INTO miele (id_tipo_miele, costo_kg, disponibilita, id_venditore) VALUES ($id_tipo_miele, $costo_kg, '$disponibilita', $id_venditore)";
									$query2 = mysqli_query($con, $sql2); 
									if($query2)
									{
										echo "<h1 class='header orange-text'>Aggiunta confermata</h1>";
										echo "<br><br><h5 class='header col s12 light'>La nuova qualità di miele è stata inserita</h5>";
									}
									else
									{
										echo "<h1 class='header orange-text'>Aggiunta fallita</h1>";
										echo "<br><br><h5 class='header col s12 light'>La nuova qualità di miele non è stata inserita a causa di un errore</h5>";
									}
								}
								else
								{
									echo "<h1 class='header orange-text'>Aggiunta fallita</h1>";
									echo "<br><br><h5 class='header col s12 light'>La nuova qualità di miele è stata inserita perchè uno o più campi non sono stati compilati</h5>";
								}
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