<?php
	echo "<nav  role='navigation'>
			<div class='nav-wrapper container'>
				<ul class='left hide-on-med-and-down'>";
					echo 
					"<li><a href='/site/home.php'>Home</a></li>";
					if (strcmp ($ruolo_login, "venditore") == 0) 
					{
						echo "<li><a href='/site/vedi_apiario.php'>Gestione apiari</a></li>";
						echo "<li><a href='/site/vedi_miele.php'>Miele venduto</a></li>";
					}
					
					if (strcmp ($ruolo_login, "cliente") == 0 || strcmp ($ruolo_login, "admin") == 0) 
					{
						echo "<li><a href='/site/vedi_venditori.php'>Venditori</a></li>";
					}
					
					if (strcmp ($ruolo_login, "admin") == 0) 
					{
						echo "<li><a href='/site/vedi_apiario.php'>Gestione apiari</a></li>";
						echo "<li><a href='/site/elenco.php'>Elenco utenti</a></li>";
					}
								
					echo			
								"<li><a href='/site/vedi_prenotazioni.php'>Prenotazioni</a></li>
								<li><a href='/site/profile.php'>Modifica profilo</a></li>
								<li><a href='/site/index.php'>Logout</a></li>
				</ul>
			</div>
	</nav>";
?>