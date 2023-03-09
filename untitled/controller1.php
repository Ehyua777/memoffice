<?php
if (isset($_POST['modo']))
{
	extract($_POST);
	if ($allRightsManager->checkExistence($email))
	{
		$member = new LLibrary\Entities\Member(array('email'  => $email));
		$allRights->addModerator($member);
		$allRightsManager->rightsManager($member);
		header('location:'.$config->rp().'/members');
	}
	else $message = "Désolé, cet email n'existe pas dans notre base!";
}
include('html1.php'); 
?>