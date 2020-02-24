<?php
	session_start();
	$username = $_SESSION["login_user"];
	$ruolo_login = $_SESSION["role"];
?>
		
<html>
	<head>
		<script type="text/javascript">
			function check()
			{
				var name = document.getElementById("nome").value;
				var surname = document.getElementById("surname").value;
				var residence = document.getElementById("residence").value;
				var yearofbirth = document.getElementById("birthday").value;
				var num_tel = document.getElementById("num_tel").value;
				
				if (name === undefined || name == "" || surname === undefined || surname == "" || residence === undefined || residence == "" || yearofbirth === undefined || num_tel === undefined)
				{
					alert("Controllare la compilazione dei campi.");
					return false;
				}
			}
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
					<h1 class='header orange-text'>Modifica profilo utente</h1>
					
					<?php
						$nomeDB ="localhost";
						$user = "beekeeperunibg";
						$psw = "";
						$database = "my_beekeeperunibg";
						
						$con = mysqli_connect($nomeDB,$user,$psw,$database);
						if(mysqli_connect_errno()) die ("Errore di connessione");
						else
						{
							$sql = "SELECT nome, cognome, residenza, data_nascita, num_tel FROM users WHERE user = '$username'";
							$query = mysqli_query($con, $sql);
							
							$user = mysqli_fetch_assoc($query);
						}
					?>
					
					<form action = "aggiorna_profilo.php" method = "post" onsubmit="return check();">
						<h5 class='header col s12 light'>Nome:</h5> <input type = "text" name = "name" value = "<?php echo $user['nome']; ?>" id= "name">
						<br><br>
						<h5 class='header col s12 light'>Cognome:</h5> <input type = "text" name = "surname" value = "<?php echo $user['cognome']; ?>" id = "surname">
						<br><br>
						<h5 class='header col s12 light'>Residenza:</h5> <input type = "text" name = "residence" value = "<?php echo $user['residenza']; ?>" id= "residence">
						<br><br>
						<h5 class='header col s12 light'>Data di Nascita:</h5> <input type = "date" name = "birthday" value = "<?php echo $user['data_nascita']; ?>" id = "birthday">
						<br><br>
						<h5 class='header col s12 light'>Numero telefonico:</h5> <input type = "text" name = "num_tel" value = "<?php echo $user['num_tel']; ?>" id = "num_tel">
						<br><br>
						<button class="btn waves-effect waves-light" type="submit" name="action">Invia</button>
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