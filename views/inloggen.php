<?php
    if (isset($_POST['gebruikersnaam']) && isset($_POST['wachtwoord'])):
        $_SESSION['loggedin'] = true;
		GaNaarPagina("beheer");
    else:
		$_SESSION['loggedin'] = false;
    endif;
?>

<div class="row">
	<div class="col-lg-6">
		<h1>Inloggen...</h1>
		<form action="<?php echo SITELINK . "inloggen" ?>" method="post">
			<label for="gebruikersnaam">Gebruikersnaam</label>
			<input type="text" id="gebruikersnaam" name="gebruikersnaam"><br>
			<label for="wachtwoord">Wachtwoord</label>
			<input type="password" id="wachtwoord" name="wachtwoord"><br>
            <input type="submit" class="btn-primary" value="Inloggen">
		</form>
	</div>
</div>
