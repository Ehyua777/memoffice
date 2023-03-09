<?php
if (isset($_POST['admin']))
{
	extract($_POST);
	if ($allRightsManager->checkExistence($email))
	{
		$moderator = new LLibrary\Entities\Modo(array('email'  => $email));
		$allRights->addAmin($moderator);
		$allRightsManager->rightsManager($moderator);
		header('location:'.$config->rp().'/members');
	}
	else $message = "Désolé, cet email n'existe pas dans notre base!";
}
include('html2.php'); 
?>