<?php
namespace logout;
function logout($memberID)
{
	global $db;
	if ($memberID!=0)
	{
		if (isset($_COOKIE['pseudo']))
		{
			setcookie('pseudo', '', -1);
			setcookie('pw', '', -1);
		}
		session_destroy();
		$query=$db->prepare('
		DELETE FROM mem_whosonline
		WHERE online_id=:id
		');
		$query->bindValue(':id', $memberID, \PDO::PARAM_INT);
		$query->execute();
		header('location:'.ROOTPATH.'/?msg=3');
	}
	else
	{
		header('location:'.ROOTPATH.'/login');
	}
}