<?php
if (isset($_GET['m']))
{
	$memberId=$_GET['m'];
}
else
{
	$memberId=$visitor->id();
}
if (isset($_GET['alias']) && $_GET['alias'] != $member->alias())
{
	header('location:'.$config->rp().'/members/'.$memberId.'/'.$member->alias());
}
$member=$userManager->setAUser($memberId);
$memberNumber = $userManager->count();
if ($visitor->isAuthenticated())
{
	$memberNumber = ($memberNumber - 1);
	$wcmsg = "MEM OFFICE c'est ".$member->pseudo()." et déjà ".$memberNumber." autres 
	membres";
}
else
{
	$wcmsg = "MEM OFFICE c'est déjà ".$memberNumber." membres. Et vous ?";
}
$content = new LLibrary\General\Content($member->bio());
include('profile.php');
?>