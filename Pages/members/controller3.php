<?php
if (isset($_FILES['avator']) && isset($_POST['avator']))
{
	extract($_POST);
	$avatorAlert = $member->checkAvator($_FILES['avator']);
	if ($avatorAlert['alert'] == 0)
	{
		$member->moveAvator($_FILES['avator'], $config->avatorDir());
		$member->setId($id);
		$userManager->updateAvator($member);
		header('location:'.$config->rp().'/members');
	}	
}
include('avator-form.php');
?>