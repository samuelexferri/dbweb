<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$id_famiglia = $_REQUEST['id_famiglia'];
	$id_apiario = $_REQUEST['id_apiario'];
	$id_hanno  = $_REQUEST['id_hanno'];
		
?>
		
<html>
	<head>
		<title>Report annuale</title>
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
					<h1 class='header orange-text'>Report annuale</h1>
					
					<h5 class='header col s12 light'></h5>
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
							$query = mysqli_query($con, "SELECT nome, anno, quantita_miele, colore_regina FROM history_anno INNER JOIN famiglie ON history_anno.id_famiglia = famiglie.id_famiglia WHERE history_anno.id_hanno='$id_hanno'");
							$h_anno=mysqli_fetch_assoc($query);
							
							echo "<h5 class='header col s12 light'>Nome famiglia: <br><b>" . $h_anno['nome'] . "</b><br><br>
							Anno del report: <br><b>" . $h_anno['anno'] . "</b><br><br>
							Miele prodotto: <br><b>" . $h_anno['quantita_miele'] . "</b><br><br>";
							switch ($h_anno['colore_regina'])
							{
								case(1):
									echo "Colore regina: <br><b>Rosso</b><br><br>"; //0
								break;
								case(2):
									echo "Colore regina: <br><b>Verde</b><br><br>"; //1
								break;
								case(3):
									echo "Colore regina: <br><b>Azzurro</b><br><br>"; //2
								break;
								case(4):
									echo "Colore regina: <br><b>Bianco</b><br><br>"; //3
								break;
								case(5):
									echo "Colore regina: <br><b>Giallo</b><br><br>"; //4
								break;
							}
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
	</body>
</html>