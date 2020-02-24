<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>

<html>
	<head>
		<title>Aggiunta apiario</title>
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
						if(mysqli_connect_errno()) die ("Errore di connessione.");
						else
						{							
							if(!empty($_POST))
							{
								if(!empty($_REQUEST['luogo']) && !empty($_REQUEST['altitudine']) )
								{
									$luogo=$_REQUEST['luogo'];
									$altitudine=$_REQUEST['altitudine'];
									$sql = "SELECT id_user FROM users WHERE user = '$username'";
									$query = mysqli_query($con, $sql);
									$row=mysqli_fetch_assoc($query);
									$id_venditore=$row['id_user'];
									
									
									$query2 = mysqli_query($con,"INSERT INTO apiari (luogo, altitudine, id_venditore) VALUES ('$luogo','$altitudine',$id_venditore)"); 
									if($query2)
									{
										echo "<h1 class='header orange-text'>Aggiunta confermata</h1>";
										echo "<br><br><h5 class='header col s12 light'>Il nuovo apiario è stato inserito</h5>";
									}
									else
									{
										echo "<h1 class='header orange-text'>Aggiunta errata</h1>";
										echo "<br><br><h5 class='header col s12 light'>Non è stato possibile inserire il nuovo apiario</h5>";
									}
								}
								else
								{
									echo "<h1 class='header orange-text'>Aggiunta impossibile</h1>";
									echo "<br><br><h5 class='header col s12 light'>Il nuovo apiario non è stato inserito perchè alcuni campi non sono stati compilati</h5>";
								}
							}
						}
						mysqli_close($con);
					?>
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