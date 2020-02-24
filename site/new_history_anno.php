<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$id_apiario = $_REQUEST["id_apiario"];
	$id_famiglia = $_REQUEST["id_famiglia"];
?>
		
<html>
	<head>
		<title>Nuovo report annuale</title>
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
					<h1 class='header orange-text'>Nuovo report annuale</h1>
					
					<h1></h1>
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
							$query = mysqli_query($con, "SELECT id_colore, colore FROM colori_regina");
						}
					?>
					<form action="new_history_anno_add.php" method="post">
						
						</select>
						<h5 class='header col s12 light'>Anno:</h5> <input type="text" name="anno" placeholder="Inserire anno" id="anno">
						<h5 class='header col s12 light'>Quantita miele prodotta:</h5> <input type="text" name="quantita_miele" placeholder="Inserire q. miele" id="quantita_miele">
						<h5 class='header col s12 light'>Colore regina:</h5>
						
						<select name='colore_regina' id='colore_regina'>
						<?php
							while($reg=mysqli_fetch_assoc($query)) 
							{
								echo "<option value=" . $reg['id_colore']  . "> ". $reg['colore'] . "</option>";
							} 
						?>
						</select>
						
						<br>
						<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
						<input type="hidden" name="id_famiglia" value="<?php echo $id_famiglia; ?>">
						<button class="btn waves-effect waves-light" type="submit" name="action">Invia</button>
					</form>
					<?php
						echo '<br><br><br><a href="/site/vedere_famiglia.php?id_famiglia='.$id_famiglia.'&id_apiario='.$id_apiario.'" id="back-button" class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>';
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