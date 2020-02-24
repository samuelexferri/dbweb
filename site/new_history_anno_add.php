<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$id_apiario = $_REQUEST["id_apiario"];
	$id_famiglia = $_REQUEST["id_famiglia"];
?>
	
<html>
	<head>
		<title>Report annuale aggiunto</title>
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
							if(!empty($_POST))
							{
								if(!empty($_POST['anno']) && !empty($_POST['quantita_miele']) && !empty($_POST['colore_regina']))
								{
									$anno=$_POST['anno'];
									$quantita_miele=$_POST['quantita_miele'];
									$colore_regina=$_POST['colore_regina'];
									
									$query1 = mysqli_query($con,"DELETE FROM history_anno WHERE anno = '$anno' AND id_famiglia=$id_famiglia");
									
									$query = mysqli_query($con,"INSERT INTO history_anno (id_famiglia, anno, quantita_miele, colore_regina) VALUES ('".$id_famiglia."','".$anno."','".$quantita_miele."','".$colore_regina."');"); 
									if($query)
									{
										echo "<h1 class='header orange-text'>Aggiunta confermata</h1>";
										echo "<br><br><h5 class='header col s12 light'>Il nuovo report annuale legato alla famiglia correntemente selezionata è stato inserito</h5>";
									}
									else
									{
										echo "<h1 class='header orange-text'>Aggiunta errata</h1>";
										echo "<br><br><h5 class='header col s12 light'>Il nuovo report annuale non è stato inserito</h5>";
									}
								}
								else
								{
									echo "<h1 class='header orange-text'>Aggiunta impossibile</h1>";
									echo "<br><br><h5 class='header col s12 light'>Non è stato possibile aggiungere il nuovo report perchè alcuni campi non sono stati compilati</h5>";
								}
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