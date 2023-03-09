<?php
$subject = $subjectManager->getUnique((int) $_GET['s']);
if ($subject->url()!=$_GET['url'])
{
	header('location:'.$config->rp().'/blog/subject/'.$subject->url().'-'.$subject->id());
}
$content = new LLibrary\General\Content($subject->text());
include('subject.php');
include('../../Pages/blog/pages-calculator2.php');
foreach ($commentManager->getList((int) $_GET['s'], 0, 50) as $comment)
{
	$content = new LLibrary\General\Content($comment->content());
	include('../../Pages/blog/comments.php');
}
include('../../Pages/blog/form.php');
if ($pagesNumber2 > 0)
{
	include('../../Pages/blog/pages2.php');
}