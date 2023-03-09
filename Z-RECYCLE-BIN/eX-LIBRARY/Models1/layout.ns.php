<?php
namespace layout;
//Définition du title du site
function title($pageTitle)
{
	$mapTitle=$pageTitle;
	$abouDataName='website_name';
	$appTitle=\layout\getLayoutData($abouDataName);
	$title=array();
	if(isset($pageTitle) && trim($pageTitle) != '')
	{
		$pageTitle = $pageTitle.' | '.$appTitle;
	}
	else
	{
		$pageTitle = $appTitle;
	}
	$title=array('title' => $pageTitle, 'map' => $mapTitle);
	return $title;
}

// Récupération de la dernièrre info
function getInfo()
{
	global $db;
	$valid=1;
	$query=$db->prepare('
	SELECT news_info info, DATE_FORMAT(news_date, \'%d/%m/%Y à %Hh%imin%ss\') date
	FROM mem_news
	WHERE news_valid = ?
	ORDER BY news_id DESC
	LIMIT 0, 1');
	$query->execute(array($valid)) or die(print_r($db->errorInfo()));
	$news = $query->fetchAll();
	return $news;
}

//Récupération du menu principal
function getMenu($level)
{
	global $db;
	$query=$db->prepare('
	SELECT item_id ak, item_link link, item_name name, item_description description
	FROM mem_menu_items
	WHERE item_level = :level
	');
	$query->bindValue(':level', $level, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$mainItems = $query->fetchAll();
	return $mainItems;
}

//Récupération des informations à propos du site
function getLayoutData($layoutDataName)
{
	$layoutInfo=NULL;
	global $db;
	//Récupération des variables de configuration
	$query = $db->query('
	SELECT *
	FROM mem_layout
	');
	$layout = array();
	while($data=$query->fetch())
	{
		$layout[$data['layout_index']] = $data['layout_info'];
	}
	$layoutInfo=$layout[$layoutDataName];
	return $layoutInfo;
}

//Gestionnaire des messages
function messagesManager($pseudo)
{
	$msg=0;
	if (isset($_GET['msg'])) $msg = (int)$_GET['msg'];
	switch($msg)
	{
		case 4:
		return '<br clear="all"><p>Profile de '.$pseudo.' mise à jour</p>';
		break;
		case 3:
		return '<br clear="all"><p>Vous vous estes déconnecté '.$pseudo.'</p>';
		break;
		case 2:
		return '<br clear="all"><p>Vous estes maintenant connecté '.$pseudo.'</p>';
		break;
		case 1:
		return '<br clear="all"><p>Bienvenu '.$pseudo.'</p>';
		break;
		default:
		echo '';
	}
	unset($msg);

}