<?php
namespace inscription2;
function inscription($pseudo, $pw1, $email, $signature, $filename, $temps)
{
	global $db;
	$pseudo=stripslashes(htmlspecialchars($pseudo));
	$signature=stripslashes(htmlspecialchars($signature));
	if (empty($filename))
	{
		$configN='default_avator';
		$filename=\general\getConfigData($configN);
	}
	$query=$db->prepare('
	INSERT INTO mem_members (member_pseudo, member_pw, member_email, member_signature, 
	member_image, member_lvdate)
	VALUES (:pseudo, :pw, :email, :signature, :image, :temps)
	');
	$query->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
	$query->bindValue(':pw', $pw1, \PDO::PARAM_INT);
	$query->bindValue(':email', $email, \PDO::PARAM_STR);
	$query->bindValue(':signature', $signature, \PDO::PARAM_STR);
	$query->bindValue(':image', $filename, \PDO::PARAM_STR);
	$query->bindValue(':temps', $temps, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	//Et on définit les variables de sessions
	$_SESSION['id'] = $db->lastInsertId();
	$_SESSION['pseudo'] = $pseudo;
	$_SESSION['level'] = 2;
	if (!empty($_SESSION['pseudo']))
	{
		header('location:'.ROOTPATH.'/?msg=1');
	}
}

//Email d'inscription
function inscription_mail($email, $pseudo, $passe)
{
	$to = $email;
	$subject = 'Inscription sur '.APPTITLE.' - '.$pseudo;
	$message = '
	<html>
	<head>
	<title>'.APPTITLE.'</title>
	</head>
	<body>
	<div>Bienvenue sur '.APPTITLE.' !<br/>
	Vous avez complété une inscription avec le pseudo'.htmlspecialchars($pseudo, 
	ENT_QUOTES).' à l\'instant.<br/>
	Votre mot de passe est : '.htmlspecialchars($passe, ENT_QUOTES).'.<br/>
	Veillez à le garder secret et à ne pas l\'oublier.<br/><br/>
	En vous remerciant.<br/><br/>
	Moi - Wembaster de '.APPTITLE.'
	</body>
	</html>';
}