<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
?>
		
<html>
	<head>
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
					<h1 class='header orange-text'></h1>
					
					<h5 class='header col s12 light'></h5>
					
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
							$usrname = $_REQUEST['usrname'];
							
							$sql1 = "SELECT id_user FROM users INNER JOIN cliente ON id_cliente = id_user WHERE user = '$usrname'";
							$sql2 = "SELECT id_user FROM users INNER JOIN venditore ON id_venditore = id_user WHERE user = '$usrname'";
							$sql3 = "SELECT id_user FROM users INNER JOIN admin ON id_admin = id_user WHERE user = '$usrname'";
												
							$query1 = mysqli_query($con, $sql1);
							$query2 = mysqli_query($con, $sql2);
							$query3 = mysqli_query($con, $sql3);
							
							if (mysqli_num_rows($query1)==1)
							{
								$cliente = mysqli_fetch_assoc($query1);
								echo "<h5>CLIENTE<br></h5>";
								$user_id = $cliente['id_user'];
								
								$sqlc = "SELECT user, nome, cognome, data_nascita, residenza, num_tel, kg_comprati_tot FROM users INNER JOIN cliente ON id_cliente = id_user WHERE id_user = $user_id";
								$queryc = mysqli_query($con, $sqlc);
								
								$cliente = mysqli_fetch_assoc($queryc);
								echo "<h7>";
									echo "Username: ". $cliente['user'] . "<br>";
									echo "Nome: ". $cliente['nome'] . "<br>";
									echo "Cognome: ". $cliente['cognome'] . "<br>";
									echo "Data di nascita: ". $cliente['data_nascita'] . "<br>";
									echo "Residenza: ". $cliente['residenza'] . "<br>";
									echo "Numero telefonico: ". $cliente['num_tel'] . "<br>";
									echo "Kg comprati: ". $cliente['kg_comprati_tot'] . "<br>";
								echo "</h7>";
							}
							else if (mysqli_num_rows($query2)==1)
							{
								$venditore = mysqli_fetch_assoc($query2);
								echo "<h5>VENDITORE<br></h5>";
								$user_id = $venditore['id_user'];
								
								$sqlv = "SELECT user, nome, cognome, data_nascita, residenza, num_tel, kg_venduti_tot FROM users INNER JOIN venditore ON id_venditore = id_user WHERE id_user = $user_id";
								$queryv = mysqli_query($con, $sqlv);
								
								$venditore = mysqli_fetch_assoc($queryv);
								
								echo "<h7>";
									echo "Username: ". $venditore['user'] . "<br>";
									echo "Nome: ". $venditore['nome'] . "<br>";
									echo "Cognome: ". $venditore['cognome'] . "<br>";
									echo "Data di nascita: ". $venditore['data_nascita'] . "<br>";
									echo "Residenza: ". $venditore['residenza'] . "<br>";
									echo "Numero telefonico: ". $venditore['num_tel'] . "<br>";
									echo "Kg venduti: ". $venditore['kg_venduti_tot'] . "<br>";
								echo "</h7>";
							}
							else
							{
								$admin = mysqli_fetch_assoc($query3);
								echo "<h5>ADMIN<br></h5>";
								$user_id = $admin['id_user'];
								
								$sqla = "SELECT user, nome, cognome, data_nascita, residenza, num_tel FROM users WHERE id_user = $user_id";
								$querya = mysqli_query($con, $sqla);
								
								$admin = mysqli_fetch_assoc($querya);
								
								echo "<h7>";
									echo "Username: ". $admin['user'] . "<br>";
									echo "Nome: ". $admin['nome'] . "<br>";
									echo "Cognome: ". $admin['cognome'] . "<br>";
									echo "Data di nascita: ". $admin['data_nascita'] . "<br>";
									echo "Residenza: ". $admin['residenza'] . "<br>";
									echo "Numero telefonico: ". $admin['num_tel'] . "<br>";
								echo "</h7>";
							}
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