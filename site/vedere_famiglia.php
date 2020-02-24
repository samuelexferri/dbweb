<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$id_famiglia = $_REQUEST['id_famiglia'];
	$id_apiario = $_REQUEST['id_apiario'];
?>
		
<html>
	<head>
		<title>Famiglia</title>
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
						if(!$con) 
							die ("Errore di connessione");
						else
						{
							$query = mysqli_query($con, "SELECT nome, numero_favi FROM famiglie WHERE id_famiglia='$id_famiglia'");
							$famiglia=mysqli_fetch_assoc($query);
							echo "<div style='float:left; width:20%;'>";
							echo "<h3 class='header orange-text'>Famiglia</h3>";
							echo "<h6 class='header col s12 light'>Nome famiglia: <br><b>" . $famiglia['nome'] . "</b><br><br>Numero favi: <br><b>" . $famiglia['numero_favi'] . "</h6></b><br><br>";
							echo '
								<form method="get" action = "famiglia_mod.php">
									<input type="hidden" name="id_famiglia" value="'.$id_famiglia.'">
									<input type="hidden" name="id_apiario" value="'.$id_apiario.'">
									<button class="btn-large waves-effect waves-light orange" type="submit" name="action">Modifica</button>
								</form>
								
								<form method="get" action = "del_famiglia.php">
									<input type="hidden" name="id_famiglia" value="'.$id_famiglia.'">
									<input type="hidden" name="id_apiario" value="'.$id_apiario.'">
									<button class="btn-large waves-effect waves-light orange" type="submit" name="action">Elimina</button>
								</form>';
							
							echo "<br><br><br><br><br><br><a href='/site/vedere_apiario.php?id_apiario=".$id_apiario."' class='btn-large waves-effect waves-light orange'>Torna indietro</a><br><br><br>";
							
							echo "</div>";
							echo "<div style='float:right; width:75%;'>";
							echo "<h3 class='header orange-text'>Reports</h3>";
							$query2 = mysqli_query($con, "SELECT id_hanno, anno FROM history_anno WHERE id_famiglia='$id_famiglia'");
							$query3 = mysqli_query($con, "SELECT id_hmese, data FROM history_mese WHERE id_famiglia='$id_famiglia'");
						}
					?>
	
					<h5 class='header col s12 light'>Scegli report annuale</h5>
					<form method="get" action = "vedere_history_anno.php">
						<select name='id_hanno' id='id_hanno'>
						<?php
							while($hanno=mysqli_fetch_assoc($query2)) 
							{
								echo "<option value=" . $hanno['id_hanno']  . "> ". $hanno['anno'] . "</option>";
							} 
						?>
						</select>
						<input type="hidden" name="id_famiglia" value="<?php echo $id_famiglia; ?>">
						<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
						<button class="btn waves-effect waves-light" type="submit" name="action">Apri</button>
					</form>
					
					<h5 class='header col s12 light'>Scegli report periodico</h5>
					<form method="get" action = "vedere_history_mese.php">
						<select name='id_hmese' id='id_hmese'>
						<?php
							while($hmese=mysqli_fetch_assoc($query3)) 
							{
								echo "<option value=" . $hmese['id_hmese']  . "> " . $hmese['data'] . "</option>";
							}
						?>
						</select>
						<input type="hidden" name="id_famiglia" value="<?php echo $id_famiglia; ?>">
						<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
						<button class="btn waves-effect waves-light" type="submit" name="action">Apri</button>		
					</form>
					
					<br><br>
					
					<form method="get" action = "new_history_anno.php">
						<input type="hidden" name="id_famiglia" value="<?php echo $id_famiglia; ?>">
						<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
						<button class="btn-large waves-effect waves-light orange" type="submit" name="action">Aggiungi report annuale</button>
					</form>
					
					<form method="get" action = "new_history_mese.php">
						<input type="hidden" name="id_famiglia" value="<?php echo $id_famiglia; ?>">
						<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
						<button class="btn-large waves-effect waves-light orange" type="submit" name="action">Aggiungi report periodico</button>
					</form>
				</div>
			</div>
		</main>
	</body>
</html>