<?php
if (isset($_POST['editesignature']))
{
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'id'        => $id,
	'signature' => $signature
	));
	// Si le type du personnage est valide, on a créé un personnage.
	if (isset($member))
	{
		$userManager->editSignature($member);
		header('location:'.$config->rp().'/members');
	}
}
include('signature-form.php');
?>