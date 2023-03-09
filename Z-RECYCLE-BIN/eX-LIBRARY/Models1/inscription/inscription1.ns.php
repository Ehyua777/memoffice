<?php
namespace inscription1;
function checkPseudo($pseudo)
{
	global $db;
	$alert=0;
	$pseudoErr=NULL;
	$pseudoAlert=array();
	//Vérification du remplissage du pseudo
	if (empty($pseudo))
	{
		$alert++;
		$pseudoErr='Le remplissage du champ pseudo est obligatoire svp';
	}
	else
	{
		$configN='pseudo_maxsize';
		$pseudoMaxSise=\general\getConfigData($configN);
		//Vérification de la longuer du pseudo
		if (strlen($pseudo) < 5 || strlen($pseudo) > $pseudoMaxSise)
		{
			$alert++;
			$pseudoErr = 'Votre pseudo est soit trop grand, soit trop petit';
		}
		else
		{
			$query=$db->prepare('
			SELECT COUNT(*) AS nbr
			FROM mem_members
			WHERE member_pseudo =:pseudo
			');
			$query->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
			$query->execute() or die(print_r($db->errorInfo()));
			$pseudoFree=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			if(!$pseudoFree)
			{
				$alert++;
				$pseudoErr = 'Votre pseudo est déjà utilisé par un membre';
			}
		}
	}
	$pseudoAlert=array('alert' => $alert, 'error' => $pseudoErr);
	return $pseudoAlert;
}

//Vérification du mdp
function checkPasword($pw1, $pw2)
{
	$alert=0;
	$pwErr=NULL;
	$pwAlert=array();
	if (empty($pw1) && empty($pw2))
	{
		$alert++;
		$pwErr='Svp, le mot de passe est obligatoire';
	}
	elseif (empty($pw1) || empty($pw2))
	{
		$alert++;
		$pwErr='Vous devez fournir un mot de passe et sa confirmation';
	}
	else
	{
		if ($pw1 != $pw2)
		{
			$alert++;
			$pwErr='Le mot de passe et sa confirmation sont différent';
		}
	}
	$pwAlert=array('alert' => $alert, 'error' => $pwErr);
	return $pwAlert;
}

//Vérification de la forme de l'email
function checkEmail($email)
{
	$alert=0;
	$emailErr=NULL;
	$emailAlert1=array();
	global $db;
	//L'email a t'il été fourni ?
	if (empty($email))
	{
		$alert++;
		$emailErr='L\'adress email est obligatoire svp';
	}
	else
	{
		//Vérification du format de l'email
		if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
		{
			$alert++;
			$emailErr='Votre adresse E-Mail n\'a pas un format valide';
		}
		else
		{
			//Il faut que l'adresse email n'ait jamais été utilisée
			$query=$db->prepare('
			SELECT COUNT(*) AS nbr
			FROM mem_members
			WHERE member_email =:email
			');
			$query->bindValue(':email', $email, \PDO::PARAM_STR);
			$query->execute() or die(print_r($db->errorInfo()));
			$emailFree=($query->fetchColumn()==0)?1:0;
			if(!$emailFree)
			{
				$alert++;
				$emailErr='Votre adresse email est déjà utilisée par un membre';
			}
		}
	}
	$emailAlert1=array('alert' => $alert, 'error' => $emailErr);
	return $emailAlert1;
}

//Vérification de l'avatar
function checkAvator()
{
	$alert=0;
	$avatorErr=NULL;
	$avatorAlert=array();
	if (!empty($_FILES))
	{
		//Récupération des variables de configuration
		$configN='avator_max_size';
		$maxsize=\genaral\getConfigData($configN);
		$configN='avator_max_height';
		$maxheight=\genaral\getConfigData($configN);//Longueur de l'image
		$configN='avator_max_width';
		$maxwidth=\genaral\getConfigData($configN);//Largeur de l'image
		//Vérification de l'avatar :
		if (!empty($_FILES['avator']['size']))//On définit les variables :
		{
			//Liste des extensions valides
			$validExtensions=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
			if ($_FILES['avator']['error'] > 0)
			{
				$alert++;
				$avatorErr='Erreur lors du transfert de l\'avatar';
			}
			if ($_FILES['avator']['size'] > $maxsize)
			{
				$alert++;
				$avatorErr='Le fichier est trop gros : 
				(<strong>'.$_FILES['avator']['size'].'Octets</strong> contre <strong>'.
				$maxsize.' Octets</strong>)';
			}
			$imageSizes=getimagesize($_FILES['avator']['tmp_name']);
			if ($imageSizes[0] > $maxwidth || $imageSizes[1] > $maxheight)
			{
				$alert++;
				$avatorErr='Image trop large ou trop longue :(<strong>'.$imageSizes[0].
				'x'.$imageSizes[1].'</strong> contre <strong>'.$maxwidth.'x'.$maxheight.'
				</strong>)';
			}
			$extensionUpload=strtolower(substr(strrchr($_FILES['avator']['name'], '.') ,1
			));
			if (!in_array($extensionUpload, $validExtensions))
			{
				$alert++;
				$avatorErr='Extension de l\'avatar incorrecte';
			}
		}
		else
		{
			$alert++;
			$avatorErr='Fichier invalide';
		}
		
	}
	$avatorAlert=array('alert' => $alert, 'error' => $avatorErr);
	return $avatorAlert;
}

//Vérification de la signature
function strlenSignature($signature)
{
	$alert=0;
	$signatureAlert=array();
	$signatureErr=NULL;
	$configN='signature_max_length';
	$signatureMaxLen=\general\getConfigData($configN);
	if (!empty($signature) && strlen($signature) > $signatureMaxLen)
	{
		$alert++;
		$signatureErr='Signature trop longue';
	}
	$signatureAlert=array('alert' => $alert, 'error' => $signatureErr);
	return $signatureAlert;
}