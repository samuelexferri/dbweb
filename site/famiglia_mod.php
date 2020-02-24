<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
?>
		
<html>
	<head>
		<title>Famiglia modificata</title>
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
					<h1 class='header orange-text'>Modifica famiglia</h1>
					
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
							$id_famiglia = $_REQUEST['id_famiglia'];
							$id_apiario = $_REQUEST['id_apiario'];
							
							$sql0 = "SELECT nome, numero_favi, id_apiario FROM famiglie WHERE id_famiglia = $id_famiglia";
							$query0 = mysqli_query($con, $sql0);
							$row = mysqli_fetch_assoc($query0);
							$nome = $row['nome'];
							$numero_favi = $row['numero_favi'];
							$id_apiario = $row['id_apiario'];
							
							
							if ( strcmp ($ruolo_login, "admin") == 0 )
							{
								$query1 = mysqli_query($con, "SELECT luogo, id_apiario FROM apiari");
								}
							else
							{
								$login_username = $_SESSION["login_user"];
								$query = mysqli_query($con, "SELECT id_user FROM users WHERE user='$login_username'");
								$rows = mysqli_num_rows($query);
								if ($rows == 1) 
								{
									$curr_user=mysqli_fetch_assoc($query);
									$id_curr = $curr_user["id_user"];
								}
								$query1 =mysqli_query($con, "SELECT luogo, id_apiario FROM apiari WHERE id_venditore=$id_curr");
							}
						}
					?>
					<form action = "aggiorna_famiglia.php" method = "get">
							<h5 class='header col s12 light'>Nome:</h5> <input type="text" name="nome" value="<?php echo $nome; ?>" id="nome">
							<h5 class='header col s12 light'>Numero favi:</h5> <input type="text" name="numero_favi" value="<?php echo $numero_favi; ?>" id="numero_favi">

							<input type="hidden" name="id_famiglia" value="<?php echo $id_famiglia; ?>">
							<input type="hidden" name="id_open_apiario" value="<?php echo $id_apiario; ?>">
							<br><br><button class="btn waves-effect waves-light" type="submit" name="action">Modifica</button>
					</form>
					
					<br><br><br><a href="/site/home.php" id="back-button" class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>
						
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