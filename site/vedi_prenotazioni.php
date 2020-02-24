<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
?>

<html>
	<head>
		<title>Prenotazioni personali</title>
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
						if(!$con) die ("Errore di connessione");
						else
						{
							// ID utente corrente
							$user=$_SESSION["login_user"];
							$sql0="
							SELECT id_user
							FROM users
							WHERE user='$user'";
							$query0=mysqli_query($con,$sql0);
							$row0=mysqli_fetch_assoc($query0);
							
							$id_user=$row0['id_user'];
							
							// Prenotazioni legate all'utente corrente
							if ( strcmp ($ruolo_login, "venditore") == 0 )
							{
								$sql = "
								SELECT p.id_prenotazione, m.id_venditore, p.id_cliente, p.quantita, t.nome_miele 
								FROM prenotazioni AS p 
								INNER JOIN miele AS m
									ON p.id_miele=m.id_miele
								INNER JOIN tipo_miele AS t
									ON m.id_tipo_miele=t.id_tipo_miele
								WHERE p.confermata=0 AND m.id_venditore=$id_user";
							}
							else
							{
								$sql = "
								SELECT p.id_prenotazione, m.id_venditore, p.id_cliente, p.quantita, t.nome_miele 
								FROM prenotazioni AS p 
								INNER JOIN miele AS m
									ON p.id_miele=m.id_miele
								INNER JOIN tipo_miele AS t
									ON m.id_tipo_miele=t.id_tipo_miele
								WHERE p.confermata=0 AND p.id_cliente=$id_user";
							}
							$query =mysqli_query($con, $sql);
							
							echo "<h1 class='header orange-text'>Prenotazioni attive</h1><br>";
							
							echo "<table border='1' class='striped'>";
							// Intestazione tabella
							echo "<tr>";
								echo "<th>N° prenotazione</th>";
								if ( strcmp ($ruolo_login, "venditore") == 0 )
								{
									echo "<th>Info Cliente</th>";
								}
								else
								{
									echo "<th>Info Venditore</th>";
								}
								echo "<th>Miele</th>";
								echo "<th>Quantita</th>";
								echo "<th>Completa</th>";
								echo "<th>Cancella</th>";
							echo "</tr>";
							
							// Ciclo prenotazioni
							while ($row = mysqli_fetch_assoc($query)) 
							{
								// Estrazione dati
								$id_prenotazione = $row['id_prenotazione'];
								$id_cliente = $row['id_cliente'];
								$id_venditore = $row['id_venditore'];
								$nome_miele = $row['nome_miele'];
								$quantita = $row['quantita'];
								
								if ( strcmp ($ruolo_login, "venditore") == 0 )
								{
									$sql1="
									SELECT nome, cognome, user, num_tel
									FROM users
									WHERE id_user=$id_cliente";
								}
								else
								{
									$sql1="
									SELECT nome, cognome, user, num_tel
									FROM users
									WHERE id_user=$id_venditore";
								}
								
								$query1 = mysqli_query($con, $sql1);
								$row1 = mysqli_fetch_assoc($query1);
								
								$nome = $row1['nome'];
								$cognome = $row1['cognome'];
								$user = $row1['user'];
								$num_tel = $row1['num_tel'];
								
								// Contenuto tabella
								echo "<tr>";
									echo "<td>".$id_prenotazione."</td>";
									echo "<td>".$nome." - ".$cognome." - ".$user." - ".$num_tel."</td>";
									echo "<td>".$nome_miele."</td>";
									echo "<td>".$quantita."</td>";
									// Archiviazione
									echo "<td>
											<form action='conferma_prenotazione.php'>
												<input type='hidden' name='id_prenotazione' value='$id_prenotazione'>
												<button class='btn waves-effect waves-light' type='submit' name='action'>Completata</button>
											</form>
										</td>";
									// Cancellazione
									echo "<td>
											<form action='cancella_prenotazione.php'>
												<input type='hidden' name='id_prenotazione' value='$id_prenotazione'>
												<button class='btn waves-effect waves-light' type='submit' name='action'>Cancella</button>
											</form>
										</td>";
								echo "</tr>";
							}
							echo '</table>';
							
							echo "<h1 class='header orange-text'>Prenotazioni completate</h1><br>";
							
							// Prenotazioni completate legate all'utente corrente
							if ( strcmp ($ruolo_login, "venditore") == 0 )
							{
								$sql5 = "
								SELECT p.id_prenotazione, p.id_cliente, m.id_venditore, p.quantita, t.nome_miele 
								FROM prenotazioni AS p 
								INNER JOIN miele AS m
									ON p.id_miele=m.id_miele
								INNER JOIN tipo_miele AS t
									ON m.id_tipo_miele=t.id_tipo_miele
								WHERE p.confermata=1 AND m.id_venditore=$id_user";
							}
							else
							{
								$sql5 = "
								SELECT p.id_prenotazione, p.id_cliente, m.id_venditore, p.quantita, t.nome_miele 
								FROM prenotazioni AS p 
								INNER JOIN miele AS m
									ON p.id_miele=m.id_miele
								INNER JOIN tipo_miele AS t
									ON m.id_tipo_miele=t.id_tipo_miele
								WHERE p.confermata=1 AND p.id_cliente=$id_user";
							}
							$query5 =mysqli_query($con, $sql5);
							
							echo "<table border='1' class='striped'>";
							
							// Intestazione tabella
							echo "<tr>";
								echo "<th>N° prenotazione</th>";
								if ( strcmp ($ruolo_login, "venditore") == 0 )
								{
									echo "<th>Info Cliente</th>";
								}
								else
								{
									echo "<th>Info Venditore</th>";
								}
								echo "<th>Miele</th>";
								echo "<th>Quantita</th>";
							echo "</tr>";
							
							// Ciclo prenotazioni
							while ($row = mysqli_fetch_assoc($query5)) 
							{
								// Estrazione dati
								$id_prenotazione = $row['id_prenotazione'];
								$id_cliente = $row['id_cliente'];
								$id_venditore = $row['id_venditore'];
								$nome_miele = $row['nome_miele'];
								$quantita = $row['quantita'];
								
								if ( strcmp ($ruolo_login, "venditore") == 0 )
								{
									$sql1="
									SELECT nome, cognome, user, num_tel
									FROM users
									WHERE id_user=$id_cliente";
								}
								else
								{
									$sql1="
									SELECT nome, cognome, user, num_tel
									FROM users
									WHERE id_user=$id_venditore";
								}
								
								$query1 = mysqli_query($con, $sql1);
								$row1 = mysqli_fetch_assoc($query1);
								
								$nome = $row1['nome'];
								$cognome = $row1['cognome'];
								$user = $row1['user'];
								$num_tel = $row1['num_tel'];
								
								// Contenuto tabella
								echo "<tr>";
									echo "<td>".$id_prenotazione."</td>";
									echo "<td>".$nome." - ".$cognome." - ".$user." - ".$num_tel."</td>";
									echo "<td>".$nome_miele."</td>";
									echo "<td>".$quantita."</td>";
								echo "</tr>";
							}
							echo '</table>';
							echo "<br><br><br>";
							mysqli_close($con);
						}
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