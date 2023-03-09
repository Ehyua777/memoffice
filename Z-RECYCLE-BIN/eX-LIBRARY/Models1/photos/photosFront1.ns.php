<?php
namespace photoFront1;
function getPhotos($offset, $limit)
{
	global $db;
	$valid=1;
	$offset = (int) $offset;
	$limit = (int) $limit;
	$query = $db->prepare('
	SELECT photo_title title, photo_file_name file, photo_comment comment, 
	DATE_FORMAT(photo_date, \'%d/%m/%Y à %Hh%imin%ss\') date
	FROM mem_photos
	WHERE photo_valid = :valid
	ORDER BY photo_date DESC
	LIMIT :offset, :limit
	');
	$query->bindValue(':valid', $valid, \PDO::PARAM_INT);
	$query->bindParam(':offset', $offset, \PDO::PARAM_INT);
	$query->bindParam(':limit', $limit, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$photos = $query->fetchAll();
	return $photos;
}

//Nombre total de photo
function photoSnooz()
{
	global $db;
	$query=$db->query('
	SELECT COUNT(*) AS nbr
	FROM mem_photos
	');
	$snooz=$query->fetch();
	$photosNumber=$snooz['nbr'];
	return $photosNumber;
}

//Nombre de page possible du listing des photos
function photoPageNumber()
{
	$photosNumber=photoSnooz();
	$configN='photo_number_per_page';
	$photoNumberPerPage=\general\getConfigData($configN);
	$pagesNumber=ceil($photosNumber/$photoNumberPerPage);
	return $pagesNumber;
}

//Définition du offset des photo
function photoOffset()
{
	$configN='photo_number_per_page';
	$photoNumberPerPage=\general\getConfigData($configN);
	$pagesNumber=photoPageNumber();
	if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p']<= $pagesNumber)
	{
		$runningPage=$_GET['p'];
	}
	else
	{
		$runningPage=1;
	}
	$firstPhoto=($runningPage - 1)*$photoNumberPerPage;
	return $firstPhoto;
}