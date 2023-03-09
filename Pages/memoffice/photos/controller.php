<?php
$action = 'manage-portfolio';
if (!isset($_GET['alias']))
{
	header('location:'.$config->rp().'/Error');
}
elseif (isset($_GET['alias']) && $_GET['alias'] != $member->alias())
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
<h1 class="title">Poster une photo</h1>
<br clear="all" />
<?php
$photo = new LLibrary\Entities\Photo();
$photoManager = new LLibrary\Models\PhotoManager($db);
//Vérification du droit d'accès
if (!$visitor->isModerator()) header('location:'.$config->rp().'/Error');
//Vérification des données soumis par le formulaire
if (isset($_FILES['photo']) && !empty($_POST['photo']))
{
	extract($_POST);
	$photo = new LLibrary\Entities\Photo(array(
	'title'    => $title,
	'comment'  => $content
	));
	$photoAlert = $photo->checkPhoto($_FILES['photo']);
	if ($photoAlert['alert'] == 0)
	{
		$photo->movePhoto($_FILES['photo'], 'Web/loads/img/photos');
		$photoManager->add($photo);
	}	
}
include('photos-form.php');
?>