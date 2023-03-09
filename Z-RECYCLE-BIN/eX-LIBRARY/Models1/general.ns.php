<?php
namespace general;

//Connexion à la BD
function connection($host, $port, $eiwa_db, $user, $pw)
{	
	define('HOST', $host);
	define('PORT', $port);
	define('DB', $eiwa_db);
	define('USER', $user);
	define('PW', $pw);
	
	try
	{
		$db = new \PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DB, USER, PW);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}
	catch (Exception $err)
	{
		die ('error['.$err->getCode().'] '.$e->getMessage());
	}
	return $db;
}

//Récupération des données de configuration
function getConfigData($configName)
{
	$configValue=NULL;
	global $db;
	//Récupération des variables de configuration
	$query = $db->query('
	SELECT *
	FROM mem_config
	');
	$config = array();
	while($data=$query->fetch())
	{
		$config[$data['config_index']] = $data['config_value'];
	}
	$configValue=$config[$configName];
	return $configValue;
}

//Gestionnaire de l'IP
function visitorRegister($visitorID, $pageTitle)
{
	// récuperrer l'ip d'un visiteur
	$visitorIP = $_SERVER['REMOTE_ADDR'];
	//Création des variables
	$ip = ip2long ($visitorIP);
	//Requête
	global $db;
	$query=$db->prepare('
	INSERT INTO mem_whosonline
	VALUES(:id, :ip, :page, :time)
	ON DUPLICATE KEY 
	UPDATE online_id = :id, online_page = :page, online_time = :time
	');
	$query->bindValue(':id', $visitorID, \PDO::PARAM_INT);
	$query->bindValue(':ip', $ip, \PDO::PARAM_INT);
	$query->bindValue(':page', $pageTitle, \PDO::PARAM_STR);
	$query->bindValue(':time', time(), \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	//---
	$timeMax = time() - (60 * 5);
	$query=$db->prepare('
	DELETE FROM mem_whosonline
	WHERE online_time < :timemax
	');
	$query->bindValue(':timemax', $timeMax, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
}

//Nombre de visiteur en ligne
function whosOnline()
{
	$x=0;
	$whosOnlineNumber=array();
	//connexion
	global $db;
	//Nombre de visiteur qui sont pas des membres
	$query=$db->prepare('
	SELECT COUNT(*) AS nbr
	FROM mem_whosonline
	WHERE online_id = ?
	');
	$query->execute(array($x)) or die(print_r($db->errorInfo()));
	$snooz=$query->fetch();
	$visitorNumber=$snooz['nbr'];
	//Nombre de visiteur qui sont des membres
	$query=$db->prepare('
	SELECT COUNT(*) AS nbr
	FROM mem_whosonline
	WHERE online_id <> ?
	');
	$query->execute(array($x)) or die(print_r($db->errorInfo()));
	$snooz=$query->fetch();
	$membersNumber=$snooz['nbr'];
	//Somme de tout les connecté au site
	$allVisitorsNumber=$visitorNumber+$membersNumber;
	//Rangements des données dans un tableau
	$whosOnlineNumber=array(
	'visitor'     => $visitorNumber,
	'member'      => $membersNumber,
	'snooz'       => $allVisitorsNumber
	);
	return $whosOnlineNumber;
}

function nowPageVisitors($pageTitle)
{
	global $db;
	//Nombre de connectées sur la page courante
	$query=$db->prepare('
	SELECT COUNT(*)
	FROM mem_whosonline
	WHERE online_page = ?
	');
	$query->execute(array($pageTitle)) or die(print_r($db->errorInfo()));
	$snooz=$query->fetchColumn();
	$onlinePageVisitors=$snooz['nbr'];
	return $onlinePageVisitors;
}