<?php
namespace blogFront1;
//Affichage de tout les récents sujets
function getSubjects($offset, $limit)
{
	global $db;
	$status=1;
	$offset = (int) $offset;
	$limit = (int) $limit;
	$query = $db->prepare('
	SELECT bs_id, bs_title, bs_breffing, bs_text, bs_image, bs_sender,
	DATE_FORMAT(bs_date, \'%d/%m/%Y à %Hh%imin%ss\') AS bs_date_fr, member_pseudo
	FROM mem_blog_subjects
	INNER JOIN mem_members ON mem_blog_subjects.bs_sender = mem_members.member_id
	WHERE bs_status =:stat
	ORDER BY bs_date DESC
	LIMIT :offset, :limit
	');
	$query->bindValue(':stat', $status, \PDO::PARAM_INT);
	$query->bindParam(':offset', $offset, \PDO::PARAM_INT);
	$query->bindParam(':limit', $limit, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$subjects = $query->fetchAll();
	return $subjects;
}

//Nombre total de sujet
function subjectSnooz()
{
	global $db;
	$query=$db->query('
	SELECT COUNT(*) AS nbr
	FROM mem_blog_subjects
	');
	$snooz=$query->fetch();
	$subjectsNumber=$snooz['nbr'];
	return $subjectsNumber;
}

//Définition du offset des sujets du blog
function blogPages()
{
	$subjectsNumber=subjectSnooz();
	$configN='blog_subjects_limit';
	$subjectNumberPerPage=\general\getConfigData($configN);
	$pagesNumber=ceil($subjectsNumber/$subjectNumberPerPage);
	if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p']<= $pagesNumber)
	{
		$runningPage=$_GET['p'];
	}
	else
	{
		$runningPage=1;
	}
	$firstSubject=($runningPage - 1)*$subjectNumberPerPage;
	return $firstSubject;
}

//Nombre de page passible du blog
function blogPagesNumber()
{
	$subjectsNumber=subjectSnooz();
	$configN='blog_subjects_limit';
	$subjectNumberPerPage=\general\getConfigData($configN);
	$pagesNumber=ceil($subjectsNumber/$subjectNumberPerPage);
	return $pagesNumber;
}

//Affichage du sujet selectionné
function getSelectedSubject($selected)
{
	global $db;
	$query = $db->prepare('
	SELECT bs_id, bs_title title, bs_text text, bs_image image, 
	DATE_FORMAT(bs_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr, bs_sender sender, 
	member_pseudo pseudo 
	FROM mem_blog_subjects
	INNER JOIN mem_members ON mem_blog_subjects.bs_sender = mem_members.member_id
	WHERE bs_id = :sel
	');
	$query->bindValue(':sel', $selected, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$selectedSubject = $query->fetchAll();
	return $selectedSubject;
}

//Sélection d'un nombre défini des récents sujets du blog
function blogLastsPosted()
{
	/* Ex parametre
	$status=$offset=$limit=NULL;
	$status= (int) $status;
	$offset= (int) $offset;
	$limit = (int) $limit;*/
	global $db;
	$query = $db->query('
	SELECT bs_id, bs_title title, bs_breffing bref, bs_text, bs_image image, 
	DATE_FORMAT(bs_date, \'%d/%m/%Y à %Hh%imin%ss\') date, bs_sender sender, member_pseudo
	pseudo
	FROM mem_blog_subjects
	INNER JOIN mem_members ON mem_blog_subjects.bs_sender = mem_members.member_id
	WHERE bs_status = 1
	ORDER BY bs_date DESC
	LIMIT 0, 1
	');
	/*
	$query->bindValue(':stat', $status, PDO::PARAM_INT);
	$query->bindParam(':offset', $offset, PDO::PARAM_INT);
	$query->bindParam(':limit', $limit, PDO::PARAM_INT);*/
	$query->execute() or die(print_r($db->errorInfo()));
	$lastSubjects = $query->fetchAll();
	return $lastSubjects;
}

//Sélection dES TITRES DES DERNIER POSTES SUR LE BLOG
function blogLastsPostedTitles($offset, $limit)
{
	global $db;
	$status=1;
	$offset = (int) $offset;
	$limit = (int) $limit;
	$query = $db->prepare('
	SELECT bs_id, bs_title title, bs_breffing bref, 
	DATE_FORMAT(bs_date, \'%d/%m/%Y à %Hh%imin%ss\') date
	FROM mem_blog_subjects
	WHERE bs_status =:stat
	ORDER BY bs_date DESC
	LIMIT :offset, :limit
	');
	$query->bindValue(':stat', $status, \PDO::PARAM_INT);
	$query->bindParam(':offset', $offset, \PDO::PARAM_INT);
	$query->bindParam(':limit', $limit, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$lastTitles = $query->fetchAll();
	return $lastTitles;
}