<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	$id_famiglia = $_REQUEST['id_famiglia'];
	$id_apiario = $_REQUEST['id_apiario'];
?>
		
<html>
	<head>
		<title>Nuovo report periodico</title>
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
					<h1 class='header orange-text'>Nuovo report periodico</h1>
					<form action="new_history_mese_add.php" method="post" onsubmit="return check();">
						
						</select>
						<h5 class='header col s12 light'>Data:</h5> <input type="date" name="data" id="data">
						<h5 class='header col s12 light'>Numero di favi di covata:</h5> <input type="text" name="num_covata" id="num_covata">
						<h5 class='header col s12 light'>Salute della cassa:</h5>
						<br>
						
						<select name="in_salute" id="in_salute">
							<option value="" disabled selected>Indicare lo stato di salute</option>
							<option value="1">In salute</option>
							<option value="0">Non in salute</option>
						</select>
						
						<select name="cibato" id="cibato">
							<option value="" disabled selected>Indicare la situazione del cibo</option>
							<option value="1">Cibata</option>
							<option value="0">Non cibata</option>
						</select>
							
						<br><br>
						<h5 class='header col s12 light'>Informazioni aggiuntive:</h5> <input type="text" name="info_agg" id="info_agg">
						<br>
						<input type="hidden" name="id_famiglia" value="<?php echo $id_famiglia; ?>">
						<input type="hidden" name="id_apiario" value="<?php echo $id_apiario; ?>">
						<button class="btn waves-effect waves-light" type="submit" name="action">Invia</button>
					</form>
					<?php
						echo '<br><br><br><a href="/site/vedere_famiglia.php?id_famiglia='.$id_famiglia.'&id_apiario='.$id_apiario.'" id="back-button" class="btn-large waves-effect waves-light orange">Torna indietro</a><br><br><br>';
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