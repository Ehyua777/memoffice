<h1 class="title">Modifier / mettre à jour le profile</h1>
<br clear="all" />
<?php
// Si on a voulu créer un personnage.
if (isset($_POST['updatemember']))
{
	extract($_POST);
	$member = new LLibrary\Entities\Member(array(
	'id'           => $id,
	'fName'        => $fName,
	'name'         => $name,
	'genre'        => $genre,
	'birthDay'     => $day,
	'birthMonth'   => $month,
	'birthYear'    => $year,
	'bio'          => $content,
	'localisation' => $localisation,
	'website'      => $website
	));
	// Si le type du personnage est valide, on a créé un personnage.
	if (isset($member))
	{
		$updateAlert = $userManager->update($member);
		if ($updateAlert==true) header('location:'.$config->rp().'/members');
		else { ?><fieldset>Veuillez svp recommencer...</fieldset><?php }
	}
}
include('comp-form.php');
?>