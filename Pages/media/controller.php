<?php
if (isset($_POST['videocomment']))
{
	extract($_POST);
	$newComment = new LLibrary\Entities\VideoComment(array(
	'videoID' => $video,
	'author'  => $visitor->id(),
	'content' => $content
	));
	if (isset($newComment)) $videoCommentManager->add($newComment);
	else echo 'Commentaire imcomplet';
}
if (!isset($_GET['id']))
{
	include('video-list.php');
}
else
{
	?>
    <div class="content"><?php include('selected-video.php') ?></div>
	<?php
    include('sidebar.php');
}
?>