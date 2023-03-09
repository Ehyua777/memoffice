<?php if ($visitor->isAuthenticated()) header ('location:'.$config->rp().'/Error'); ?>
<?php
// Si on a voulu créer un personnage.
if (isset($_POST['amember']) && isset($_POST['pseudo']))
{
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'pseudo'    => $pseudo,
	'test1'     => $pw1,
	'test2'     => $pw2,
	'email'     => $email,
	'signature' => $signature,
	'firstIp'   => $visitor->ip(),
	'alias'     => $pseudo
	));
	// Si le type du personnage est valide, on a créé un personnage.
	if (isset($member))
	{
		if (!$member->checkPseudo())
		{
			$message = 'Le nom choisi est invalide.';
		}
		elseif (!$member->checkPasword())
		{
			$message = 'Le mot de passe est invalide.';
		}
		elseif ($userManager->checkExistence($member->pseudo()))
		{
			$message = 'Le nom du personnage est déjà pris.';
		}
		elseif ($userManager->checkExistence($member->email()))
		{
			$message = 'Cet email est déjà pris.';
		}
		else
		{
			$member->setPasword();
			$userManager->add($member);
			header('location:'.$config->rp().'/members');
		}
	}
}
include('form.php');
?>