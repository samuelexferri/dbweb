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
		$sql0 = "SELECT id_miele, quantita FROM prenotazioni WHERE id_prenotazione=$id_prenotazione";
		$query0 = mysqli_query($con, $sql0);
		$row = mysqli_fetch_assoc($query0);
		$quantita = $row['quantita'];
		$id_miele = $row['id_miele'];
		
		
		// Trovare disponibilita precedente
		$sql1 = "SELECT disponibilita FROM miele WHERE id_miele = $id_miele";
		$query1 = mysqli_query($con, $sql1);
		$row = mysqli_fetch_assoc($query1);
		$disponibilita = $row['disponibilita'];
		
		$new_disp = $disponibilita + $quantita;
		
		
		// Inizio transazione
		mysqli_query($con, "begin");
		
		// Aggiornare i kg disponibili di miele
		$sql2 = "UPDATE miele SET disponibilita = $new_disp WHERE id_miele = $id_miele";
		$query2 = mysqli_query($con, $sql2);
	
		// Eliminare la prenotazione
		$sql3 = "DELETE FROM prenotazioni WHERE id_prenotazione=$id_prenotazione";
		$query3 = mysqli_query($con, $sql3);
		
		
		if($query3 && $query2)
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