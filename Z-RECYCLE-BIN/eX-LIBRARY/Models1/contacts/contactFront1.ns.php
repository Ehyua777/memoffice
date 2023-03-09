<?php
namespace contactFront1;
//Vérification de l'email du contact
function checkContactEmail($email)
{
	$alert=0;
	$emailErr=NULL;
	$contactEmailAlert=array();
	if (empty($email))
	{
		$alert++;
		$emailErr='Vous n\'avez pas remplis le champ e-mail.';			
	}
	if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
	{
		$alert++;
		$emailErr='E-mail pas valid!';
	}
	$contactEmailAlert=array('alert' => $alert, 'error' => $emailErr);
	return $contactEmailAlert;
}

//Vérification des autre informations du formulaire de contact
function checkContactPosts($pseudo, $subject, $message)
{
	$alert=0;
	$contactErr=NULL;
	$pseudoErr=NULL;
	$subjectErr=NULL;
	$messageErr=NULL;
	$contactAlert=array();
	if (empty($pseudo))
	{
		$alert++;
		$pseudoErr='Vous n\'avez pas remplis le champ du pseudo.';
	}
	if (empty($subject))
	{
		$alert++;
		$subjectErr='Vous n\'avez pas remplis le champ du sujet.';
	}
	if (empty($message))
	{
		$alert++;
		$messageErr='Vous n\'avez pas remplis le champ du message.';
	}
	$contactAlert=array(
	'alert' => $alert,
	'perro' => $pseudoErr,
	'serro' => $subjectErr,
	'merro' => $messageErr
	);
	return $contactAlert;
}
	
//envoyer le mail
function contactMail($teste, $subject, $message, $pseudo, $email)
{
	global $db;
	if (empty($teste))
	{
		if (!empty($subject) && !empty($subject) && !empty($email))
		{
			$configN='contact_email';
			$addrressee=\general\getConfigData($configN);
			$mailTo = $addrressee;
			$mailSubject = stripslashes(htmlspecialchars($subject));
			$mailMessage = stripslashes(htmlspecialchars($message));
			$mailSender = stripslashes(htmlspecialchars($pseudo));
			$mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
			$mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$mailHeaders .= 'From: $pseudo' . "\r\n";
			$mailHeaders .= 'Reply-To: $email';
			if (mail($mailTo, $mailSubject, $mailMessage, $mailHeaders))
			{
				unset ($pseudo);
				unset ($email);
				unset ($message);
				$mailNote = 'Votre message nous est bien parvenu !';
			}
			else
			{
				$mailNote='Beurk! Une orreur est survenu, votre message n\'a donc  pas pu 
				etre...';
			}
		}
		else
		{
			$mailNote='Renplissez d\'abord le formulaire entièrement';
		}
	}
	else
	{
		//Le visiteur est informatiquement dangereu
	}
	return $mailNote;
}