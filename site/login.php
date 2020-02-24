<?php
	$nomeDB ="localhost";
	$user = "beekeeperunibg";
	$psw = "";
	$database = "my_beekeeperunibg";
	
	$con = mysqli_connect($nomeDB,$user,$psw,$database);
	if(mysqli_connect_errno()) die ("Errore di connessione.");
	else
	{
		if(!empty($_POST))
		{
			if(!empty($_POST['username']) && !empty($_POST['password']))
			{
				$username=$_POST['username'];
				$password=$_POST['password'];
				$password=crypt($password,"nosaltincluded");
				$query = mysqli_query($con, "SELECT id_user FROM users WHERE password='$password' AND user='$username'");
				$rows = mysqli_num_rows($query);
				if ($rows == 1) 
				{
					$curr_user=mysqli_fetch_assoc($query);
					$id_curr = $curr_user["id_user"];
					
					$query2 = mysqli_query($con, "SELECT id_user FROM users INNER JOIN admin ON users.id_user = admin.id_admin WHERE users.id_user = '$id_curr' ");
					$rows = mysqli_num_rows($query2);
					if ($rows == 1)
					{
						$role = "admin";
					}	
					else
					{
						$query3 = mysqli_query($con, "SELECT id_user FROM users INNER JOIN venditore ON users.id_user = venditore.id_venditore WHERE users.id_user = '$id_curr'");
						$rows = mysqli_num_rows($query3);
						if ($rows == 1) 
							$role = "venditore";
						else
							$role = "cliente";
					}
					session_start();
					$_SESSION["login_user"]=$username; // Nuova sessione
					$_SESSION["role"]=$role;
					echo "<br />Login avvenuto con successo";
					header("location: home.php");
				} 
				else 
				{
					echo "<br />Errore: Utente non trovato";
				}
			}
		}
	}
	mysqli_close($con);
?>