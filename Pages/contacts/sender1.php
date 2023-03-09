<?php
// pour me poster un e-mail
$to = 'lumbrera.ehyua@gmail.com'; //mon e-mail
$subject = 'Merci !!';
$message = '<html>
<head>
<title>J\'vous kiffe de trop :D</title>
</head>
<body>
<p>Loin de moi l\'envie fortuite de vous importuner avec mes<br/>
discours aussi inutiles qu\'endormants, mais je trouve que vous
êtes<br/>
tout simplement génial !!</p>
<p>I love you !! (De tout mon body).</p>
</body>
</html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// En-têtes additionnels
$headers .= 'From: "Nom du destinateur" <contact@supersite.com>'."\r\n";
$headers .= 'Cc: "Contact" <contact@supersite.com>' . "\r\n";
$headers .= 'Bcc: "Contact" <contact@supersite.com>' . "\r\n";
$headers .= 'Reply-To: "Moi même" <lumbrera.ehyua@gmail.com>' . "\r\n";
$mail = mail($to, $subject, $message, $headers); //marche
if($mail) echo 'Votre message à bien été pasté.';
else echo 'AhÏÏ! Petit problème, veuillez reespédier votre message svp.';
?>