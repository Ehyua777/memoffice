<?php
$pageTitle='Super viseur';
require ('../LLibrary/lumbrera.required.php');
if (!$visitor->isAuthenticated())
{
	header('location:'.$config->rp().'/Error');
}
elseif (!$visitor->isAllRightsOne())
{
	header('location:'.$config->rp().'/error');
}
else
{
	$allRights = new LLibrary\Entities\AllRights();
	$allRightsManager = new LLibrary\Models\AllRightsManager($db);
	include('../Templates/layout.php');
}
?>
