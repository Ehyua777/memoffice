<?php
namespace membersBack1;

//Chargement de l'avatar
function moveAvator($avator)
{
	$extensionUpload=strtolower(substr(strrchr($avator['name'], '.') ,1));
	$name = time();
	$filename = str_replace(' ','',$name).'.'.$extensionUpload;
	$name = '../web/images/avators/'.str_replace('','',$name).'.'.$extensionUpload;
	move_uploaded_file($avator['tmp_name'], $name);
	return $filename;
}

//Banissement d'un membre
function banishMember($member)
{
	global $db;
	$query=$db->prepare('
	SELECT member_id
	FROM mem_members
	WHERE LOWER(member_pseudo) = :pseudo
	');
	$query->bindValue(':pseudo', strtolower($member), \PDO::PARAM_STR);
	$query->execute();
	//Si le membre existe
	if ($data = $query->fetch())
	{
		//On le bannit
		$query=$db->prepare('
		UPDATE mem_members
		SET member_level = 0
		WHERE member_id = :id
		');
		$query->bindValue(':id', $data['member_id'], \PDO::PARAM_INT);
		$query->execute();
		return 'Le membre '.stripslashes($member).' a bien été banni.';
	}
	else
	{
		return 'Désolé, le membre'.stripslashes($member).' n existe pas. ';
	}
}

//Listing des membres bani
function banishMembersList()
{
	$level=0;
	global $db;
	$query = $db->prepare('
	SELECT member_id, member_pseudo pseudo
	FROM mem_members 
	WHERE member_level = ?
	');
	$query->execute(array($level)) or die(print_r($db->errorInfo()));
	$banishMembers = $query->fetchAll();
	return $banishMembers;
}

//Réintégration d'un membre
function reinsMember($memberID)
{
	global $db;
	$query=$db->prepare('
	UPDATE mem_members
	SET member_level = 2
	WHERE member_id = :id
	');
	$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$query = $db->query('
	SELECT member_id, member_pseudo pseudo
	FROM mem_members 
	WHERE member_id ='.$memberID.'
	');
	$query->execute() or die(print_r($db->errorInfo()));
	$data=$query->fetch();
	$member=$data['pseudo'];
	return 'Le membre '.$member.' a été réintégré<br />';
}