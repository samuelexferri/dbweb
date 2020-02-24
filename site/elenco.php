<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
?>

<html>
	<head>
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
					<h1 class='header orange-text'></h1>
					
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
							$query =mysqli_query($con, "SELECT user from users");
							
							echo "<table border='1' class='striped'>";
					 
							// Intestazione tabella
							echo "<tr>";
								echo "<th>Username</th>";
								echo "<th>Promuovi</th>";
								echo "<th>Profilo</th>";
							echo "</tr>";
							
							
							while ($row = mysqli_fetch_assoc($query)) 
							{
								//extract($row);
								$usrname = $row['user'];
								echo "<tr>";
									echo "<td>".$usrname."</td>";
									$sql = "SELECT user from users INNER JOIN cliente ON id_user = id_cliente WHERE user='$usrname'";
									$query1 = mysqli_query($con, $sql);
									
									if (mysqli_num_rows($query1)==0)
									{
										echo "<td>
												<button class='btn waves-effect waves-orange' type='submit' name='action' disabled>Promuovi</button>
											</td>";
									}
									else
									{
										echo "<td>
												<form action='prom.php'>
													<input type='hidden' name='usrname' value='$usrname'>
													<button class='btn waves-effect waves-orange' type='submit' name='action'>Promuovi</button>
												</form>
											</td>";
									}
									echo "<td>
											<form action='profilo_ext.php'>
												<input type='hidden' name='usrname' value='$usrname'>
												<button class='btn waves-effect waves-orange' type='submit' name='action'>Profilo</button>
											</form>
										</td>";
								echo "</tr>";
							}
							echo '</table>';
							
							mysqli_close($con);
						}
					?>
	
					<br><br><br><a href="/site/home.php" id="back-button" class="btn-large waves-effect waves-light orange">Torna alla home</a><br><br><br>
						
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