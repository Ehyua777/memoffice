<?php
namespace blogBack1;
//Posté un nouvo sujet de blog
function postBlogSubject($title, $bref, $text, $imagename, $id, $time)
{
	global $db;
	$title=htmlspecialchars($title);
	$bref=htmlspecialchars($bref);
	$text=htmlspecialchars($text);
	$query=$db->prepare('
	INSERT INTO mem_blog_subjects (bs_title, bs_breffing, bs_text, bs_image, bs_sender,
	bs_time)
	VALUES (:title, :bref, :text, :image, :sender, :time)
	');
	$query->bindValue(':title', $title, \PDO::PARAM_STR);
	$query->bindValue(':bref', $bref, \PDO::PARAM_STR);
	$query->bindValue(':text', $text, \PDO::PARAM_STR);
	$query->bindValue(':image', $imagename, \PDO::PARAM_STR);
	$query->bindValue(':sender', $id, \PDO::PARAM_INT);
	$query->bindValue(':time', $time, \PDO::PARAM_INT);
	if ($query->execute())
	{
		return 'Votr sujet à bien été posté';
	}
	else
	{
		echo 'Zip! ptit bugg...';
		die(print_r($db->errorInfo()));
	}
}