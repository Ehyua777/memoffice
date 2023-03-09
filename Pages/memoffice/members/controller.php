<?php
$action='manage-member-rights';
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
/*
elseif (isset($_GET['ap']) && $_GET['ap'] !=$action)
{
	header('location:'.$config->rp().'/Error');
}
*/
?>
<?php $modoManager = new LLibrary\Models\ModoManager($db); ?>
<?php
if (isset($_POST['reins']))
{
	$object  = 'Bon arrivé à vous sur HEAVEN HEALTH';
	$message = 'Nous somme heureux de vous annoncer que votre demande de réintégration 
	parmi les membre du site HEAVEN HEALTH a été aprouvé par le conseil de modération 
	dudit site. Merci de votre fidélité dans la discipline.';
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'email'  => $email,
	'rights' => $member->rights()
	));
	$modo = new LLibrary\Entities\Modo();
	$modo->reins($member);
	$modoManager->rightsManager($member);
	//$modo->sendEMail($object, $message);
}
if (isset($_POST['banish']))
{
	$object = 'Avis de bannissement du site HEAVEN HEALTH';
	$message = 'Désolé très cher internaute, mais vous avez été bani du site HEAVEN HEALTH
	pour inconduitr. Pour plus de renseignement, contacter dans les meilleurs delais un 
	administrateur dudit site.';
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'email'  => $email,
	'rights' => $member->rights()
	));
	$modo = new LLibrary\Entities\Modo();
	$modo->banish($member);
	$modoManager->rightsManager($member);
	//$modo->sendEMail($object, $message);
}
?>
<?php $banishedNumber = $modoManager->countByLevel(0); ?>
<h1 class="title">Modérateuer de l'espace membres</h1>
<div>
<p align="center">Il y a à ce jour <?php echo $banishedNumber ?> banis du site</p>
<?php
if (!empty($banishedNumber))
{
	include('reins-form.php');
}
?>
<?php include('banish-form.php'); ?>
</div>