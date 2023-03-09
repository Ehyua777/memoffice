<?php
namespace photoBack1;
//Vérification de la photofunction checkPhoto()
{
	$alert=0;
	$photoErr=NULL;
	$photoAlert=array();
	$configN='photo_max_size';
	$maxsize=\general\getConfigData($configN);
	$configN='photo_max_width';
	$maxwidth=\general\getConfigData($configN);//Largeur de l'image
	$configN='photo_max_height';
	$maxheight=\general\getConfigData($configN);//Longueur de l'image
	//Vérification de la photo
	if (!empty($_FILES['photo']['size']))
	{
		//Liste des extensions valides
		$validExtensions=array('jpg', 'jpeg', 'gif', 'png', 'bmp');
		if ($_FILES['photo']['error'] > 0)
		{
			$alert++;
			$photoErr='Erreur lors du transfert de la photo';
		}
		if ($_FILES['photo']['size'] > $maxsize)
		{
			$alert++;
			$photoErr='Le fichier est trop gros : 
			(<strong>'.$_FILES['photo']['size'].'Octets</strong> contre <strong>
			'.$maxsize.' Octets</strong>)';
		}
		$photoSizes=getimagesize($_FILES['photo']['tmp_name']);
		if ($photoSizes[0] > $maxwidth || $photoSizes[1] > $maxheight)
		{
			$alert++;
			$photoErr='Image trop large ou trop longue :(<strong>'.$photoSizes[0].'
			x'.$photoSizes[1].'</strong> contre <strong>'.$maxwidth.'x'.$maxheight.'
			</strong>)';
		}
		$extensionUpload=strtolower(substr(strrchr($_FILES['photo']['name'], '.') ,1));
		if (!in_array($extensionUpload, $validExtensions))
		{
			$alert++;
			$photoErr='Extension de la photo incorrecte';
		}
	}
	else
	{
		$alert++;
		$photoErr='Fichier vide';
	}
	$photoAlert=array('alert' => $alert, 'error' => $photoErr);
	return $photoAlert;
}


//Télécharger les fotos dans le dossier photo
function uploadPhotos($photo)
{
	$extensionUpload=strtolower(substr(strrchr($photo['name'], '.') ,1));
	$name = time();
	$photoName = str_replace(' ','',$name).'.'.$extensionUpload;
	$name = '../web/images/photos/'.str_replace('','',$name).'.'.$extensionUpload;
	move_uploaded_file($photo['tmp_name'], $name);
	return $photoName;
}

function photoPoster($title, $filename, $comment)
{
	$title=htmlspecialchars($title);
	$comment=htmlspecialchars($comment);
	if (empty($filename))
	{
		return('Fichier non valide');
		exit;
	}
	global $db;
	$query=$db->prepare('
	INSERT INTO mem_photos (photo_title, photo_file_name, photo_comment)
	VALUES (:title, :file, :comment)
	');
	$query->bindValue(':title', $title, \PDO::PARAM_STR);
	$query->bindValue(':file', $filename, \PDO::PARAM_STR);
	$query->bindValue(':comment', $comment, \PDO::PARAM_STR);
	$query->execute() or die(print_r($db->errorInfo()));
	header('location:'.ROOTPATH.'/photos');
}