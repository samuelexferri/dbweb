<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
?>
		
<html>
	<head>
		<title>Lista venditori</title>
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
					<h1 class='header orange-text'>Venditori</h1>
				
					<?php
						$nomeDB ="localhost";
						$user = "beekeeperunibg";
						$psw = "";
						$database = "my_beekeeperunibg";
						
						$con = mysqli_connect($nomeDB,$user,$psw,$database);
						if(!$con) die ("Errore di connessione");
						else
						{
							$sql = "SELECT user, nome, cognome, residenza, num_tel FROM users INNER JOIN venditore ON id_user = id_venditore";
							$query =mysqli_query($con, $sql);
							
							echo "<table border='1' class='striped'>";

							// Intestazione tabella
							echo "<tr>";
								echo "<th>Nome</th>";
								echo "<th>Cognome</th>";
								echo "<th>Residenza</th>";
								echo "<th>Numero telefonico</th>";
								echo "<th>Miele venduto</th>";
							echo "</tr>";
							
							while ($row = mysqli_fetch_assoc($query)) 
							{
								$usrname = $row['user'];
								echo "<tr>";
								echo "<td>".$row['nome']."</td>";
								echo "<td>".$row['cognome']."</td>";
								echo "<td>".$row['residenza']."</td>";
								echo "<td>".$row['num_tel']."</td>";
								echo "<td>
										<form action='miele.php'>
											<input type='hidden' name='usrname' value='$usrname'>
											<button class='btn waves-effect waves-light' type='submit' name='action'>Miele</button>
										</form>
									</td>";
								echo "</tr>";
							}
							echo '</table>';
							echo '<br><br><br><a href="/site/home.php"class="btn-large waves-effect waves-light orange">Torna alla home</a><br><br><br>';
							
							mysqli_close($con);
						}
					?>
					<br><br>
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