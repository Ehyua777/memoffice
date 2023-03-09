<?php
namespace config;
//Définition des droitd d'accès
function checkAccessRights($accessRignt)
{
	$level=(isset($_SESSION['level']))?$_SESSION['level']:1;
    return ($accessRignt <= intval($level));
}

//Définition des erreur
function error($err='')
{
	$msg=($err!='')? $err:'Une erreur inconnue s\'est produite';
	exit(
	'<p>'.$msg.'</p>
	<p>Cliquez <a href="'.ROOTPATH.'/">ici</a> pour revenir à la page d\'accueil</p>'
	);
}