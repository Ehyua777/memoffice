<?php
if (isset($_COOKIE['pseudo']) && empty($_SESSION['id']))
{
	// Il n'y a une connection
	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
	$id                 = (isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo             = (isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$rights             = (isset($_SESSION['rights']))?(int) $_SESSION['rights']:1;
}
elseif (isset($_COOKIE['pseudo']) && !empty($_SESSION['id']))
{
	//On n'est connecté
	$id                 = (isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo             = (isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
	$rights             = (isset($_SESSION['rights']))?(int) $_SESSION['rights']:1;
}
elseif (!isset($_COOKIE['pseudo']) && empty($_SESSION['id']))
{
	//On n'est pas connecté
	$id                 = 0;
	$pseudo             = '';
	$rights             = 1;
}
else
{
	//Attribution des variables de session
	$id     = (isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$rights = (isset($_SESSION['rights']))?(int) $_SESSION['rights']:1;
	$pseudo = (isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
}
?>