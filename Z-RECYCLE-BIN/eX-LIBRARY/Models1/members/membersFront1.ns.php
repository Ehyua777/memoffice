<?php
namespace membersFront1;
function profile($memberID)
{
	//Connection à la BD
	global $db;
	//On récupère les infos du membre
	$query=$db->prepare('
	SELECT member_id, member_pseudo pseudo, member_email email, member_signature signature
	, member_image avator, member_idate idate, member_lvdate lvdate, member_first_name 
	fname, member_name name, member_genre genre, member_website website, 
	member_localisation loc, member_short_bio bio, member_posts posts
	FROM mem_members
	WHERE member_id = :member
	');
	$query->bindValue(':member', $memberID, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	//On range tout dans un tableau
	$profile = $query->fetchAll();
	return $profile;
}

//On récupère l'avatar du membre
function getAvator($memberid)
{
	global $db;
	$query=$db->prepare('
	SELECT member_image AS avator
	FROM mem_members
	WHERE member_id=:memberid
	');
	$query->bindValue(':memberid', $memberid, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$imageName = $query->fetchAll();
	return $imageName;
}

//fonction pour le fil d'ariane
function getPseudo($memberID)
{
	global $db;
	$query=$db->prepare('
	SELECT member_pseudo pseudo
	FROM mem_members
	WHERE member_id = :member
	');
	$query->bindValue(':member', $memberID, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$pseudo =$query->fetch();
	$memberPseudo=$pseudo['pseudo'];
	return $memberPseudo;
}

//Vérification des champs non rempli du profile
function checkProfile()
{}