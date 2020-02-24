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
			if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['birthday']) && !empty($_POST['residence']) && !empty($_POST['num_tel']))
			{
				$username=$_POST['username'];
				$password=$_POST['password'];
				$password=crypt($password,"nosaltincluded");
				$name=$_POST['name'];
				$surname=$_POST['surname'];
				$birthday=$_POST['birthday'];
				$residence=$_POST['residence'];
				$num_tel=$_POST['num_tel'];
				
				$controllo = mysqli_query($con,"SELECT user from users WHERE user='$username'");
				$rows = mysqli_num_rows($controllo);
				if ($rows == 1) die ("<br />Utente gia' esistente");
				else
				{
					$query = mysqli_query($con,"INSERT INTO users (user, password, nome, cognome, data_nascita, residenza, num_tel) VALUES ('$username','$password','$name','$surname','$birthday','$residence','$num_tel');"); 
					if($query)
					{
						$last_id = $con->insert_id;
						
						mysqli_query($con, "begin");
						
						$query2 = mysqli_query($con,"INSERT INTO cliente (id_cliente, kg_comprati_tot) VALUES ($last_id,0);"); 
						if($query2)
						{
							$commit = "commit";
							$querylog = "&nbsp&nbspModifica effettuata!";
						}
						else
						{
							$commit = "rollback";
							$querylog = "errore nella query: " . $query . " : " . mysqli_error($con) . "";
						}
						mysqli_query($con,$commit);
					}
					else
						echo "<br />Errore";
				}
			}
		}
	}
	mysqli_close($con);
	header("location: index.php");
?>