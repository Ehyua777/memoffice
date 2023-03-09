<?php
$video = $videoManager->getUnique((int) $_GET['id']);
if ($video->url()!=$_GET['url'])
{
	header('location:'.$config->rp().'/media/videos/'.$video->url().'-'.$video->id());
}
include('aVideo.php');
include('pages-calculator2.php');
foreach ($videoCommentManager->getList((int) $_GET['id'], $offset2, $limit2) as $comment)
{
	$content = new LLibrary\General\Content($comment->content());
	include('comments.php');
}
include('form.php');
if ($pagesNumber2 > 0)
{
	include('pages2.php');
}
?>