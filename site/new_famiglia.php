<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
	$id_apiario = $_REQUEST["id_apiario"];
?>
		
<html>
	<head>
		<title>Nuova famiglia</title>
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
					<h1 class='header orange-text'>Nuova famiglia</h1>
					
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
							$query2 = mysqli_query($con, "SELECT id_miele, nome_miele, costo_kg FROM miele INNER JOIN tipo_miele ON miele.id_tipo_miele = tipo_miele.id_tipo_miele");
						
						
							$login_username = $_SESSION["login_user"];
							$query = mysqli_query($con, "SELECT id_user FROM users WHERE user='$login_username'");
							$rows = mysqli_num_rows($query);
							if ($rows == 1) 
							{
								$curr_user=mysqli_fetch_assoc($query);
								$id_curr = $curr_user["id_user"];
							}
						}
					?>
					<form action="new_famiglia_add.php" method="post">
						<h5 class='header col s12 light'>Nome:</h5> <input type="text" name="nome" placeholder="Inserire nome" id="nome">
						<h5 class='header col s12 light'>Numero favi:</h5> <input type="text" name="numero_favi" placeholder="Inserire numero favi" id="numero_favi">
						<br><br>
						<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
						<button class="btn waves-effect waves-light" type="submit" name="action">Crea</button>
					</form>
					<?php
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