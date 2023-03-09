<?php
namespace aboutFront1;
//Récupération des informations à propos du site
function getAboutData($abouDataName)
{
	$aboutInfo=NULL;
	global $db;
	//Récupération des variables de configuration
	$query = $db->query('
	SELECT *
	FROM mem_about
	');
	$about = array();
	while($data=$query->fetch())
	{
		$about[$data['about_index']] = $data['about_info'];
	}
	$aboutInfo=$about[$abouDataName];
	return $aboutInfo;
}
