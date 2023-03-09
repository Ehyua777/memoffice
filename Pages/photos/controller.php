<?php 
include('page-up.php');
include('page-calculator.php');
$photos = $photoManager->getList($offset, $limit);
if (!empty($photos))
{
	foreach($photos as $photo)
	{
		$content = new LLibrary\General\Content($photo->comment());
		include('photo.php');
	}
}
else
{
	echo 'Pas de photos disponibles';
}
include('pagging.php'); 
?>