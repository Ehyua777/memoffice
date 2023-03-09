<?php
$action = 'manage-media';
if (!isset($_GET['alias']))
{
	header('location:'.$config->rp().'/Error');
}
elseif ($_GET['alias'] != $member->alias())
{
	header('location:'.$config->rp().'/Error');
}
elseif (!isset($_GET['ap']))
{
	header('location:'.$config->rp().'/Error');
}
/*elseif (isset($_GET['ap']) && $_GET['ap'] != $action)
{
	header('location:'.$config->rp().'/Error');
}*/
?>
<?php if ($visitor->isModerator()) { ?>
<?php
$videoManager = new LLibrary\Models\VideoManager($db);
if (isset($_POST['newvideo']))
{
	extract($_POST);
	$video = new LLibrary\Entities\Video(array(
	'title'    => $title,
	'comment'  => $content,
	'url'      => $title,
	'src'      => $src,
	'type'     => $type
	));
	if (isset($_FILES['poster']))
	{
		$message = $video->processPoster($_FILES['poster'], 'Web/loads/img/posters');
	}
	$videoManager->add($video);
}
include('form.php');
?>
<?php } else { ?>
<?php header('location:'.$config->rp().'/Error'); ?>
<?php } ?>