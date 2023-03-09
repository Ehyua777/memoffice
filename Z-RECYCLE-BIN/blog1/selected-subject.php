<?php
$subject = $subjectManager->getUnique((int) $_GET['s']);
if ($subject->url()!=$_GET['url'])
{
	header('location:'.RP.'/blog/subject/'.$subject->url().'-'.$subject->id());
}
$content = new LLibrary\General\Content($subject->text());
include('subject.php');
include('pages-calculator2.php');
foreach ($commentManager->getList((int) $_GET['s'], $offset2, $limit2) as $comment)
{
	$content = new LLibrary\General\Content($comment->content());
	include('comments.php');
}
include('form2.php');
if ($pagesNumber2 > 0)
{
	include('pages2.php');
}