<?php
if (isset($_POST['editemail']))
{
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'id'        => $id,
	'email'    => $email
	));
	if (isset($member))
	{
		if ($userManager->checkExistence($member->email()))
		{
			$message = 'Cet email est déjà pris.';
		}
		else
		{
			$alert = $userManager->editEmail($member); 
			if ($alert)
			{
				header('location:'.$config->rp().'/members');
			}
		}
	}
}
include('email-form.php');
?>