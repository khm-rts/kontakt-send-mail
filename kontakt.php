<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kontaktformular</title>
</head>

<body>
    <h2>Kontakt</h2>
    <?php
    // Standardværdier til kontaktformular
    $kontakt_navn	= '';
    $kontakt_email	= '';
    $kontakt_emne	= '';
    $kontakt_besked	= '';
    
    
    // Hvis form er sendt køres dette kode
    if ( isset($_POST['kontakt']) )
    {
    	// Overskriver værdier til kontaktformular, så hvis validering fejler, gemmes input
        $kontakt_navn	= $_POST['navn'];
        $kontakt_email	= $_POST['email'];
        $kontakt_emne	= $_POST['emne'];
        $kontakt_besked	= $_POST['besked'];
        
        // Hvis en af felterne er tomme udskrives fejl
        if ( empty($kontakt_navn) || empty($kontakt_email) || empty($kontakt_emne)  || empty($kontakt_besked) )
        {
            echo '<p>Fejl! Ikke alle felter er udfyldt</p>';
        }
        // Ellers kan vi sende e-mail
        else
        {
            $modtager	 = 'modtager@email.dk';
            // For at sende HTML e-mail, skal bl.a. Content-Type og charset defineres i header
            $headers	 = "MIME-Version: 1.0 \r\n";
            $headers	.= "Content-Type: text/html; charset=UTF-8 \r\n";
            
            // Yderligere headers, hvor bl.a. afsender af e-mail angives
            //$headers	.= "To: Mary <mary@example.com>, Kelly <kelly@example.com>\r\n";
            $headers	.= "From: $kontakt_navn <$kontakt_email> \r\n";
            //$headers	.= "Cc: birthdayarchive@example.com \r\n";
            //$headers	.= "Bcc: birthdaycheck@example.com \r\n";
            
            // Send mail vha. funktionen mail() og hvis det lykkedes vises besked
            if ( mail($modtager, $kontakt_emne, $kontakt_besked, $headers) )
            {
            	// Vis besked til bruger om at e-mailen er afsendt
				//echo '<p>Tak for din henvendelse. Vi vil svare hurtigst muligt!</p>';
			}
			// Hvis ikke det lykkedes at sende e-mail, vises fejlbesked
			else
			{
				// Vis besked til bruger om at e-mailen er afsendt
				echo '<p>Din e-mail kunne ikke afsendes. Prøv venligst igen, eller kontakt os på anden vis!</p>';
			}
        }
    }
    ?>
    
    <form method="post">
		<p>
			<label for="navn">Navn:</label><br>
			<input type="text" name="navn" id="navn" placeholder="For- og efternavn" required autofocus value="<?php echo $kontakt_navn ?>">
		</p>

		<p>
			<label for="email" >E-mailadresse:</label><br>
			<input type="email" name="email" id="email" placeholder="example@domain.com" required value="<?php echo $kontakt_email ?>">
		</p>

		<p>
			<label for="emne">Emne:</label><br>
			<input type="text" name="emne" id="emne" required value="<?php echo $kontakt_emne ?>">
		</p>

		<p>
			<label for="kontakt_besked">Besked:</label><br>
			<textarea rows="4" name="besked" id="kontakt_besked" required><?php echo $kontakt_besked ?></textarea>
		</p>

		<button type="submit" name="kontakt">Send</button>
		<button type="reset">Nulstil</button>
	</form>
</body>
</html>