<?php
if ($id==0) error(ERR_IS_NOT_CO);
if (isset($_GET['cat']))
{
	$cat=$_GET['cat'];
	$echo=membersFront2\edit_profile($cat, $id);
}
//On récupère la valeur de nos variables passées par URL du membere
$profile=membersFront1\profile($id);
foreach($profile as $cle => $member)
{
	$profile[$cle]['fname']=stripslashes(htmlspecialchars($member['fname']));
	$profile[$cle]['name']=stripslashes(htmlspecialchars($member['name']));
	$profile[$cle]['bio']= nl2br(stripslashes(htmlspecialchars($member['bio'])));
    $profile[$cle]['signature']=nl2br(stripslashes(htmlspecialchars($member['signature'])));
}
foreach($profile as $member)
{
	switch($cat)
	{
		case 'pseudo':
		include('pseudo-form.php');
		break;
		case 'email':
		include('email-form.php');
		break;
		case 'pw':
		include('pw-form.php');
		break;
		case 'avator':
		include('avator-form.php');
		break;
		case 'general':
		include('g-i-form.php');
		break;
		default;
		return '<p>Cette action est impossible</p>';
	}
}