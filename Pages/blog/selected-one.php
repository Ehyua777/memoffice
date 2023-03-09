<?php
$subject = $subjectManager->getUnique((int) $_GET['s']);
if ($subject->url()!=$_GET['url'])
{
	header('location:'.$config->rp().'/blog/subject/'.$subject->url().'-'.$subject->id());
}
$content = new LLibrary\General\Content($subject->text());
include('subject-content.php');
include('pages-calculator2.php');
foreach ($subjectCommentManager->getList((int) $_GET['s'], 0, 50) as $comment)
{
	$content = new LLibrary\General\Content($comment->content());
	include('comments.php');
}
include('form.php');
if ($pagesNumber2 > 0)
{
	include('pages2.php');
}