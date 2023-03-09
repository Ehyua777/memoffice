<?php
if (isset($_POST['editpw']))
{
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'id'    => $visitor->id(),
	'test1' => $pw1,
	'test2' => $pw2
	));
	if (isset($member))
	{
		if (!$member->checkPasword())
		{
			$message = 'Le mot de passe est invalide.';
		}
		else
		{
			$member->setPasword();
			$userManager->editPw($member);
		}
	}
}
include('pw-form.php');
?>