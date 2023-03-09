<?php
if (isset($_POST['blogcomment']))
{
	extract($_POST);
	$newComment = new LLibrary\Entities\BlogComment(array(
	'bsID'    => $subject,
	'author'  => $visitor->id(),
	'content' => $content
	));
	if (isset($newComment)) $commentManager->add($newComment);
	else echo 'Commentaire imcomplet';
}
if (!isset($_GET['s']))
{
	require('subjects-list.php');
}
else
{
	require('selected-subject.php');
}
?>