<?php
namespace LLibrary\Models;
class AllRightsManager extends AdminManager
{
	public function addAWebmaster(\LLibrary\Entities\Modo $moderator)
	{
		try
		{
			$sql='
			INSERT INTO l_staff_members (member_id, member_rollCode, member_heading, 
			member_speciality, promoter_id)
			VALUES (:member, :rollCode, :heading, :speciality, :promoter)
			';
			$query = $this->db->prepare($sql);
			$query->bindValue(':member', $moderator->id());
			$query->bindValue(':rollCode', $moderator->roll());
			$query->bindValue(':heading', $moderator->heading());
			$query->bindValue(':function', $moderator->speciality());
			$query->bindValue(':function', $moderator->promoter());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function delete(\LLibrary\Entities\Member $member)
	{
		// Exécute une requête de type DELETE.
	}
	public function setAdminList($debut = -1, $limite = -1)
	{
		try
		{
			$sql='
			SELECT sm_id smID, member_id memberID, member_rollCode rollCode, 
			member_heading heading, member_speciality speciality, promoter_id promoter, 
			user_pseudo memberPseudo
			FROM l_staff_members
			INNER JOIN l_users ON l_staff_members.member_id = l_users.user_id
			';
			if ($debut != -1 || $limite != -1)
			{
				$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
			}
			$query = $this->db->query($sql);
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Admin');
			$modoList = $query->fetchAll();
			return $modoList;
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
}