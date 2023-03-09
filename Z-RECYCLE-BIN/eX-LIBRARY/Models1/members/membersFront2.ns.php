<?php
namespace membersFront2;
//Mise à jour du profile
function updateProfile($memberID, $fname, $name, $genre, $day, $month, $year, $bio, $loc, $site)
{
	global $db;
	$fname=htmlspecialchars($fname);
	$name=htmlspecialchars($name);
	$bio=htmlspecialchars($bio);
	$loc=htmlspecialchars($loc);
	$query=$db->prepare('
	UPDATE mem_members
	SET member_first_name=:fname, member_name=:name, member_genre=:genre, 
	member_birth_day=:day, member_birth_month=:month, member_birth_year=:year, 
	member_short_bio=:bio, member_localisation=:loc, member_website=:site
	WHERE member_id = :id
	');
	$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
	$query->bindValue(':fname', $fname, \PDO::PARAM_STR);
	$query->bindValue(':name', $name, \PDO::PARAM_STR);
	$query->bindValue(':genre', $genre, \PDO::PARAM_STR);
	$query->bindValue(':day', $day, \PDO::PARAM_STR);
	$query->bindValue(':month', $month, \PDO::PARAM_STR);
	$query->bindValue(':year', $year, \PDO::PARAM_STR);
	$query->bindValue(':bio', $bio, \PDO::PARAM_STR);
	$query->bindValue(':loc', $loc, \PDO::PARAM_STR);
	$query->bindValue(':site', $site, \PDO::PARAM_STR);
	$query->execute() or die(print_r($db->errorInfo()));
	//$message = 'Profile completé.';
	//return $message;
	header('location:'.ROOTPATH.'/members/?m='.$memberID.'&msg=4');
}

//Fonction de controle des requetes
function editProfile($cat, $id)
{
	$echo=NULL;
	switch($cat)
	{
		case 'pseudo':
		$echo=editPseudo($id);
		break;
		case 'email':
		$echo=editEmail($id);
		break;
		case 'pw':
		$echo=editPw($id);
		break;
		case 'general':
		$echo=editGeneralInfo($id);
		break;
		case "avator":
		$echo=editAvator($id);
		break;
		default;
		return '<p>Cette action est impossible</p>';
	}
	return $echo;
}

//Modifier le pseudo
function editPseudo($memberID)
{
	global $db;
	if (isset($_POST) && !empty($_POST['pseudo']))
	{
		$pseudoAlert=\inscription1\checkPseudo($_POST['pseudo']);
		$pseudo=stripslashes(htmlspecialchars($_POST['pseudo']));
		if($pseudoAlert['alert']==0)
		{
			$query=$db->prepare('
			UPDATE mem_members
			SET member_pseudo=:pseudo
			WHERE member_id = :id
			');
			$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
			$query->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
			$query->execute() or die(print_r($db->errorInfo()));
			header('location:'.ROOTPATH.'/members/?m='.$memberID.'');
		}
		else
		{
			return $pseudoAlert['error'];
		}
	}
}

//Modifier de l'avatar
function editAvator($memberID)
{
	global $db;
	//Une nouveauté ici : on peut choisis de supprimer l'avatar
	if (isset($_POST['action']) && $_POST['action']=='del')
	{
		$query=$db->prepare('
		UPDATE mem_members
		SET member_image= :default
		WHERE member_id = :id
		');
		$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
		$query->bindValue(':default', 'default_avator.png', \PDO::PARAM_STR);
		$query->execute() or die(print_r($db->errorInfo()));
		//header('location:'.ROOTPATH.'/members/?m='.$memberID.'');
	}
	else
	{
		//Vérification de l'avatar
		$avatorAlert=\inscription1\checkAvator();
		// Si $i est vide, il n'y a pas d'erreur
		if ($avatorAlert['alert'] == 0)
		{
			if (isset($_FILES['avator']))
			{
				$filename=moveAvator($_FILES['avator']);
				$query=$db->prepare('
				UPDATE mem_members
				SET member_image = :avator
				WHERE member_id = :id
				');
				$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
				$query->bindValue(':avator', $filename, \PDO::PARAM_STR);
				$query->execute() or die(print_r($db->errorInfo()));
				//header('location:'.ROOTPATH.'/members/?m='.$memberID.'');
			}
		}
		else
		{
			return $avatorAlert['error'];
		}
	}
}

//Modifier le mot de passe
function editPw($memberID)
{
	global $db;
	if (!empty($_POST))
	{
		extract($_POST);
		$pwAlert=\inscription1\checkPasword($pw1, $pw2);
		if ($pwAlert['alert'] == 0)
		{
			$pw=sha1($pw1);
			$query=$db->prepare('
			UPDATE mem_members
			SET member_pw = :pw
			WHERE member_id = :id
			');
			$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
			$query->bindValue(':pw', $pw, \PDO::PARAM_STR);
			$query->execute() or die(print_r($db->errorInfo()));
			return 'Votre mt de passe a été modifié avec succes!';
		}
		else
		{
			return $pwAlert['error'];
		}
	}
}

//Modifier l'email
function editEmail($memberID)
{
	global $db;
	if (isset($_POST) && !empty($_POST['email']))
	{
		extract($_POST);
		$emailAlert1=\inscription1\checkEmail($_POST['email']);
		if($emailAlert1['alert']==0)
		{
			$query=$db->prepare('
			UPDATE mem_members
			SET member_email = :email
			WHERE member_id = :id
			');
			$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
			$query->bindValue(':email', $_POST['email'], \PDO::PARAM_STR);
			$query->execute() or die(print_r($db->errorInfo()));
			header('location:'.ROOTPATH.'/members/?m='.$memberID.'');
		}
		else
		{
			return $emailAlert1['error'];
		}
	}
}

//Modifier les informations générales de son profile
function editGeneralInfo($memberID)
{
	if (!empty($_POST))
	{
		extract($_POST);
		$fname=htmlspecialchars($fname);
		$name=htmlspecialchars($name);
		$bio=htmlspecialchars($bio);
		$loc=htmlspecialchars($loc);
	    $signature=htmlspecialchars($signature);
		global $db;
		$query=$db->prepare('
		UPDATE mem_members
		SET member_signature=:signature, member_first_name=:fname, member_name=:name, 
		member_birth_day=:day, member_birth_month=:month, 
		member_birth_year=:year, member_short_bio=:bio, member_localisation=:loc, 
		member_website=:web
		WHERE member_id=:id
		');
		$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
		$query->bindValue(':signature', $signature, \PDO::PARAM_STR);
		$query->bindValue(':fname', $fname, \PDO::PARAM_STR);
		$query->bindValue(':name', $name, \PDO::PARAM_STR);
		$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
		$query->bindValue(':day', $day, \PDO::PARAM_STR);
		$query->bindValue(':month', $month, \PDO::PARAM_INT);
		$query->bindValue(':year', $year, \PDO::PARAM_INT);
		$query->bindValue(':bio', $bio, \PDO::PARAM_STR);
		$query->bindValue(':loc', $loc, \PDO::PARAM_STR);
		$query->bindValue(':web', $web, \PDO::PARAM_STR);
		$query->execute() or die(print_r($db->errorInfo()));
		header('location:'.ROOTPATH.'/members/?m='.$memberID.'');
	}
}