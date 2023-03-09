<?php
//On récupère la valeur de nos variables passées par URL du membere
$profile=profile($id);
foreach($profile as $member)
{}
if (isset($_POST) && !empty($_POST['fname']))
{
	extract($_POST);
	$message=update_profile($id, $fname, $name, $genre, $day, $month, $year, $bio, $loc, 
	$site);
}
include('form2.php');
?>