<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	
	$nomeDB ="localhost";
	$user = "beekeeperunibg";
	$psw = "";
	$database = "my_beekeeperunibg";
	
	$con = mysqli_connect($nomeDB,$user,$psw,$database);
	if(!$con) die ("Errore di connessione");
	else
	{
		echo "Connessione al DB stabilita<br><br><br>";
		
		$id_prenotazione = $_REQUEST['id_prenotazione'];
		
		// Dati prenotazione
		$sql0 = "SELECT id_cliente, id_miele, quantita FROM prenotazioni WHERE id_prenotazione=$id_prenotazione";
		$query01 = mysqli_query($con, $sql0);
		$row = mysqli_fetch_assoc($query01);
		$id_cliente = $row['id_cliente'];
		$id_miele = $row['id_miele'];
		$quantita = $row['quantita'];
		
		$sql0 = "SELECT id_venditore FROM miele WHERE id_miele=$id_miele";
		$query02 = mysqli_query($con, $sql0);
		$row = mysqli_fetch_assoc($query02);
		$id_venditore = $row['id_venditore'];
		
		
		// Trovare i kg comprati tot del cliente
		$sql1 = "SELECT kg_comprati_tot FROM cliente WHERE id_cliente = $id_cliente";
		echo $sql1;echo "<br>";echo "<br>";
		$query1 =mysqli_query($con, $sql1);
		$row = mysqli_fetch_assoc($query1);
		$kg_comprati_tot = $row['kg_comprati_tot'];
		$new_kg_comprati = $kg_comprati_tot + $quantita;
		
		
		// Trovare i kg venduti tot del venditore
		$sql2 = "SELECT kg_venduti_tot FROM venditore WHERE id_venditore = $id_venditore";
		echo $sql2;echo "<br>";echo "<br>";
		$query2 =mysqli_query($con, $sql2);
		$row = mysqli_fetch_assoc($query2);
		$kg_venduti_tot = $row['kg_venduti_tot'];
		$new_kg_venduti = $kg_venduti_tot + $quantita;
		
		
		// Aggiornare i kg comprati del cliente
		$sql3 = "
		UPDATE cliente 
		SET kg_comprati_tot = $new_kg_comprati 
		WHERE id_cliente = $id_cliente";
		echo $sql3;echo "<br>";echo "<br>";
		
		
		// Aggiornare i kg venduti del venditore
		$sql4 = "
		UPDATE venditore 
		SET kg_venduti_tot = $new_kg_venduti 
		WHERE id_venditore = $id_venditore";
		echo $sql4;echo "<br>";echo "<br>";
		
		
		// Aggiornare la prenotazione
		$sql5 = "UPDATE prenotazioni SET confermata=1 WHERE id_prenotazione=$id_prenotazione";
		$query5 = mysqli_query($con, $sql5);
		
		$query3 = mysqli_query($con, $sql3);
		$query4 = mysqli_query($con, $sql4);
		
		if($query3 && $query4 && $query5)
		{
			echo "<br />Aggiornamento avvenuto con successo";
			$commit = "commit";
		}
		else
		{
			echo "<br />Errore";
			$commit = "rollback";
		}
		mysqli_query($con,$commit);
		
		mysqli_close($con);
		header('Location: /site/vedi_prenotazioni.php');
	}
?>