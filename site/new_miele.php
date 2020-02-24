<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>
		
<html>
	<head>
		<title>Aggiungi miele</title>
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
					<h1 class='header orange-text'>Nuovo miele</h1>
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
							$login_username = $_SESSION["login_user"];
							$sql0 = "SELECT id_user FROM users WHERE user = '$login_username'";
							$query0 = mysqli_query($con, $sql0);
							$row = mysqli_fetch_assoc($query0);
							$id_venditore = $row['id_user'];
							
							$sql = "SELECT id_tipo_miele, nome_miele FROM tipo_miele";
							$query = mysqli_query($con, $sql);
						}
					?>
					<form action="new_miele_add.php" method="post">
						<h5 class='header col s12 light'>Tipo miele:</h5>
						
						<select name='id_tipo_miele' id='id_tipo_miele'>					
						<?php	 
							while($row1=mysqli_fetch_assoc($query)) { 
								echo "<option value='" . $row1['id_tipo_miele'] . "'> ". $row1['nome_miele'] . "</option>";
							} 
						?>
						</select>
						
						<br>
						<h5 class='header col s12 light'>Costo al kg:</h5><br> <input type="text" name="costo_kg" placeholder="Inserire costo" id="costo_kg">
						<h5 class='header col s12 light'>Disponibilita (kg):</h5><br> <input type="text" name="disponibilita" placeholder="Inserire disponibilita" id="disponibilita">
						<input type="hidden" name="id_venditore" value="<?php echo $id_venditore; ?>">
						<button class="btn waves-effect waves-light" type="submit" name="action">Crea</button>
						<br><br><br><a href="/site/vedi_miele.php"class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>
							
					</form>
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