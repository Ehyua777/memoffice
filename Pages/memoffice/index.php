<?php
$pageTitle='Administration';
require ('../../LLibrary/lumbrera.required.php');
if (!$visitor->isAuthenticated())
{
	header('location:'.$config->rp().'/Error');
}
elseif (!$visitor->isModerator())
{
	header('location:'.$config->rp().'/Error');
}
else
{
	$allRights = new LLibrary\Entities\AllRights();
	$allRightsManager = new LLibrary\Models\AllRightsManager($db);
	$subjectManager = new LLibrary\Models\BlogSubjectManager($db);
	include('../../Templates/layout.php');
}
?>