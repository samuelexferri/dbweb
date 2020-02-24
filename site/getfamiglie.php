<?php
	$nomeDB ="localhost";
	$user = "beekeeperunibg";
	$psw = "";
	$database = "my_beekeeperunibg";
	
	$id_apiario = $_REQUEST['q'];
	
	$con = mysqli_connect($nomeDB,$user,$psw,$database);
	if(!$con) 
		die ("Errore di connessione");
	else
	{
		//$query = mysqli_query($con, "SELECT luogo, altitudine, users.nome, cognome, nome_miele, disponibilita, id_famiglia, famiglia.nome FROM apiari INNER JOIN users ON id_venditore = id_user INNER JOIN famiglie ON famiglie.id_apiario = id_apiario INNER JOIN miele ON miele_prodotto = id_miele INNER JOIN tipi_miele ON id_tipo_miele = miele.id_tipo_miele WHERE id_apiario='$id_apiario'");
		$query = mysqli_query($con, "SELECT luogo, altitudine, nome, cognome FROM apiari INNER JOIN users ON id_venditore = id_user WHERE id_apiario='$id_apiario'");
		$apiario=mysqli_fetch_assoc($query);
		
		echo "Luogo: " . $apiario['luogo'] . "<br>Altitudine: " . $apiario['altitudine'] . "<br>Proprietario: " . $apiario['nome'] . " " . $apiario['cognome'] . "<br>";
		
		$query2 = mysqli_query($con, "SELECT nome_miele FROM tipo_miele INNER JOIN miele ON tipo_miele.id_tipo_miele = miele.id_tipo_miele INNER JOIN apiari ON miele.id_miele = apiari.id_miele WHERE apiari.id_apiario='$id_apiario'");
		$miele=mysqli_fetch_assoc($query2);
		
		echo "Miele prodotto: " . $miele['nome_miele'] . "<br><br>";
		
		
		
		$query3 = mysqli_query($con, "SELECT nome, id_famiglia FROM famiglie INNER JOIN apiari ON famiglie.id_apiario = apiari.id_apiario WHERE apiari.id_apiario='$id_apiario'");
	}
	
	$_REQUEST[
	
	echo "
	<form method='get' action = 'vedere_famiglia.php'>
			<select name='famiglia' id='famiglia'>";
				while($famiglie=mysqli_fetch_assoc($query3)) 
				{ 
					echo "<option value=" . $famiglie['id_famiglia']  . "> ". $famiglie['nome'] . "</option>";
				} 
			echo "
			</select>
			
			<input type = 'submit' value = 'Vedi la famiglia selezionata'>
		</form>";
?>