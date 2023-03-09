<?php
namespace newsletterFront1; 
function newsletterSignMail($email, $object, $message, $alert)
{
	$configN='admin_email';
	$sender=getConfigData($configN);
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: $sender' . "\r\n";
	if(mail($email, $object, $message, $headers))
	{
		return $alert;
	}
	else
	{
		return 'Il y a eu une erreur lors de l\'envoi du mail pour votre inscription.'; 
	}
}

//Demande d'inscription ou de désinscription à la newsletter
function newsletterSign($email, $new)
{
	if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
	{
		if ($new==0)
		{
			$message = 'Pour valider votre désinscription de la newsletter de guyro.net, 
			<a href="http://www.guyro.net/newsletter/?nla='.$new.'&amp;true='.$email.'">
			cliquez ici</a>.';
			$object ='Désinscription de la newsletter de guyro.net';
			$alert='Pour valider votre désinscription, veuillez cliquer sur le lien 
			dans l\'e-mail que nous venons de vous envoyer.';
			$mail=newsletterSignMail($email, $object, $message, $alert);
		}
		elseif ($new==1)
		{
			$message='Pour valider votre inscription à la newsletter de guyro.net, 
			<a href="http://www.guyro.net/newsletter/?nla='.$new.'&amp;true='.$email.'">
			cliquez ici</a>';
			$object='Inscription à la newsletter de guyro.net';
			$alert='Pour valider votre inscription, veuillez cliquer sur le lien dans 
			l\'e-mail que nous venons de vous envoyer.';
			$mail=newsletterSignMail($email, $object, $message, $alert);	
		}
		else
		{
			error(ERR_ALERT);
		}
	}
	else
	{
		return 'Votre email n\'a pas un format valide';
	}
}

//Enregistrement ou supression de l'email du souscrivant
function newsletterEmailManager($sessionEmail, $okEmail, $nla)
{
	global $db;
	// Si les deux adresses e-mail sont identiques.
	if($okEmail==$sessionEmail)
	{
		if ($nla==0)
		{
			$valid=0;
			$query=$db->prepare('
			UPDATE mem_newsletter_emails
			SET email_valid = :valid
			WHERE email_email = :email
			');
			$query->bindValue(':valid', $nla, \PDO::PARAM_INT);
			$query->bindValue(':email', $sessionEmail, \PDO::PARAM_STR);
			$query->execute() or die(print_r($db->errorInfo()));
			return 'Votre abonnement à la newsletter de guyro.net a bien été suspendu.';
		}
		elseif ($nla==1)
		{
			// On l'inscrit dans la base de données MySQL
			$query=$db->prepare('
			INSERT INTO mem_newsletter_emails (email_email)
			VALUES (:email)
			');
			$query->bindValue(':email', $sessionEmail, \PDO::PARAM_STR);
			$query->execute() or die(print_r($db->errorInfo()));
			return 'Vous avez bien été inscrit à la newsletter de guyro.net ! Vous allez 
			être redirigé dans 1 seconde.';
		}
		else
		{
			error(ERR_AUTH_VIEW);
		}
	}
	else
	{
		return 'Vous n\'avez pas entré la bonne adresse e-mail !';
	}
}