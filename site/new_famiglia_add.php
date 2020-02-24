<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$username = $_SESSION["login_user"];
	$id_apiario = $_REQUEST["id_apiario"];
?>

<html>
	<head>
		<title>Famiglia aggiunta</title>
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
					<h1 class='header orange-text'></h1>
					
					<h5 class='header col s12 light'></h5>
					
					<?php
						$nomeDB ="localhost";
						$user = "beekeeperunibg";
						$psw = "";
						$database = "my_beekeeperunibg";
						
						$con = mysqli_connect($nomeDB,$user,$psw,$database);
						if(mysqli_connect_errno()) die ("Errore di connessione");
						else
						{							
							if(!empty($_POST))
							{
								if(!empty($_REQUEST['nome']) && !empty($_REQUEST['numero_favi']))
								{
									$nome=$_REQUEST['nome'];
									$numero_favi=$_REQUEST['numero_favi'];
									
									$query2 = mysqli_query($con,"INSERT INTO famiglie (nome, numero_favi, id_apiario) VALUES ('$nome',$numero_favi,$id_apiario)"); 
									if($query2)
									{
										echo "<h1 class='header orange-text'>Aggiunta confermata</h1>";
										echo "<br><br><h5 class='header col s12 light'>La nuova famiglia è stata inserita nell'apiario correntemente aperto</h5>";
									}
									else
									{
										echo "<h1 class='header orange-text'>Aggiunta errata</h1>";
										echo "<br><br><h5 class='header col s12 light'>La nuova famiglia non è stata inserita</h5>";
									}
								}
								else
								{
									echo "<h1 class='header orange-text'>Aggiunta impossibile</h1>";
									echo "<br><br><h5 class='header col s12 light'>La nuova famiglia non è stata inserita perchè non tutti i campi sono stati compilati</h5>";
								}
							}
						}
						mysqli_close($con);
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