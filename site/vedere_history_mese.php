<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$id_famiglia = $_REQUEST['id_famiglia'];
	$id_apiario = $_REQUEST['id_apiario'];
	$id_hmese  = $_REQUEST['id_hmese'];
?>
		
<html>
	<head>
		<title>Report mensile</title>
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
					<h1 class='header orange-text'>Report mensile</h1>
					
					<?php  
						$nomeDB ="localhost";
						$user = "beekeeperunibg";
						$psw = "";
						$database = "my_beekeeperunibg";
						
						$con = mysqli_connect($nomeDB,$user,$psw,$database);
						if(!$con) 
							die ("Errore di connessione");
						else
						{
							$sql = "SELECT nome, data, num_covata, in_salute, cibato, info_agg 
							FROM history_mese 
							INNER JOIN famiglie 
							ON history_mese.id_famiglia = famiglie.id_famiglia 
							WHERE history_mese.id_hmese='$id_hmese'";
							$query = mysqli_query($con, $sql);
							$h_mese=mysqli_fetch_assoc($query);
							
							echo "<h5 class='header col s12 light'>Nome famiglia: <br><b>" . $h_mese['nome'] . "</b><br><br>
							Data del report: <br><b>" . $h_mese['data'] . "</b><br><br>
							Numero di favi di covata: <br><b>" . $h_mese['num_covata'] . "</b><br><br>";
							if ( $h_mese['in_salute'] == 1)
								echo "<b>In salute</b><br>";
							else
								echo "<b>Non in salute</b><br>";
							if ( $h_mese['cibato'] == 1)
								echo "<br><b>Cibata</b><br><br>";
							else
								echo "<br><b>Non cibata</b><br><br>";
							echo "Informazioni aggiuntive: <br><b>". $h_mese['info_agg'] ."</b><br>";
							
							echo "</h5>";
							
						}
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