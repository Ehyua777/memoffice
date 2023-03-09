<?php
if (isset($_POST['blogcomment']))
{
	extract($_POST);
	$newComment = new LLibrary\Entities\BlogComment(array(
	'bsID'    => $subject,
	'author'  => $id,
	'content' => $content
	));
	if (isset($newComment)) $commentManager->addComment($newComment);
	else echo 'Commentaire imcomplet';
}
if (isset($_GET['s']))
{
	require('selected-subject.php');
}
else
{
	require('subjects-list.php');
}
?>
</p>
</div>