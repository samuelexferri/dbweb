<?php
	session_start();
	$username = $_SESSION["login_user"];
	$ruolo_login = $_SESSION["role"];
?>
		
<html>
	<head>
		<title>Home</title>
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
					<br><br>
					<?php
						echo "<h1 class='header center amber-text'>Benvenuto, ".$username."</h1>"
					?>
					<div class="row">
						<?php
							if (strcmp ($ruolo_login, "venditore") == 0)
							{
								echo "<br><br><h5 class='header col s12 center'>Venditore: puoi gestire i tuoi apiari e arnie, creare report annuali e mensili, <br>
								gestire il miele messo in vendita e vedere le prenotazioni degli utenti</h5>";
								echo '<br><br><br><br><br><br><br><br>
								<div class="row center">
									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/vedi_apiario.php" class="btn-large waves-effect orange">Gestione apiari</a>
										</div>
									</div>
									
									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/vedi_miele.php" class="btn-large waves-effect orange">Gestione miele</a>
										</div>
									</div>
									
									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/vedi_prenotazioni.php" class="btn-large waves-effect orange">Gestione prenotazioni</a>
										</div>
									</div>
								</div>';
							}
							if (strcmp ($ruolo_login, "cliente") == 0)
							{
								echo "<br><br><h5 class='header col s12 center'>Cliente: puoi vedere la lista dei venditori, prenotare del miele <br>
								e vedere tutte le prenotazioni attive e completate</h5>";
								echo '<br><br><br><br><br><br><br><br>
								<div class="row center">
									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/vedi_venditori.php" class="btn-large waves-effect orange">Venditori</a>
										</div>
									</div>

									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/vedi_prenotazioni.php" class="btn-large waves-effect orange">Gestione prenotazioni</a>
										</div>
									</div>

									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/profile.php" class="btn-large waves-effect orange">Modifica profilo</a>
										</div>
									</div>

								</div>';
							}
							if (strcmp ($ruolo_login, "admin") == 0)
							{
								echo "<br><br><h5 class='header col s12 center'>Admin: hai accesso a tutte le informazioni presenti sul sito</h5>";
								echo '<br><br><br><br><br><br><br><br>
								<div class="row center">
									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/vedi_venditori.php" class="btn-large waves-effect orange">Venditori</a>
										</div>
									</div>

									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/vedi_prenotazioni.php" class="btn-large waves-effect orange">Gestione prenotazioni</a>
										</div>
									</div>

									<div class="col s12 m4">
										<div class="icon-block">
											<a href="/site/profile.php" class="btn-large waves-effect orange">Modifica profilo</a>
										</div>
									</div>

								</div>';
							}
						?>
					</div>
					
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