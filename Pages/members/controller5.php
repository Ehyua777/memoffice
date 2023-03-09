<?php
if (isset($_POST['editpseudo']))
{
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'id'        => $id,
	'pseudo'    => $pseudo
	));
	// Si le type du personnage est valide, on a créé un personnage.
	if (isset($member))
	{
		if (!$member->checkPseudo())
		{
			$message = 'Le pseudo choisi est invalide.';
		}
		elseif ($userManager->checkExistence($member->pseudo()))
		{
			$message = 'Le nom du personnage est déjà pris.';
		}
		else
		{
			$userManager->editPseudo($member);
			header('location:'.$config->rp().'/members');
		}
	}
}
include('pseudo-form.php');
?>