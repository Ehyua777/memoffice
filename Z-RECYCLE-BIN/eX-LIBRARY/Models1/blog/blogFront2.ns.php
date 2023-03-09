<?php
namespace blogFront2;
//Affichage des commentaires lié au sujet choisit
function getComments($selsub, $offset, $limit)
{
	global $db;
	$valid=1;
	$offset = (int) $offset;
	$limit = (int) $limit;
	$query = $db->prepare('
	SELECT bc_id, bs_id, bc_author author, bc_text text,
	DATE_FORMAT(bc_date, \'%d/%m/%Y à %Hh%imin%ss\') date_fr, bc_validity, 
	member_pseudo pseudo, member_image image
	FROM mem_blog_comments
	INNER JOIN mem_members ON mem_blog_comments.bc_author=mem_members.member_id
	WHERE bs_id = :selsub AND bc_validity = :valid
	ORDER BY bc_date
	LIMIT :offset, :limit
	');
	$query->bindValue(':selsub', $selsub, \PDO::PARAM_INT);
	$query->bindValue(':valid', $valid, \PDO::PARAM_INT);
	$query->bindParam(':offset', $offset, \PDO::PARAM_INT);
	$query->bindParam(':limit', $limit, \PDO::PARAM_INT);
	$query->execute() or die(print_r($db->errorInfo()));
	$comments = $query->fetchAll();
	return $comments;
}

//Nombre total de commentaires valide
function commentSnooz($selsub)
{
	global $db;
	$valid=1;
	$query=$db->query('
	SELECT COUNT(*) AS nbr
	FROM mem_blog_comments
	WHERE bs_id ='.$selsub.' AND bc_validity ='.$valid.'
	');
	/*$query->bindValue(':id', $selsub, PDO::PARAM_INT);
	$query->bindValue(':valid', $valid, PDO::PARAM_INT);*/
	$snooz=$query->fetch();
	$commentsNumber=$snooz['nbr'];
	return $commentsNumber;
}

//Nombre de pages possible pour les commentaires
function bcPagesNumber($selsub)
{
	$commentsNumber=commentSnooz($selsub);
	$configN='bc_per_page';
	$CommentsNumberPerPage=\general\getConfigData($configN);
	$pagesNumber=ceil($commentsNumber/$CommentsNumberPerPage);
	return $pagesNumber;
}

//Définition du offset des commentaires du blog
function bcFirstPages($selsub)
{
	$commentsNumber=commentSnooz($selsub);
	$configN='bc_per_page';
	$commentsNumberPerPage=\general\getConfigData($configN);
	$pagesNumber=ceil($commentsNumber/$commentsNumberPerPage);
	if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p']<= $pagesNumber)
	{
		$runningPage=$_GET['p'];
	}
	else
	{
		$runningPage=1;
	}
	$firstComment=($runningPage - 1)*$commentsNumberPerPage;
	return $firstComment;
}

//Poster un commentaire
function postBlogComment($authorID, $subject, $comment)
{
	global $db;
	$comment=htmlspecialchars($comment);
	$query=$db->prepare('
	INSERT INTO mem_blog_comments (bs_id, bc_author, bc_text)
	VALUES(:subject, :id, :comment)
	');
	$query->bindValue(':id', $authorID, \PDO::PARAM_INT);
	$query->bindValue(':subject', $subject, \PDO::PARAM_INT);
	$query->bindValue(':comment', $comment, \PDO::PARAM_STR);
	$query->execute() or die(print_r($db->errorInfo()));
	header ('location:'.ROOTPATH.'/blog/?bp=comm&s='.$subject);
}