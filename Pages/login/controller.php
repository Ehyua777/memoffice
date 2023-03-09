<?php if ($visitor->isAuthenticated()) header ('location:'.$config->rp().'/Error'); ?>
<?php
$alert;
if (isset($_POST['login']))
{
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'email' => $email,
	'pw'    => $pw
	));
	if (!$userManager->checkExistence($member->email()))
	{
		$message = "Email invalide";
	}
	else
	{
		if (empty($rememberMe))
		{
			$rememberMe='ko';
		}
		$alert = $userManager->login($member, $rememberMe);
		if (!is_int($alert) && $alert)
		{
			header('location:'.$config->rp().'/');
		}
		else
		{
			if ($alert==0)
			{
				$message = 'Désolé vous avez été bani. Contactez un webmaster.';
			}
			elseif ($alert==1)
			{
				$message = "Mot de passe invalide...";
			}
		}
	}
}
include('form.php');
?>