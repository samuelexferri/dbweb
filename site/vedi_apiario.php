<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	if ( strcmp ($ruolo_login, "cliente") == 0 ) /*die ("Non puoi")*/
	{
	header('Location: /site/profile.php');
	die(" ");
	}
	

?>
		
<html>
	<head>
		<title>Lista apiari</title>
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
					
					
					<h5 class='header col s12 light'></h5>
					<?php  
						$nomeDB ="localhost";
						$user = "beekeeperunibg";
						$psw = "";
						$database = "my_beekeeperunibg";
						
						$con = mysqli_connect($nomeDB,$user,$psw,$database);
						if(!$con) die ("Errore di connessione");
							else
							{
								// Se sei admin vedi tutti, se sei venditore solo i tuoi
								if ( strcmp ($ruolo_login, "admin") == 0 )
								{
									$sql3 = "SELECT luogo, id_apiario, nome, cognome 
									FROM apiari, users 
									WHERE apiari.id_venditore=users.id_user";
									$sql4 = "SELECT COUNT(*) AS num_famiglie 
									FROM apiari 
									INNER JOIN famiglie 
									ON apiari.id_apiario = famiglie.id_apiario 
									GROUP BY apiari.id_apiario";
									$query3 = mysqli_query($con, $sql3);
									$query4 = mysqli_query($con, $sql4);
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
									$sql3 = "SELECT luogo, id_apiario, nome, cognome 
									FROM apiari, users 
									WHERE apiari.id_venditore=users.id_user AND id_venditore=$id_curr";
									$sql4 = "
									SELECT COUNT(*) AS num_famiglie 
									FROM apiari 
									INNER JOIN famiglie 
									ON apiari.id_apiario = famiglie.id_apiario 
									WHERE id_venditore=$id_curr GROUP BY apiari.id_apiario";
									$query3 = mysqli_query($con, $sql3);
									$query4 = mysqli_query($con, $sql4);
								}
							}
					?>
				
					<h1 class='header orange-text'>Lista apiari</h1>
					<?php
						echo "<div>";
							echo "<table border='1' class='striped'>";
						 
							// Intestazione tabella
							echo "<tr>";
								echo "<th>Luogo apiario</th>";
								echo "<th>ID Apiario</th>";
								echo "<th>Nome proprietario</th>";
								echo "<th>Numero famiglie</th>";
								echo "<th>Vedi apiario</th>";
							echo "</tr>";
							
							while ($row3 = mysqli_fetch_assoc($query3)) 
							{	
								$row4 = mysqli_fetch_assoc($query4);
								if ($row4['num_famiglie'] == null)
									$row4['num_famiglie'] = 0;
									
								echo "<tr>";
									echo "<td>".$row3['luogo']."</td>";
									echo "<td>".$row3['id_apiario']."</td>";
									echo "<td>".$row3['nome']." ".$row3['cognome']."</td>";
									echo "<td>".$row4['num_famiglie']."</td>";
									echo "<td>
											<form action='vedere_apiario.php' method='get'>
												<input type='hidden' name='id_apiario' value='".$row3['id_apiario']."'>
												<button class='btn waves-effect waves-light' type='submit' name='action'>Apri</button>
											</form>
										</td>";
								echo "</tr>";
							}
							echo '</table>';
						echo "</div>";
						mysqli_close($con);
						
					?>	
					<br>	
					<form method="get" action = "new_apiario.php">
						<button class="btn-large waves-effect waves-light orange" type="submit" name="action">Nuovo apiario</button>
					</form>
					
					<br><a href="/site/home.php"class="btn-large waves-effect waves-light orange">Torna alla home</a><br><br><br>
						
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