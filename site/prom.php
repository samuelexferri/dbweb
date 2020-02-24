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
		$usrname = $_REQUEST['usrname'];
		$sql = "SELECT id_user FROM users WHERE user='$usrname'";
		$query = mysqli_query($con, $sql);
		$userid = mysqli_fetch_assoc($query);
		
		$usrid = $userid['id_user'];
		
		$sql1 = "DELETE FROM cliente WHERE id_cliente=$usrid";
		$sql2 = "INSERT INTO venditore VALUES ($usrid, 0)";
		
		mysqli_query($con, "begin");
		
		echo $sql1;
		echo $sql2;
		$query1 = mysqli_query($con, $sql1);
		$query2 = mysqli_query($con, $sql2);
		
		if($query1 && $query2)
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
		
		header('Location: /site/elenco.php');
	}
?>