<?php
$subject = $subjectManager->getUnique((int) $_GET['s']);
$content = new LLibrary\General\Content($subject->text());
include('../../../Z-RECYCLE-BIN/blog/subject.php');
include('../../blog/pages-calculator2.php');
foreach ($commentManager->getList((int) $_GET['s'], $offset2, $limit2) as $comment)
{
	$content = new LLibrary\General\Content($comment->content());
	include('../../blog/comments.php');
}
include('../../blog/form.php');
if ($pagesNumber2 > 0)
{
	include('../../blog/pages2.php');
}