<meta charset="utf-8" />
<?php
//On récupère la valeur de nos variables passées par URL du membere
if (isset($_GET['m']))
{
	$memberId=$_GET['m'];
}
else
{
	$memberId=$id;
}
$profile=membersFront1\profile($memberId);
foreach($profile as $cle => $member)
{
	$profile[$cle]['pseudo']=nl2br(stripslashes(htmlspecialchars($member['pseudo'])))
	;
	$profile[$cle]['signature']=nl2br(stripslashes(htmlspecialchars($member['signature'
	])));
	$profile[$cle]['bio']=htmlspecialchars(nl2br(stripslashes($member['bio'])));
	$profile[$cle]['loc']=nl2br(stripslashes($member['loc']));
	$profile[$cle]['name']=stripslashes(htmlspecialchars($member['name']));
	$profile[$cle]['fname']=stripslashes(htmlspecialchars($member['fname']));
	$profile[$cle]['idate']=date($member['idate']);
	$profile[$cle]['lvdate']=date($member['lvdate']);
}
if (!empty($profile))
{
	foreach($profile as $member)
	{
		include('profile.php');
	}
}
else
{
	echo '<p>Désolé, nous ne connaisspns pas ce membre.</p>';
}
?>