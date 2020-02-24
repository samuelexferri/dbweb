<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$id_apiario = $_REQUEST['id_apiario'];
	
?>
		
<html>
	<head>
		<title>Apiario</title>
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
						if(!$con) 
							die ("Errore di connessione");
						else 
						{
							$sql = "SELECT luogo, altitudine, nome, cognome FROM apiari INNER JOIN users ON id_venditore = id_user WHERE id_apiario='$id_apiario'";
							$query = mysqli_query($con, $sql);
							$apiario=mysqli_fetch_assoc($query);
							echo "<div style='float:left; width:20%;'>";
							echo "<h3 class='header orange-text'>Apiario</h1>";
							echo "<h6 class='header col s12 light'>Luogo: <br><b>" . $apiario['luogo'] . "</b><br><br>
							Altitudine: <br><b>" . $apiario['altitudine'] . "</b><br><br>
							Proprietario: <br><b>" . $apiario['nome'] . " " . $apiario['cognome'] . "</b><br><br></h6>";
							
							echo '
								<form method="get" action = "apiario_mod.php">
									<input type="hidden" name="id_apiario" value="'. $id_apiario .'">
									<button class="btn-large waves-effect waves-light orange" type="submit" name="action">Aggiorna dati apiario</button>
								</form>
								<form method="get" action = "del_apiario.php">
									<input type="hidden" name="id_apiario" value="'. $id_apiario .'">
									<button class="btn-large waves-effect waves-light orange" type="submit" name="action">Elimina apiario</button>
								</form>';
							
							echo "<br><br><a href='/site/vedi_apiario.php' id='download-button' class='btn-large waves-effect waves-light orange'>Torna indietro</a><br><br><br>";
							
							echo "</div>";
							echo "<div style='float:right; width:75%;'>";
							echo "<h3 class='header orange-text'>Famiglie</h1>";
							
							$sql3 = "SELECT nome, id_famiglia FROM famiglie INNER JOIN apiari ON famiglie.id_apiario = apiari.id_apiario WHERE apiari.id_apiario='$id_apiario'";
							$query3 = mysqli_query($con, $sql3);
						
						
							$sql4 = "SELECT nome, id_famiglia, numero_favi FROM famiglie WHERE famiglie.id_apiario='$id_apiario'";
							$query4=mysqli_query($con, $sql4);
							
							echo "<table border='1' class='striped'>";	
							
							// Intestazione tabella
							echo "<tr>";
								echo "<th>Nome famiglia</th>";
								echo "<th>ID famiglia</th>";
								echo "<th>Numero favi</th>";
								echo "<th>Vedi famiglia</th>";
							echo "</tr>";
											
							while ($row4 = mysqli_fetch_assoc($query4)) 
							{							
								echo "<tr>";
									echo "<td>".$row4['nome']."</td>";
									echo "<td>".$row4['id_famiglia']."</td>";
									echo "<td>".$row4['numero_favi']."</td>";
									echo "<td>
											<form action='vedere_famiglia.php' method='get'>
												<input type='hidden' name='id_apiario' value='".$id_apiario."'>
												<input type='hidden' name='id_famiglia' value='".$row4['id_famiglia']."'>
												<button class='btn waves-effect waves-light' type='submit' name='action'>Apri</button>
											</form>
										</td>";
								echo "</tr>";
							}
							echo '</table>';
						}
						mysqli_close($con);
					?>
					<br><br>
					<form method="get" action = "new_famiglia.php">
						<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
						<button class="btn-large waves-effect waves-light orange" type="submit" name="action">Aggiungi famiglia</button>
					</form>
					
				</div>
			</div>
		</main>
	</body>
</html>