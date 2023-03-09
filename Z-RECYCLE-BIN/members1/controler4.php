<?php
if (config\checkAccessRights(MODO))
{
	if (isset($_POST['member0']) && !empty($_POST['member0']))
	{
		extract($_POST);
		$banishReturn = membersBack1\banishMember($member0);
		echo $banishReturn;
	}
	include('banish-form.php');
	
	if (isset($_POST['bMemberId']) && !empty($_POST['bMemberId']))
	{
		extract($_POST);
		$reinsReturn=membersBack1\reinsMember($bMemberId);
		echo $reinsReturn;
	}
	$banishMembers=membersBack1\banishMembersList();
	if (!empty($banishMembers))
	{
		foreach($banishMembers as $cle => $member)
		{
			$banishMembers[$cle]['bs_breffing'] = stripslashes($member['pseudo']);
		}
		include('reins-form.php');
	}
	else
	{
		?>
        <p>Aucun membre banni pour le moment :p</p>
		<?php
    }
}
else
{
	header ('location:'.ROOTPATH.'/error');
}
?>