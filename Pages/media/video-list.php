<h1 class="title">Liste des 5 dernières video</h1>
<div id="videos-container">
<?php
include('pages-calculator1.php');
foreach ($videoManager->getList($offset1, $limit1) as $video)
{
	if (strlen($video->comment()) <= 200)
	{
		$content = new LLibrary\General\Content($video->comment());
	}
	else
	{
		$text = substr($video->comment(), 0, 200);
		$text = substr($text, 0, strrpos($text, ' ')).'...';
		$content = new LLibrary\General\Content($text);
	}
	?>
	<?php include('videos-list.php') ?>
	<?php
}
?>
</div>
<?php
if ($pagesNumber > 0)
{
	include('pages1.php');
}
?>