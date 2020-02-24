<?php
	session_start();
	$ruolo_login = $_SESSION["role"];
	
	$nomeDB ="localhost";
	$user = "beekeeperunibg";
	$psw = "";
	$database = "my_beekeeperunibg";
	
	$con = mysqli_connect($nomeDB,$user,$psw,$database);
	if(mysqli_connect_errno()) die ("Errore di connessione");
	else
	{
		if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['residence']) && !empty($_POST['birthday']) && !empty($_POST['num_tel']))
		{
			$name=$_POST['name'];
			$surname=$_POST['surname'];
			$residence=$_POST['residence'];
			$birthday=$_POST['birthday'];
			$num_tel=$_POST['num_tel'];
			
			$username = $_SESSION["login_user"];
			
			mysqli_query($con, "begin");
			
			$query1 = mysqli_query($con, "UPDATE users SET nome='$name', cognome='$surname', residenza='$residence', data_nascita='$birthday', num_tel='$num_tel'  WHERE user='$username'");
			if($query1)
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
		}
		else
		{
			echo "<br>Compilare tutti i campi";
		}
	}
	mysqli_close($con);
	header('Location: /site/profile.php');
?>